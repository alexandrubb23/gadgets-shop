<?php declare(strict_types=1);

namespace App\View;

defined('APP_DIR') or die('No script kiddies please!');

class TwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * Global vars.
     *
     * @var array
     */
    protected $globals = [];

    /**
     * Class constructor.
     *
     * @param array $globals
     */
    public function __construct(array $globals)
    {
        $this->globals = $globals;
    }

    /**
     * Get global vars.
     *
     * @return array
     */
    public function getGlobals(): array
    {
        return $this->globals;
    }
}
