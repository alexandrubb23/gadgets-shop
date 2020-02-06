<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\View;

defined('APP_DIR') or die('No script kiddies please!');

use Twig_Environment;
use Twig_Loader_Filesystem;
use LinkAcademy\Gadgets\Commons\View\TwigExtension;

class Twig
{
    /**
     * Template path.
     *
     * @todo Can be selected from db or config file...
     */
    const TEMPLATE_DIR = '/views/templates/electro';

    /**
     * Twig.
     * 
     * @var object
     */
    private $twig;

    /**
     * Class constructor.
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
     * @param  string $template
     * @param  array  $args
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
    protected static function globalVars(): array
    {
        return [
            'app_url' => app_url(),
            'template_path' => app_url(self::TEMPLATE_DIR)
        ];
    }

    /**
     * Get template dir
     *
     * @return string
     */
    public static function getTemplateDir(): string
    {
        return APP_DIR . self::TEMPLATE_DIR;
    }
}
