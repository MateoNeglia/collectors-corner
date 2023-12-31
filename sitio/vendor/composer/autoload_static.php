<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc83ded93aed0fcdee50e98f2bdf3f6a7
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Collector\\Auth' => 
            array (
                0 => __DIR__ . '/../..' . '/classes/Auth',
            ),
            'Collector' => 
            array (
                0 => __DIR__ . '/../..' . '/classes',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc83ded93aed0fcdee50e98f2bdf3f6a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc83ded93aed0fcdee50e98f2bdf3f6a7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc83ded93aed0fcdee50e98f2bdf3f6a7::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitc83ded93aed0fcdee50e98f2bdf3f6a7::$classMap;

        }, null, ClassLoader::class);
    }
}
