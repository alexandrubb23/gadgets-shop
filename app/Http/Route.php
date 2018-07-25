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
        # there is no route, go home
        if (! $this->isRealRoute()) {
            return $this->getUri();
        }

        return $this->getRealRoute();
    }

    /**
     * Get formated route
     *
     * @return string|null
     */
    public function getRealRoute()
    {
        if (! $this->getRequest()) {
            return;
        }

        $getParam = preg_replace('/.*\\/(.*)$/', "$1", $this->getUri());

        preg_match("/^{.*?}$/", $getParam, $matches);
        if (! empty($matches)) {
            $uri = explode('/', $this->getRequest());
            $param = array_pop($uri);
            return str_replace($matches[0], $param, $this->getUri());
        }
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
     * Cn match
     *
     * @return boolean
     */
    private function isRealRoute()
    {
        return $this->getRealRoute() === $this->getRequest();
    }

    /**
     * Route controller
     *
     * @return void
     */
    public function routes()
    {
        if ($this->controller()) {
            $this
                ->setController($this->getController())
                ->setAction($this->getAction())
                ->setParams($this->getParams())
            ;
            
            $this->run();
        }
    }
}
