<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit123dbff6cea0ef98b0ad25db9580dfa7
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpFtp' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit123dbff6cea0ef98b0ad25db9580dfa7::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
