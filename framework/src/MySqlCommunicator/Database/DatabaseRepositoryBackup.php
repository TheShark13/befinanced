<?php


namespace MySqlCommunicator\Database;


use App\Entity\UserRole;
use MySqlCommunicator\Helper\ReflectionHelper;
use MySqlCommunicator\Mapper\EntityMapper;
use PDO;
use PDOStatement;
use ReflectionException;
use ReflectionProperty;

class DatabaseRepositoryBackup
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

    public function fetchEntity(int $id, array $opts = [])
    {
        $result = $this->getQueryResult($this->selectEntity(['id' => $id], $opts));

        return (new EntityMapper($this->className, $result, $this->propsValues))->getEntity($this->className);
    }

    public function getConnection(): PDO
    {
        return $this->dbConnection;
    }

    protected function selectEntity(array $condition, array $opts = [])
    {
        $joins = '';
        $select = $this->getSelect($this->className, 0);
        foreach ($this->propsValues as $field => $joinClass) {
            $joins .= ' LEFT JOIN ' . $this->getDefaultTableName($joinClass) . ' ' . $field . ' ON s0.' . $this->propsFields[$field] . ' = ' . $field . '.id ';
        }

        $query = 'SELECT ';
        foreach ($select as $tableAlias => $field) {
            $query .= explode('_', $tableAlias)[0] . '.' . $field . ' AS ' . $tableAlias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM ' . $this->tableName . ' AS s0 ';

        $query .= $joins;

        $query .= 'WHERE s0.id = :id';

        var_dump($query);
        exit;

        $sth = $this->dbConnection->prepare($query);
        $sth->bindValue(':id', 1);

        return $sth;
    }

    protected function getSingleSelectFromIdStatement(int $id, array $opts)
    {
        $prefixOrd = 0;
        $joins = '';
        $select['s' . $prefixOrd] = $this->getSelect($this->className, $prefixOrd);
        if (isset($opts['join'])) {
            foreach ($opts['join'] as $field => $joinClass) {
                ++$prefixOrd;
                $select['s' . $prefixOrd] = $this->getSelect($joinClass, $prefixOrd);
                $joins .= ' LEFT JOIN ' . $this->getDefaultTableName($joinClass) . ' ' . 's' . $prefixOrd . ' ON s0.' . $field . ' = ' . 's' . $prefixOrd . '.id ';
            }
        }

        $query = 'SELECT ';
        foreach ($select as $tableAlias => $fields) {
            foreach ($fields as $alias => $columnName) {
                $query .= $tableAlias . '.' . $columnName . ' AS ' . $alias . ',';
            }
        }
        $query = rtrim($query, ',');
        $query .= ' FROM ' . $this->tableName . ' AS s0 ';

        $query .= $joins;

        $query .= 'WHERE s0.id = :id';

        $sth = $this->dbConnection->prepare($query);
        $sth->bindValue(':id', $id);

        return $sth;
    }

    /**
     * @param string $className
     * @param int $prefixOrder
     * @return array
     * @throws ReflectionException
     */
    protected function getSelect(string $className, $prefixOrder)
    {
        $select = [];
        $this->propsValues['s' . $prefixOrder] = $className;
        $proprieties = ReflectionHelper::getClassProperties($className);
        foreach ($proprieties as $property) {
            $name = $property->getName();
            $type = $property->getType()->getName();
            $key = 's' . $prefixOrder . '_' . $property->getName();
            if (strpos($type, 'App\Entity') !== false) {
                $prefix = md5($type);
                $name .= "Id";
                $this->propsFields['s' . $prefix] = camelToUnderscore($name);
                $select = array_merge($select, $this->getSelect($type, $prefix));
            }
            $select[$key] = camelToUnderscore($name);
        }

        return $select;
    }

    protected function getQueryResult(PDOStatement $sth)
    {
        $sth->execute();

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    protected function getDefaultTableName(string $className)
    {
        $name = explode('\\', $className);
        return camelToUnderscore(end($name));
    }
}