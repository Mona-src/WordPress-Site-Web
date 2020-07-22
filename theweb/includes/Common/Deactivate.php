<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb\Common;

class Deactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}