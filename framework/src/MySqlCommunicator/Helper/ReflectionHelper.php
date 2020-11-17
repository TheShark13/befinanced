<?php


namespace MySqlCommunicator\Helper;


use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class ReflectionHelper
{
    /**
     * @param string $className
     * @return ReflectionProperty[]
     * @throws ReflectionException
     */
    public static function getClassProperties(string $className): array
    {
        $classProperties = [];

        $reflection = new ReflectionClass($className);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $classProperties[] = new ReflectionProperty($className, $property->name);
        }

        return $classProperties;
    }
}