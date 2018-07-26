<?php

namespace LinkAcademy\Gadgets\Commons;

use Twig_Environment;
use Twig_Loader_Filesystem;
use LinkAcademy\Gadgets\Commons\TwigExtension;

class Twig
{
    const VIEWS_DIR = '/views/templates/electro/';

    /**
     * @var object
     */
    private $twig;

    /**
     * Get Twig.
     *
     * @return \Twig_Environment
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(self::getTemplateDir());
        $this->twig = new Twig_Environment($loader);

        $this->twig->addExtension(new TwigExtension(self::globalVars()));
    }

    /**
     * Displays a template.
     *
     * @param  string $template The template name
     * @param  array  $args     An array of parameters to pass to the template
     *
     * @return \Twig_Environment
     */
    public function display(string $template, array $args = [])
    {
        return $this->twig->display($template, $args);
    }

    /**
     * Set global variables.
     *
     * @return array
     */
    protected static function globalVars()
    {
        return [
            'template_path' => app_url(self::VIEWS_DIR)
        ];
    }

    /**
     * Get template dir
     *
     * @return string
     */
    public static function getTemplateDir()
    {
        return APP_DIR . self::VIEWS_DIR;
    }
}
