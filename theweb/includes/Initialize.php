<?php

/**
 * @package theweb_plugin
 */

namespace TheWeb;

class Initialize
{
    /**
     * Return an array of all the classes that
     * need to be initialized.
     *
     * @return array Classes to be initialized.
     */
    public static function get_ressources()
    {
        return [
            Admin\Panel::class,
            Admin\Enqueue::class
        ];
    }

    /**
     * If it exists, call the register method of
     * every given classes.
     */
    public static function register()
    {
        foreach (self::get_ressources() as $class) {
            $ressource = self::instantiate($class);
            if (method_exists($ressource, 'register')) {
                $ressource->register();
            };
        };
    }

    /**
     * Instantiate the given class.
     *
     * @param [class] $class
     * @return class
     */
    private static function instantiate($class)
    {
        return new $class();
    }

    
}
