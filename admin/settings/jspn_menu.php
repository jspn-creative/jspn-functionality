<?php

    /**
     * Create menu item
     *
     * @since  1.0.1
     * @access public
     * @return void
     */
    function jspn_menu() {
        add_menu_page(
            'Jaspin Theme Settings',
            'JSPN Settings',
            'manage_options',
            'jspn',
            array($this,'settings_markup'),
            'dashicons-admin-generic',
            100
        );
    }

    /**
     * Load the settings template
     *
     * @since  1.0.1
     * @access public
     * @return void
     */
    function jspn_settings_markup(){
        if (!current_user_can('manage_options')) {
            return;
        }
    include( JSPN_PLUGIN_DIR . 'admin/templates/settings-page.php');
    }

    /**
     * Link from plugin page to settings
     *
     * @since  1.0.1
     * @access private
     * @return void
     */
    function jspn_add_settings_link($links){
        $settings_link='<a href="admin.php?page=jspn">' . __('Settings') . '</a>';
        array_push($links, $settings_link);
        return $links;
    }