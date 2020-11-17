<?php


namespace MySqlCommunicator\Mapper;


use DateTime;
use MySqlCommunicator\Database\DatabaseRepository;
use ReflectionClass;
use ReflectionProperty;

class EntityMapper
{
    protected string $className;
    protected array $data;
    protected $entity;
    protected array $entityPrefixMap;

    public function __construct(string $className, array $data, array $entityPrefixMap)
    {
        $this->className = $className;
        $this->data = $data;
        $this->entityPrefixMap = $entityPrefixMap;
        $this->entity = new $this->className();
    }

    public function getEntity(string $className)
    {
        $entity = new $className();
        $reflection = new ReflectionClass($className);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $this->valueMap($property, $entity);
        }

        return $entity;
    }

    protected function valueMap(object $property, $entity)
    {
        $reflectionProperty = new ReflectionProperty(get_class($entity), $property->name);

        $keyName = $this->entityPrefixMap[get_class($entity)].'_'.$property->name;
        $value = $this->getValidValue($keyName, $reflectionProperty);

        $methodName = 'set' . ucfirst($property->name);
        $entity->$methodName($value);
    }

    protected function getValidValue(string $keyName, ReflectionProperty $property)
    {
        $propType = $property->getType()->getName();

        if(isset($this->entityPrefixMap[$propType]) && isset($this->data[$this->entityPrefixMap[$propType].'_id'])) {
            $value = $this->getEntity($propType);
        }
        elseif (isset($this->data[$keyName])) {
            $value = $this->data[$keyName];
        } else {
            $value = null;
        }

        if ($propType === DateTime::class) {
            $value = (new DateTime())->setTimestamp(strtotime($value));
        }

        return $value;
    }
}