<?php

namespace UVigoThemeWPApp;

/**
 * ESEI
 */
add_filter('body_class', function (array $classes) {
    $classes[] = 'web-esei';
    return $classes;
});

/**
 * Change Home Query
 */
add_action('pre_get_posts', function ($query) {
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', '-108');
    }
}, 100);

/**
 * ESEI
 * Filtro para inyectar datos uvigo_pre_footer_content
 */
add_filter('uvigo_pre_footer_content', function (array $params) {
    $template = locate_template('partials/footer-uvigo-esei');
    $output = template($template);
    return $output;
});

/**
 * ESEI
 * Sobreescribe ruta a plantillas
 */
add_filter('sage/filter_templates/paths', function (array $paths) {
    return array_merge(['views_esei'], $paths);
});

/**
 * ESEI
 * Filter menu items esei
 *
 * La premisa es que se cuenta con que los elementos ya vienen ordenados según el orden del menú.
 * Por tanto, se irá determinando la profundidad del elemento a medida que se recorre.
 *
 * Pasos :
 *
 * 1- Recorre el listado de elementos del menu y determina el nivel en el que está cada item ( establece propiedad item_level )
 * 2- Mientras lo recorre, guarda un mapa de [ID -> menu_item_parent] en la variables $map_parents que se empleará para conocer cual es el antecesor de un elemento
 * 3- Para el elmento actual del menú, se va a determinar cuál va a ser el elemento raiz ($current_show_root_menu_item_id) a visualizar en el menú. Se establezca como raiz : El propio elemento, o su padre, o su abuelo.
 * 4- Filtramos el resto de elementos del menú que no cuelguen del elmento escogido como raiz ($current_show_root_menu_item_id)
 */
add_filter('wp_nav_menu_objects', function (array $sorted_menu_items, \stdClass $args) {
    /**
     * menu_level es una propiedad asignada en el widget que nos ayuda a determinar si vamos o no aplicar el filtro de elmentos del menú.
     */
    if (isset($args->menu_level) && $args->menu_level == 2) {
        // Array para guardar la herencia de elementos
        $level = array();
        // Ultimo elemento
        $last_id = 0;
        // Map Parents
        $map_parents = array();

        // Elemento de raiz para el menú
        $current_show_root_menu_item_id =  null;
        foreach ($sorted_menu_items as $value) {

            $parent_id = intval($value->menu_item_parent);
            $last_id = intval(array_pop($level));

            $map_parents[$value->ID] = $parent_id;

            // Mientras no encontramos el padre en la herencia, retiramos de la pila
            while ($parent_id !== 0 && \sizeof($level) > 0 && $parent_id !== $last_id) {
                $last_id = intval(array_pop($level));
            }
            // Si encontramos, volvemos a incorporar el elmento padre
            if ($parent_id == $last_id) {
                array_push($level, $last_id);
            }

            // El nivel del elemento se corresponde con la profundidad del array.
            $value->item_level = \sizeof($level);

            // UNICAMENTE, AL LLEGAR AL ELEMENTO ACTUAL QUE SE ESTÁ VIENDO EN EL MENU.
            // Unicamente nos interesa mostrar los elementos del 2º 3º y 4º nivel que estén relacionados con el elemento actual
            // Determinamos el elmento raiz del menú
            if ($value->current == 1) {
                switch ($value->item_level) {
                    case 2:
                        // Si es de segundo nivel, es el padre en el menú
                        $current_show_root_menu_item_id = $value->ID;
                        break;
                    case 3:
                        // Si es de tercer nivel, es hijo en el menú
                        $current_show_root_menu_item_id = $parent_id;
                        break;
                    case 4:
                        // Si es de tercer/cuarto nivel, es hijo en el menú
                        $current_show_root_menu_item_id = $map_parents[$parent_id];
                        break;
                }
            }
            array_push($level, $value->ID);
        }

        /* DEBUG : Muestra los elementos del menú, y el nivel que le asignó
        foreach ($sorted_menu_items as $value) {
            print_r('<p>'.$value->ID . ' ' . $value->title . ' ' . $value->item_level.'</p>');
        }
        print_r('<p>'.$current_show_root_menu_item_id .'</p>');
        */

        // Filtramos el menú por elementos de nivel 2 o superior que sean hijos o nietos el elemento raiz previamente identificado
        $sorted_menu_items_filtered = array();
        foreach ($sorted_menu_items as $value) {
            if ($value->item_level >= 2) {
                if ($value->ID == $current_show_root_menu_item_id
                || $value->menu_item_parent == $current_show_root_menu_item_id
                || $map_parents[$value->menu_item_parent] == $current_show_root_menu_item_id) {
                    $sorted_menu_items_filtered[] = $value;
                }
            }
        }

        // si únicamente estamos mostrando el current ( no tiene hijos ) no se muestra menú.
        if (\sizeof($sorted_menu_items_filtered) === 1) {
            $sorted_menu_items_filtered = array();
        }
        return $sorted_menu_items_filtered;
    }

    // Devolvemos el original
    return $sorted_menu_items;
}, 10, 2);


