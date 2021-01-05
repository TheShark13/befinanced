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
     * @var FinancialInstitution|null
     */
    protected ?FinancialInstitution $financialInstitution = null;

    /**
     * @var UserRole
     */
    protected UserRole $role;

    /**
     * @var UserProfile|null
     */
    protected ?UserProfile $userProfile = null;

    /**
     * @var string|null
     */
    protected ?string $confirmationToken = null;

    /**
     * @var bool
     */
    protected bool $enabled = false;

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
     * @param string $roleName
     * @return bool
     */
    public function hasRoleByName(string $roleName): bool
    {
        if ($this->role && $this->role->getName() === $roleName) {
            return true;
        }

        return false;
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

    /**
     * @return string
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string|null $confirmationToken
     * @return User
     */
    public function setConfirmationToken(?string $confirmationToken): User
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return User
     */
    public function setEnabled(bool $enabled): User
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return FinancialInstitution|null
     */
    public function getFinancialInstitution(): ?FinancialInstitution
    {
        return $this->financialInstitution;
    }

    /**
     * @param FinancialInstitution|null $financialInstitution
     * @return User
     */
    public function setFinancialInstitution(?FinancialInstitution $financialInstitution): User
    {
        $this->financialInstitution = $financialInstitution;
        return $this;
    }
}