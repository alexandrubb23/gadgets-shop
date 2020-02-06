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
    public function setMethod(string $action);

    /**
     * Set params
     *
     * @param string
     */
    public function setParams(string $params);

    /**
     * Call a controller
     *
     * @return void
     */
    public function call(): void;
}
