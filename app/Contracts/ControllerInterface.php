<?php

namespace LinkAcademy\Gadgets\Commons\Contracts;

interface ControllerInterface
{
    /**
     * Set controller
     *
     * @param string $controller Contrller to be set
     *
     */
    public function setController(string $controller);

    /**
     * Set action
     *
     * @param string $action Action name
     */
    public function setAction(string $action);

    /**
     * Set params
     *
     * @param string|array $params Action params
     */
    public function setParams($params);

    /**
     * Run a controller
     *
     * @return void
     */
    public function run();
}
