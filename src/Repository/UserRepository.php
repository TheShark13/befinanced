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

        $sql = 'DELETE FROM user WHERE id = :id;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();

        if ($user->getUserProfile()) {
            $sql = 'DELETE FROM user_profile WHERE id = :id;';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $user->getUserProfile()->getId());
            $stmt->execute();
        }

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

    /**
     * @return UserRole|null
     */
    public function findRoleById(int $id): ?UserRole
    {
        $dbRepoUserRoles = new DatabaseRepository(UserRole::class);
        $mapProps = [];
        $select = $dbRepoUserRoles->getSelect(UserRole::class, md5(UserRole::class), $mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM user_role AS ' . $mapProps[UserRole::class] . ' ';
        $query .= ' WHERE id = :id';
        $result = $dbRepoUserRoles->fetchEntities($query, [':id' => $id], $mapProps);
        return $result[0] ?? null;
    }

    /**
     * @return UserRole[]
     */
    public function findAllRoles(): array
    {
        $dbRepoUserRoles = new DatabaseRepository(UserRole::class);
        $mapProps = [];
        $select = $dbRepoUserRoles->getSelect(UserRole::class, md5(UserRole::class), $mapProps);
        $query = 'SELECT ';
        foreach ($select as $alias => $columnName) {
            $query .= explode('_', $alias)[0] . '.' . $columnName . ' AS ' . $alias . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' FROM user_role AS ' . $mapProps[UserRole::class] . ' ';

        return $dbRepoUserRoles->fetchEntities($query, [], $mapProps);
    }

    public function insert(User $user): void
    {
        $conn = $this->dbRepo->getConnection();

        if (!$user->getUserProfile()->getId()) {
            $userProfileID = $this->insertUserProfile($user->getUserProfile());
            $user->getUserProfile()->setId($userProfileID);
        } else {
            $this->updateUserProfile($user->getUserProfile());
        }

        $sql = 'INSERT INTO user (email, password, role_id, user_profile_id) VALUES (:email, :password, :roleId, :userProfile)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':roleId', $user->getRole()->getId());
        $stmt->bindValue(':userProfile', $user->getUserProfile()->getId());

        $stmt->execute();
    }

    public function update(User $user): void
    {
        $conn = $this->dbRepo->getConnection();

        if (!$user->getUserProfile()->getId()) {
            $userProfileID = $this->insertUserProfile($user->getUserProfile());
            $user->getUserProfile()->setId($userProfileID);
        } else {
            $this->updateUserProfile($user->getUserProfile());
        }

        $sql = 'UPDATE user SET email = :email, password = :password, role_id = :roleId, updated = :updated, user_profile_id = :userProfile  WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':roleId', $user->getRole()->getId());
        $stmt->bindValue(':updated', date('Y-m-d H:i:s'));
        $stmt->bindValue(':userProfile', $user->getUserProfile()->getId());
        $stmt->bindValue(':id', $user->getId());

        $stmt->execute();
    }

    public function insertUserProfile(UserProfile $profile): int
    {
        $conn = $this->dbRepo->getConnection();

        $sql = 'INSERT INTO user_profile (first_name, last_name, phone_number, nin, created, updated) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $this->makeAlterForUserProfile($stmt, $profile);

        return $conn->lastInsertId();
    }

    public function updateUserProfile(UserProfile $profile): void
    {
        $conn = $this->dbRepo->getConnection();

        $sql = 'UPDATE user_profile SET first_name = ?, last_name = ?, phone_number = ?, nin = ?, created = ?, updated = ? WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $this->makeAlterForUserProfile($stmt, $profile, true);
    }

    protected function makeAlterForUserProfile(\PDOStatement $stmt, UserProfile $profile, bool $update = false)
    {
        $params = [$profile->getFirstName(), $profile->getLastName(), $profile->getPhoneNumber(), $profile->getNin(), $profile->getCreated()->format('Y-m-d H:i:s'), date('Y-m-d H:i:s')];
        if ($update) {
            $params[] = $profile->getId();
        }
        $stmt->execute($params);
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