<?php

use App\Support\Facades\View;

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @return \App\Support\Facades\View
     */
    function view($view, $data = [])
    {
        return View::display($view, $data);
    }
}

if (! function_exists('is_ssl')) {
    /**
     * Determines if SSL is used.
     *
     * @return bool True if SSL, otherwise false.
     */
    function is_ssl()
    {
        if (isset($_SERVER['HTTPS'])) {
            if ('on' == strtolower($_SERVER['HTTPS'])) {
                return true;
            }

            if ('1' == $_SERVER['HTTPS']) {
                return true;
            }
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        }
        return false;
    }
}

if (! function_exists('app_url')) {
    /**
     * Get absolute url.
     *
     * @param  string|null $path Path
     *
     * @return string
     */
    function app_url(string $path = null)
    {
        $protocol = 'http://';
        if (is_ssl()) {
            $protocol = 'https://';
        }

        $port = (isset($_SERVER['SERVER_PORT'])) ? ':' . $_SERVER['SERVER_PORT'] : '';
        return sprintf('%s%s%s', $protocol, $_SERVER['SERVER_NAME'] . $port, $path);
    }
}
