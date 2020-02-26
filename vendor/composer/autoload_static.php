<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26edd45922c24cddb6acc9d8e0765146
{
    public static $files = array (
        '6124b4c8570aa390c21fafd04a26c69f' => __DIR__ . '/..' . '/myclabs/deep-copy/src/DeepCopy/deep_copy.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
        'R' => 
        array (
            'Ripcord\\' => 8,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Mpdf\\' => 5,
        ),
        'D' => 
        array (
            'DeepCopy\\' => 9,
        ),
        'A' => 
        array (
            'Ang3\\Component\\Odoo\\Client\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
        'Ripcord\\' => 
        array (
            0 => __DIR__ . '/..' . '/darkaonline/ripcord/src/Ripcord',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Mpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/mpdf/mpdf/src',
        ),
        'DeepCopy\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/deep-copy/src/DeepCopy',
        ),
        'Ang3\\Component\\Odoo\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/ang3/php-odoo-api-client/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26edd45922c24cddb6acc9d8e0765146::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26edd45922c24cddb6acc9d8e0765146::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
