<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc359481aa5c7eba5ae6eb3bbb48b4b7
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\ImageComparer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\ImageComparer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Grav\\Plugin\\ImageComparerPlugin' => __DIR__ . '/../..' . '/image-comparer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc359481aa5c7eba5ae6eb3bbb48b4b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc359481aa5c7eba5ae6eb3bbb48b4b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdc359481aa5c7eba5ae6eb3bbb48b4b7::$classMap;

        }, null, ClassLoader::class);
    }
}