<?php


namespace App\Repository;


use App\Entity\CreditApplication;
use App\Entity\CreditApplicationInformations;
use App\Entity\CreditType;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseRepository;

class CreditApplicationRepository
{
    private DatabaseRepository $dbRepo;
    private array $mapProps = [];

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(CreditApplication::class);
    }

    public function findOneApplication(int $applicationId): ?CreditApplication
    {
        $query = $this->getQueryForApplications();
        $query .= ' WHERE ' . $this->mapProps[CreditApplication::class] . '.id = :applicationId ';

        $results = $this->dbRepo->fetchEntities($query, [':applicationId' => $applicationId], $this->mapProps);
        return count($results) ? $results[0] : null;
    }

    public function findApplicationsForUser(int $userId)
    {
        $query = $this->getQueryForApplications();
        $query .= ' WHERE ' . $this->mapProps[User::class] . '.id = :userId ';

        return $this->dbRepo->fetchEntities($query, [':userId' => $userId], $this->mapProps);
    }

    protected function getQueryForApplications(): string
    {
        $select = $this->dbRepo->getSelect(CreditApplication::class, md5(CreditApplication::class), $this->mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM credit_application AS ' . $this->mapProps[CreditApplication::class] . ' ';
        $query .= 'LEFT JOIN user AS ' . $this->mapProps[User::class] . ' ON ' . $this->mapProps[User::class] . '.id = ' . $this->mapProps[CreditApplication::class] . '.applicant_id ';
        $query .= 'LEFT JOIN credit_type AS ' . $this->mapProps[CreditType::class] . ' ON ' . $this->mapProps[CreditType::class] . '.id = ' . $this->mapProps[CreditApplication::class] . '.credit_type_id ';
        $query .= 'LEFT JOIN user_role AS ' . $this->mapProps[UserRole::class] . ' ON ' . $this->mapProps[User::class] . '.role_id = ' . $this->mapProps[UserRole::class] . '.id ';
        $query .= 'LEFT JOIN user_profile AS ' . $this->mapProps[UserProfile::class] . ' ON ' . $this->mapProps[User::class] . '.user_profile_id = ' . $this->mapProps[UserProfile::class] . '.id ';
        $query .= 'LEFT JOIN credit_application_informations AS ' . $this->mapProps[CreditApplicationInformations::class] . ' ON ' . $this->mapProps[CreditApplication::class] . '.credit_application_informations_id = ' . $this->mapProps[CreditApplicationInformations::class] . '.id ';

        return $query;
    }

    //TODO: De refacut partea de ORM
//    public function findOneById(int $id): User
//    {
//        return $this->dbRepo->fetchEntity($id, [
//            'join' => [
//                'credit_type_id' => CreditType::class,
//                'applicant_id' => User::class
//            ]
//        ]);
//    }
}