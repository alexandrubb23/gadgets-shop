<?php declare(strict_types=1);

namespace LinkAcademy\Gadgets\Commons\Http;

defined('APP_DIR') or die('No script kiddies please!');

class Route extends Controller
{
    /**
     * Default controller.
     *
     * @var string
     */
    const DEFAULT_ROUTE = 'home';

    /**
     * Dummy HTTP GET request.
     *
     * @param string $uri   
     * @param string $action
     */
    public function get(string $uri, string $action): void
    {
        $this->uri = $uri;
        $this->action = $action;

        $this->routes();
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
    protected function getUri(): string
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
        # there is no route, go home
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
    public function routes()
    {
        if (! $this->isController()) {
            return;
        }
        
        $this
            ->setController($this->getFullClassController())
            ->setMethod($this->method())
            ->setParams($this->getParams())
        ;
        
        $this->call();
    }

    /**
     * Get full class controller including namespace.
     *
     * @return string
     */
    private function getFullClassController(): string
    {
        return __NAMESPACE__ . '\\Controllers\\' . $this->controller();
    }
}
