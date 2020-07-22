<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb\Admin;

use TheWeb\Manage\Emails;

class Panel
{
    private $links = [
        '<a href="admin.php?page=theweb_plugin">Settings</a>'
    ];

    /**
     * Initialize the plugin interface for the user.
     */
    public function register()
    {
        add_action('admin_menu', [$this, 'add_admin_panel']);
        add_filter('plugin_action_links_' . PLUGIN_BASENAME, [$this, 'add_links']);
        add_action('admin_post_photos_form', [$this, 'send_to_registered']);
    }

    public function send_to_registered()
    {
        $manageEmail = new Emails();
        $manageEmail->send_to_registered();
    }

    /**
     * Add a link to the admin panel on the side menu.
     */
    public function add_admin_panel()
    {
        add_menu_page(
            'The Web Plugin',
            'The Web',
            'manage_options',
            'theweb_plugin',
            [$this, 'admin_index'],
            'dashicons-buddicons-activity'
        );
        add_submenu_page(
            'theweb_plugin',
            'Créer un utilisateur',
            'Créer un utilisateur',
            'manage_options',
            'theweb_create',
            [$this, 'admin_create']
        );
        add_submenu_page(
            'theweb_plugin',
            'Liste des utilisateurs',
            'Liste des utilisateurs',
            'manage_options',
            'theweb_read',
            [$this, 'admin_read']
        );
        add_submenu_page(
            'theweb_plugin',
            'Modifier un utilisateur',
            'Modifier un utilisateur',
            'manage_options',
            'theweb_update',
            [$this, 'admin_update']
        );
    }

    /**
     * Register the admin panel template file.
     */
    public function admin_index()
    {
        require_once(PLUGIN_DIR_BASENAME . 'templates/admin.php');
    }

    public function admin_create()
    {
        require_once(PLUGIN_DIR_BASENAME . 'templates/admin-create.php');
    }

    public function admin_read()
    {
        require_once(PLUGIN_DIR_BASENAME . 'templates/admin-read.php');
    }

    public function admin_update()
    {
        require_once(PLUGIN_DIR_BASENAME . 'templates/admin-update.php');
    }

    /**
     * Add links under the plugin name on the
     * plugin page.
     *
     * @param [array] $links
     * @return array
     */
    public function add_links($links)
    {
        foreach ($this->links as $link) {
            array_push($links, $link);
        };

        return $links;
    }
}
