<?php


namespace App\Repository;


use App\Entity\CreditType;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseRepository;

class CreditTypeRepository
{
    private DatabaseRepository $dbRepo;
    private array $mapProps = [];

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(CreditType::class);
    }

    /**
     * @param int $id
     * @return CreditType|null
     */
    public function findOne(int $id): ?CreditType
    {
        $query = $this->getCreditQuery();
        $query .= ' WHERE id = :id';
        $results = $this->dbRepo->fetchEntities($query, [':id' => $id], $this->mapProps);
        return $results[0] ?? null;
    }

    /**
     * @return CreditType[]
     */
    public function findAll(): array
    {
        $query = $this->getCreditQuery();

        return $this->dbRepo->fetchEntities($query, [], $this->mapProps);
    }

    protected function getCreditQuery(): string
    {
        $select = $this->dbRepo->getSelect(CreditType::class, md5(CreditType::class), $this->mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM credit_type AS ' . $this->mapProps[CreditType::class] . ' ';

        return $query;
    }
}