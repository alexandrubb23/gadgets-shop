<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Contracts;

interface ControllerInterface
{
    /**
     * Set controller
     *
     * @param string $controller Contrller to be set
     * @throws InvalidArgumentException
     *
     */
    public function setController(string $controller);

    /**
     * Set action
     *
     * @param string $action Action name
     * @throws InvalidArgumentException
     */
    public function setAction(string $action);

    /**
     * Set params
     *
     * @param string
     */
    public function setParams(string $params);

    /**
     * Run a controller
     *
     * @return void
     */
    public function run(): void;
}
