<?php

namespace LinkAcademy\Gadgets\Commons\View;

class TwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * Global vars
     *
     * @var array
     */
    protected $globals = [];

    /**
     * Class constructor
     *
     * @param array $globals An array of global variables
     */
    public function __construct(array $globals)
    {
        $this->globals = $globals;
    }

    /**
     * Get global vars
     *
     * @return array
     */
    public function getGlobals()
    {
        return $this->globals;
    }
}
