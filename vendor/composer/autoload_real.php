<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfc5e6f3de69a6ae75439a334e5952365
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitfc5e6f3de69a6ae75439a334e5952365', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfc5e6f3de69a6ae75439a334e5952365', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfc5e6f3de69a6ae75439a334e5952365::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
