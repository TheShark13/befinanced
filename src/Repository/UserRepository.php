<?php


namespace App\Repository;


use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserRole;
use MySqlCommunicator\Database\DatabaseRepository;

class UserRepository
{
    private DatabaseRepository $dbRepo;
    private array $mapProps = [];

    public function __construct()
    {
        $this->dbRepo = new DatabaseRepository(User::class);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $query = $this->getQueryForUsers();

        return $this->dbRepo->fetchEntities($query, [], $this->mapProps);
    }

    public function deleteUser(User $user): void
    {
        $conn = $this->dbRepo->getConnection();

        if($user->getUserProfile()) {
            $sql = 'DELETE FROM user_profile WHERE id = :id;';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $user->getUserProfile()->getId());
            $stmt->execute();
        }

        $sql = 'DELETE FROM user WHERE id = :id;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();

        unset($user);
    }

    public function findUserByEmail(string $email): ?User
    {
        $query = $this->getQueryForUsers();
        $query .= ' WHERE ' . $this->mapProps[User::class] . '.email = :email ';
        $query .= 'LIMIT 1';

        $result = $this->dbRepo->fetchEntities($query, [':email' => $email], $this->mapProps);
        return $result[0] ?? null;
    }

    public function findUserById(int $id): ?User
    {
        $query = $this->getQueryForUsers();
        $query .= ' WHERE ' . $this->mapProps[User::class] . '.id = :id ';
        $query .= 'LIMIT 1';

        $result = $this->dbRepo->fetchEntities($query, [':id' => $id], $this->mapProps);
        return $result[0] ?? null;
    }

    protected function getQueryForUsers(): string
    {
        $select = $this->dbRepo->getSelect(User::class, md5(User::class), $this->mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM user AS ' . $this->mapProps[User::class] . ' ';

        $query .= ' LEFT JOIN user_role AS ' . $this->mapProps[UserRole::class] . ' ON ' . $this->mapProps[User::class] . '.role_id = ' . $this->mapProps[UserRole::class] . '.id ';
        $query .= ' LEFT JOIN user_profile AS ' . $this->mapProps[UserProfile::class] . ' ON ' . $this->mapProps[User::class] . '.user_profile_id = ' . $this->mapProps[UserProfile::class] . '.id ';

        return $query;
    }
}