<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http;

class Route extends Controller
{
    /**
     * Default controller
     */
    const DEFAULT_ROUTE = 'home';

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
    public function getParams(string $request = null)
    {
        return preg_replace("/.*\\/(.*)$/", "$1", $request ?? $this->getRequest());
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

        preg_match("/^{.*?}$/", $this->getParams($this->getUri()), $matches);
        if (! empty($matches)) {
            $uri = explode('/', $this->getRequest());
            $param = array_pop($uri);
            return str_replace($matches[0], $param, $this->getUri());
        }
    }

    /**
     * Check if is controller
     *
     * @return boolean
     */
    public function isController()
    {
        $request = $this->getRequest();
        if (! $request) {
            $request = self::DEFAULT_ROUTE;
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
        if (! $this->isController()) {
            return;
        }
        
        $this
            ->setController($this->getFullClassController())
            ->setAction($this->getAction())
            ->setParams($this->getParams())
        ;
        
        $this->run();
    }

    /**
     * Get full class controller - including namespace.
     *
     * @return string
     */
    private function getFullClassController()
    {
        return __NAMESPACE__ . '\\' . $this->getController();
    }
}
