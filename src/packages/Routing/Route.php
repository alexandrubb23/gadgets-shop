<?php declare(strict_types=1);

namespace AlxCart\Routing;

use App\Http\Controllers\Controller;

class Route
{
    /**
     * Default controller.
     *
     * @var string
     */
    const DEFAULT_ROUTE = 'home';
    
    /**
     * @var string
     */
    private $uri;

    /**
     * Class constructor.
     * 
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Dummy HTTP GET request.
     *
     * @param string $uri   
     * @param string $action
     */
    public function get(string $uri, string $action): void
    {
        $this->uri = $uri;
        $this->controller->setAction($action);

        $this->controller();
    }
    
    /**
     * Get params.
     *
     * @return string
     */
    public function getParams(string $request = null): string
    {
        return preg_replace("/.*\\/(.*)$/", "$1", $request ?? $this->getRequest());
    }

    /**
     * Get request path.
     *
     * @return string
     */
    public function getRequest(): string
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        return preg_replace("/[^a-zA-Z0-9\/]/", '', $path);
    }

    /**
     * Get route.
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Match route.
     *
     * @return string
     */
    protected function matchRoute(): string
    {
        if (! $this->isRealRoute()) {
            return $this->getUri();
        }

        return $this->getRealRoute();
    }

    /**
     * Get formated route.
     *
     * @return string|null
     */
    public function getRealRoute()
    {
        if (! $this->getRequest()) {
            return;
        }
        
        $uri = $this->getUri();

        preg_match("/^{.*?}$/", $this->getParams($uri), $matches);
        if (empty($matches)) {
            return;
        }

        return str_replace($matches[0], basename($this->getRequest()), $uri);
    }

    /**
     * Is Controller.
     *
     * @return boolean
     */
    public function isController(): bool
    {
        $request = $this->getRequest();
        if (! $request) {
            $request = self::DEFAULT_ROUTE;
        }
        
        return $request === $this->matchRoute();
    }

    /**
     * Route exist.
     *
     * @return boolean
     */
    private function isRealRoute(): bool
    {
        return $this->getRealRoute() === $this->getRequest();
    }

    /**
     * Route controller
     *
     * @return null|void
     */
    public function controller()
    {
        if (! $this->isController()) {
            return;
        }
        
        $this->controller
            ->invokeMethod()
            ->withParams($this->getParams())
            ->call();
        ;
    }
}