/**
 * Añadimos una zona de widgets para nuestra web
 *
 */
add_filter('uvigo_list_custom_sidebars', function ($sidebars) {

    $sidebar_news = [
        'name'          => __('ESEI Footer News', 'uvigothemewp'),
        'id'            => 'esei-footer-news',
        'before_widget' => '<div class="esei_actualidade p-0">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
        'description'   => esc_html__('Sidebar for news.', 'uvigothemewp'),
    ];

    $sidebar_footer = [
        'name'          => __('ESEI Footer', 'uvigothemewp'),
        'id'            => 'esei-footer',
        'class'         => '',
        'before_widget' => '<div class="">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
        'description'   => esc_html__('Sidebar for ESEI footer.', 'uvigothemewp'),
    ];

    return array_merge(
        $sidebars,
        [
            'esei-footer' => $sidebar_footer,
            'esei-footer-news' => $sidebar_news,
        ]
    );
}, 10, 1);

/**
 * Modificar la línea de las presentación de las actas
 */
add_filter('uvigo_act_document_render_line', function ($output_file, $document) {
    $output_file = sprintf(
        '<li><a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a></li>',
        $document['uvigo_act_document_file']['url'],
        $document['uvigo_act_document_title']
    );

    return $output_file;
}, 10, 2);

/**
 * Restringir la importación de Ofertas
 */
add_filter('uvigo_feedsreader_importer_uvigo_offers_offer_uvigo-offer_check_to_create', function ($to_create, $element) {
    $titulaciones_value = $element->getAttributes()->getAttribute('uvigo_offers_offer_degrees');
    $pos = stripos($titulaciones_value, 'Informática');
    // Lo creará si encontramos la cadena
    $to_create = ($pos !== false);
    return $to_create;
}, 10, 2);

/**
 * Restringir la importación de Prácticas
 */
add_filter('uvigo_feedsreader_importer_uvigo_offers_practice_uvigo-practice_check_to_create', function ($to_create, $element) {
    $titulaciones_value = $element->getAttributes()->getAttribute('uvigo_offers_practice_degrees');
    $pos = stripos($titulaciones_value, 'Informática');
    // Lo creará si encontramos la cadena
    $to_create = ($pos !== false);
    return $to_create;
}, 10, 2);

/**
 * Add Row Action on Post : Ofertas y Prácticas
 */
add_filter('post_row_actions', function ($actions, $post) {
    // Check for your post type.
    if ($post->post_type == "uvigo-offer"
        || $post->post_type == "uvigo-practice") {
        // Source Link
        $source_url = null;
        if ($post->post_type == "uvigo-offer") {
            $source_url = get_post_meta($post->ID, 'uvigo_offers_offer_url', true);
        }
        if ($post->post_type == "uvigo-practice") {
            $source_url = get_post_meta($post->ID, 'uvigo_offers_practice_url', true);
        }
        if (!empty($source_url)) {
            $actions = array_merge($actions, array(
                'source' => sprintf(
                    '<a href="%1$s" target="_blank" >%2$s</a>',
                    esc_url($source_url),
                    'Ver Origen'
                )
            ));
        }
    }
    return $actions;
}, 10, 2);
