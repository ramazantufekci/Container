<?php
namespace DRN\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundInterface;
use Exception;
use ReflectionClass;
use ReflectionParameter; 
class AppContainer implements ContainerInterface{
    
    protected $instances = [];
    
    public function get(string $id)
    {
        
        if($this->has($id)){
            return $this->instances[$id];
        }
        $instance = $this->createObject($id);
        $this->instances[$id]=$instance;
        return $instance;
    }

    public function has(string $id):bool
    {
        var_export($id);
        return isset($this->instances[$id]);
    }

    public function createObject($className)
    {
        if(!class_exists($className)){
            throw new Exception("Class: {$className} bulunamadı");
        }

        $reflectionClass = new ReflectionClass($className);

        if($reflectionClass->getConstructor()==null){
            return new $className;
        }

        $parameters = $reflectionClass->getConstructor()->getParameters();
        $dependencies = $this->buildDependencies($parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    /**
     * @param ReflectionParameter[] $parameters
     * @return array
     * 
     */
    public function buildDependencies($parameters)
    {
        $dependencies = [];
        foreach($parameters as $parameter){
            $dependencies[] = $this->createObject($parameter->getClass()->getName());
        }
        return $dependencies;
    }
}