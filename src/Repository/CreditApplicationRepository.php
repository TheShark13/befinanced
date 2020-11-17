<?php


namespace App\Repository;


use App\Entity\CreditApplication;
use App\Entity\CreditApplicationInformations;
use App\Entity\CreditType;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseConnection;
use MySqlCommunicator\Database\DatabaseRepository;
use MySqlCommunicator\Helper\ReflectionHelper;

class CreditApplicationRepository
{
    private DatabaseRepository $dbRepo;

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(CreditApplication::class);
    }

    public function findApplicationsForUser(int $userId)
    {
        $mapProps = [];
        $select = $this->dbRepo->getSelect(CreditApplication::class, md5(CreditApplication::class), $mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM credit_application AS ' . $mapProps[CreditApplication::class] . ' ';
        $query .= 'LEFT JOIN user AS ' . $mapProps[User::class] . ' ON ' . $mapProps[User::class] . '.id = ' . $mapProps[CreditApplication::class] . '.applicant_id ';
        $query .= 'LEFT JOIN credit_type AS ' . $mapProps[CreditType::class] . ' ON ' . $mapProps[CreditType::class] . '.id = ' . $mapProps[CreditApplication::class] . '.credit_type_id ';
        $query .= 'LEFT JOIN user_role AS ' . $mapProps[UserRole::class] . ' ON ' . $mapProps[User::class] . '.role_id = ' . $mapProps[UserRole::class] . '.id ';
        $query .= 'LEFT JOIN user_profile AS ' . $mapProps[UserProfile::class] . ' ON ' . $mapProps[User::class] . '.user_profile_id = ' . $mapProps[UserProfile::class] . '.id ';
        $query .= 'LEFT JOIN credit_application_informations AS ' . $mapProps[CreditApplicationInformations::class] . ' ON ' . $mapProps[CreditApplication::class] . '.credit_application_informations_id = ' . $mapProps[CreditApplicationInformations::class] . '.id ';

        return $this->dbRepo->fetchEntities($query, [':userId' => $userId], $mapProps);
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