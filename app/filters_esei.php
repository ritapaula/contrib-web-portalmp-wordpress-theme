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
 * La premisa es que se cuenta con que los elementos ya vienen ordenados según el orden del menú. Por tanto, se irá determinando la profundidad del elemento a medida que se recorre.
 */
add_filter('wp_nav_menu_objects', function (array $sorted_menu_items, \stdClass $args) {
    /**
     * menu_level es una propiedad asignada para este escenario.
     */
    if (isset($args->menu_level) && $args->menu_level == 2) {
        // Array para guardar la herencia de elementos
        $level = array();
        // Ultimo elemento
        $last_id = 0;
        // Elemento de raiz para el menú
        $current_show_root_menu_item_id =  null;
        foreach ($sorted_menu_items as $value) {

            $parent_id = intval($value->menu_item_parent);
            $last_id = intval(array_pop($level));
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
           
            // Unicamente nos interesa mostrar los elementos del 2º y 3º nivel que estén relacionados con el elemento actual
            // Determinamos el elmento raiz del menú
            if ($value->current == 1) {
                switch ($value->item_level) {
                    case 2:
                        // Si es de segundo nivel, es el padre en el menú
                        $current_show_root_menu_item_id = $value->ID;
                        break;
                    case 3:
                        // Si es de tercer nivel, es hijo en el menú
                        $current_show_root_menu_item_id = $value->menu_item_parent;
                        break;
                }
            }
            array_push($level, $value->ID);
        }

        // Filtramos el menú por elementos de nivel 2 o superior que sean hijos o nietos el elemento raiz previamente identificado
        $sorted_menu_items_filtered = array();
        foreach ($sorted_menu_items as $value) {
            if ($value->item_level >= 2) {
                if ($value->ID == $current_show_root_menu_item_id
                || $value->menu_item_parent == $current_show_root_menu_item_id) {
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
