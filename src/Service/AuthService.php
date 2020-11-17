<?php


namespace App\Service;


use App\Repository\UserRepository;
use Exception;

class AuthService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param string $email
     * @param string $password
     * @throws Exception
     */
    public function login(string $email, string $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email invalid");
        }

        $user = $this->userRepository->findUserByEmail($email);
        if (!$user) {
            throw new Exception("Nu a fost gasit un utilizator cu acest email");
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Parola nu este corecta");
        }

        $_SESSION['user'] = $user;
    }
}