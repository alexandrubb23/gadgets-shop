<?php

namespace LinkAcademy\Gadgets\Commons;

class AutoloadRegister
{
    /**
     * Load classes
     *
     * @see spl_autoload_register
     * @link http://php.net/manual/en/function.spl-autoload-register.php
     *
     * @return boolean
     */
    public static function init()
    {
        spl_autoload_register([
            new static(), 'load'
        ], true);
    }

    /**
     * Loader class
     *
     * @param  string $class Class name
     *
     * @return void
     */
    protected function load($class)
    {
        # split into the chunks
        $chunks = explode(__NAMESPACE__, $class, 2);
        if (! isset($chunks[1])) {
            return;
        }

        # generate the class file path
        $classPath = sprintf(
            '%s/app%s.php',
            APP_DIR,
            str_replace('\\', '/', $chunks[1])
        );

        # file not found, ignore
        if (! file_exists($classPath)) {
            return;
        }

        require $classPath;

        /**
         * If you want to enable debugging, you must
         * set the "GD_DEBUG" as true in app.php
         */
        if (! GD_DEBUG) {
            return;
        }

        if (! (class_exists($class, true) || interface_exists($class, true) || trait_exists($class, true))) {
            throw new \Exception(sprintf(
                'Class "%s" was expected to be in "%s" '
                . 'The file was found but the class was not.',
                $class,
                $classPath
            ));
        }
    }
}
