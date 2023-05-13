<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc96d7d917d28b3095a4afdf3ec82994e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc96d7d917d28b3095a4afdf3ec82994e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc96d7d917d28b3095a4afdf3ec82994e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc96d7d917d28b3095a4afdf3ec82994e::$classMap;

        }, null, ClassLoader::class);
    }
}
