<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 10.07.16
 * Time: 14:08
 */

spl_autoload_register(
    function ($class) {

        $classMap = [
            'Blog\BaseRequestHandler' => 'vendor/blog/base-request-handler/src/',
            'Blog\BlogComponent' => 'vendor/blog/blog-component/src/',
            'Blog\BlogModule' => 'vendor/blog/blog-module/src/',
            'Blog\Core' => 'vendor/blog/core/src/',
            'Blog\Db' => 'vendor/blog/db/src/',
            'Blog\SecurityComponent' => 'vendor/blog/security-component/src/',
            'Blog\SecurityModule' => 'vendor/blog/security-module/src/',
            'Blog\BlogApplication' => 'application/'
        ];

        foreach ($classMap as $key => $val) {
            if (($suffix = str_replace($key, '', $class)) != $class) {
                $suffix = str_replace('\\', '/', $suffix);
                $file = $val . $suffix . '.php';
                require $file;
                break;
            }
        }
    }
);