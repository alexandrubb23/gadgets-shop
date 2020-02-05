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
     * Class constructor.
     *
     * @param string $uri   
     * @param string $action
     */
    public function get(string $uri, string $action)
    {
        $this->uri = $uri;
        $this->action = $action;

        $this->routes();
    }

    /**
     * Get controller.
     *
     * @return string
     */
    public function getController(): string
    {
        return preg_replace("/(.*)\\@.*$/", "$1", $this->action);
    }
    
    /**
     * Get action.
     *
     * @return string
     */
    public function getAction(): string
    {
        return preg_replace("/.*\\@(.*)$/", "$1", $this->action);
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

        preg_match("/^{.*?}$/", $this->getParams($this->getUri()), $matches);
        if (empty($matches)) {
            return;
        }

        return str_replace($matches[0], basename(
            $this->getRequest()
        ), $this->getUri());
    }

    /**
     * Controller exist.
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
            ->setAction($this->getAction())
            ->setParams($this->getParams())
        ;
        
        $this->run();
    }

    /**
     * Get full class controller including namespace.
     *
     * @return string
     */
    private function getFullClassController(): string
    {
        return __NAMESPACE__ . '\\Controllers\\' . $this->getController();
    }
}