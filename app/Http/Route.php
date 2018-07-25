<?php

namespace LinkAcademy\Gadgets\Commons\Http;

class Route extends Controller
{
    const DEFAULT_CONTROLLER = 'home';

    /**
     * Class constructor
     *
     * @param string $uri    Uri path
     * @param string $action Action
     */
    public function get(string $uri, string $action)
    {
        $this->uri = $uri;
        $this->action = $action;

        $this->routes();
    }

    /**
     * Get controller
     *
     * @return tring
     */
    public function getController()
    {
        return preg_replace("/(.*)\\@.*$/", "$1", $this->action);
    }
    /**
     * Get action
     *
     * @return action
     */
    public function getAction()
    {
        return preg_replace("/.*\\@(.*)$/", "$1", $this->action);
    }
    
    /**
     * Get params
     *
     * @return string
     */
    public function getParams()
    {
        return preg_replace("/.*\\/(.*)$/", "$1", $this->getRequest());
    }

    /**
     * Get request path
     *
     * @return strint
     */
    public function getRequest()
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return preg_replace("/[^a-zA-Z0-9\/]/", '', $path);
    }

    /**
     * Get route
     *
     * @return string
     */
    protected function getUri()
    {
        return $this->uri;
    }

    /**
     * Match route
     *
     * @return string
     */
    protected function matchRoute()
    {
        if (! $this->canMatch()) {
            return;
        }

        $getParam = preg_replace('/.*\\/(.*)$/', "$1", $this->getUri());

        preg_match("/^{.*?}$/", $getParam, $matches);
        if ($matches) {
            $param = array_pop(explode('/', $this->getRequest()));
            return str_replace($matches[0], $param, $this->getUri());
        }

        return $this->getUri();
    }

    /**
     * Run controller
     *
     * @return boolean
     */
    public function controller()
    {
        $request = $this->getRequest();
        if (! $request) {
            $request = self::DEFAULT_CONTROLLER;
        }

        return $request === $this->matchRoute();
    }

    /**
     * Count data
     *
     * @param  string $data Data to be counted
     *
     * @return int
     */
    private function count(string $data)
    {
        return count(explode('/', $data));
    }

    /**
     * Cn match
     *
     * @return boolean
     */
    private function canMatch()
    {
        return $this->count($this->getUri()) === $this->count($this->getRequest());
    }

    /**
     * Route controller
     *
     * @return void
     */
    public function routes()
    {
        if ($this->controller()) {
            $this->setController($this->getController());
            $this->setAction($this->getAction());
            $this->setParams($this->getParams());
            
            $this->run();
        }
    }
}
