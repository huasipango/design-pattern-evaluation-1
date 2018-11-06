<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit29b3e3e53411873eadd35c40b6111a47
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/php-sdk-v4/src/Facebook',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit29b3e3e53411873eadd35c40b6111a47::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit29b3e3e53411873eadd35c40b6111a47::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}