<?php declare(strict_types=1);

namespace AlxCart\Controller;

use ReflectionClass;
use InvalidArgumentException;

class Controller
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    protected $params;

    /**
     * Set action.
     * 
     * @param string $action
     * @return void
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * Caller.
     * 
     * @return string
     */
    private function caller(): string
    {
        $namespace = (new ReflectionClass(static::class))
            ->getNamespaceName();
            
        return $namespace . '\\' . $this->className();
    }

    /**
     * Get requested controller and his method(s) using __call interceptor.
     * 
     * @param  $method
     * @param  $args  
     * @return null|string       
     */
    public function __call($method, $args)
    {
        if (! in_array($method, ['className', 'method'])) {
            throw new \Exception("[$method] is not allowed.");
        }

        preg_match('/(?<className>\w+)@(?<method>\w+)/', $this->action, $matches);
        if (empty($matches)) {
            return;
        }
        
        return $matches[$method];
    }

    /**
     * @inheritdoc
     */
    public function invokeMethod(): self
    {
        $method = $this->method();
        
        $reflection = new ReflectionClass($this->caller());
        if ($reflection->hasMethod($method)) {
            $this->method = $method;
            return $this;
        }

        throw new InvalidArgumentException(sprintf(
            'The controller method "%s" has been not defined.',
            $method
        ));
    }

    /**
     * @inheritdoc
     */
    public function withParams(string $params): self
    {
        $this->params = explode(',', $params);   
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function call(): void
    {
        call_user_func_array([
            $this->resolve($this->caller()), $this->method
        ], $this->params);
    }
}
