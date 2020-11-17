<?php


namespace App\Repository;


use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseRepository;

class UserRepository
{
    private DatabaseRepository $dbRepo;

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(User::class);
    }

    public function findOneById(int $id): User
    {
        return $this->dbRepo->fetchEntity($id, [
            'join' => [
                'role_id' => UserRole::class,
                'user_profile_id' => UserProfile::class
            ]
        ]);
    }

    public function findOneByRoleName() {

        $conn = $this->dbRepo->getConnection();

        $sth = $conn->prepare('SELECT * FROM `user` AS u LEFT JOIN `user_role` AS ur ON ur.id = u.role_id WHERE ur.name LIKE :keyword GROUP BY u.id');
        $sth->bindValue(':keyword', "%CLIENT%", \PDO::PARAM_STR);

        $sth->execute();
        $result= $sth->fetchAll(\PDO::FETCH_ASSOC);

        dump($result);exit;
    }
}