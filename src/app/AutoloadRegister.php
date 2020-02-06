<?php

namespace LinkAcademy\Gadgets\Commons;

class AutoloadRegister
{
    /**
     * Load classes
     *
     * @return void
     */
    public static function init(): void
    {
        spl_autoload_register([new static(), 'load'], true);
    }

    /**
     * Loader class.
     *
     * @param string $class Class name
     *
     * @return null|string
     */
    protected function load($class)
    {
        $chunks = explode(__NAMESPACE__, $class, 2);
        if (! isset($chunks[1])) {
            return;
        }

        $classPath = sprintf(
            '%s/app%s.php',
            APP_DIR,
            str_replace('\\', DIRECTORY_SEPARATOR, $chunks[1])
        );

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
