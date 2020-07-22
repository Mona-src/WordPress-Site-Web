<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb\Admin;

class Enqueue
{
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        $this->enqueue_script();
        $this->enqueue_style();
    }

    public function enqueue_style()
    {
        wp_enqueue_style('admin_panel', PLUGIN_URL . '/assets/css/admin_panel.css');
        wp_enqueue_style('admin_create', PLUGIN_URL . '/assets/css/admin_create.css');
        wp_enqueue_style('admin_read', PLUGIN_URL . '/assets/css/admin_read.css');
        wp_enqueue_style('admin_update', PLUGIN_URL . '/assets/css/admin_update.css');
        wp_enqueue_style('admin_delete', PLUGIN_URL . '/assets/css/admin_delete.css');
        wp_enqueue_style('admin_header', PLUGIN_URL . '/assets/css/admin_header.css');
        wp_enqueue_style('admin_fonts', PLUGIN_URL . '/assets/fonts/fonts.css');
    }

    public function enqueue_script()
    {
        wp_enqueue_script('createJS', PLUGIN_URL . '/assets/js/confirm.js', [], false, true);
    }
}
