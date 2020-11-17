<?php


namespace MySqlCommunicator\Database;


use App\Entity\UserRole;
use MySqlCommunicator\Helper\ReflectionHelper;
use MySqlCommunicator\Mapper\EntityMapper;
use PDO;
use PDOStatement;
use ReflectionException;
use ReflectionProperty;

class DatabaseRepository
{
    protected PDO $dbConnection;
    protected string $className;
    protected string $tableName;
    protected array $propsValues;
    protected array $propsFields = [];
    /**
     * @var ReflectionProperty[]
     */
    protected array $entityProperties;

    /**
     * DatabaseRepository constructor.
     * @param string $className
     * @param string|null $tableName
     * @throws ReflectionException
     */
    public function __construct(string $className, string $tableName = null)
    {
        $this->dbConnection = DatabaseConnection::getConnection();

        $this->className = $className;
        if (!$tableName) {
            $this->tableName = $this->getDefaultTableName($className);
        } else {
            $this->tableName = $tableName;
        }
        $this->entityProperties = ReflectionHelper::getClassProperties($className);
    }

    public function fetchEntities(string $statement, array $params, array $aliases)
    {
        $stm = $this->dbConnection->prepare($statement);
        foreach ($params as $key => $value) {
            $stm->bindValue($key, $value);
        }

        $result = $this->getQueryResult($stm);
        $entities = [];
        foreach ($result as $dataMap) {
            $entities[] = (new EntityMapper($this->className, $dataMap, $aliases))->getEntity($this->className);
        }

        return $entities;
    }

    public function getConnection(): PDO
    {
        return $this->dbConnection;
    }

    public function getSelect($type, $prefix, &$mapProps) {
        $select = [];
        $mapProps[$type] = 's' . $prefix;
        $proprieties = ReflectionHelper::getClassProperties($type);
        foreach ($proprieties as $property) {
            $name = $property->getName();
            $type = $property->getType()->getName();
            $key = 's' . $prefix . '_' . $property->getName();
            if (strpos($type, 'App\Entity') !== false) {
                $newPrefix = md5($type);
                $name .= "Id";
                $select = array_merge($select, $this->getSelect($type, $newPrefix, $mapProps));
            }
            $select[$key] = camelToUnderscore($name);
        }

        return $select;
    }


    protected function getQueryResult(PDOStatement $sth)
    {
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getDefaultTableName(string $className)
    {
        $name = explode('\\', $className);
        return camelToUnderscore(end($name));
    }
}