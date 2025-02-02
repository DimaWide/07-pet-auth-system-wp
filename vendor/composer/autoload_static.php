<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc18c75f18131b6e7e1d62733480fdbd2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AuthSystemWp\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AuthSystemWp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc18c75f18131b6e7e1d62733480fdbd2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc18c75f18131b6e7e1d62733480fdbd2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc18c75f18131b6e7e1d62733480fdbd2::$classMap;

        }, null, ClassLoader::class);
    }
}
