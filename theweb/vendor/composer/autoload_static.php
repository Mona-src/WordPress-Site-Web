<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd899e902e2e1cd16521874e0b51eeb4
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TheWeb\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TheWeb\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd899e902e2e1cd16521874e0b51eeb4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd899e902e2e1cd16521874e0b51eeb4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
