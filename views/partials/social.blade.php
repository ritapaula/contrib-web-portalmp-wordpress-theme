@if (UVigoThemeWPApp\display_social_share())
    <div id="share-buttons" class="share-buttons">
        <button type="button" class="btn btn-share" data-icon="&#xe0a0;"><span class="sr-only">{{ __( 'Show share buttons', 'uvigothemewp' ) }}</span></button>
        <div class="share-buttons-container">
            <div class="addthis_sharing_toolbox"></div>
        </div>
    </div>
    <script type="text/javascript">
        var addthis_config = { "services_exclude": "print", "lang": "{{ locale_get_primary_language(get_locale()) }}", "ui_language": "{{ locale_get_primary_language(get_locale()) }}" };
    </script>
@endif
