<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3c413fae73d4ccf881181307de4ab325
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Studypeers\\CanvasApi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Studypeers\\CanvasApi\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3c413fae73d4ccf881181307de4ab325::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3c413fae73d4ccf881181307de4ab325::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
