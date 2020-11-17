<?php


namespace App\Entity;

/**
 * Class User
 */
class User extends BaseEntity implements UserModel
{

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var UserRole
     */
    protected ?UserRole $role;

    /**
     * @var UserProfile|null
     */
    protected ?UserProfile $userProfile;

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return UserRole
     */
    public function getRole(): UserRole
    {
        return $this->role;
    }

    /**
     * @param UserRole $role
     * @return User
     */
    public function setRole(UserRole $role): User
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return UserProfile|null
     */
    public function getUserProfile(): ?UserProfile
    {
        return $this->userProfile;
    }

    /**
     * @param UserProfile|null $userProfile
     * @return User
     */
    public function setUserProfile(?UserProfile $userProfile): User
    {
        $this->userProfile = $userProfile;
        return $this;
    }


}