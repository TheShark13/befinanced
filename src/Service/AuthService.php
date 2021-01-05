<?php


namespace App\Service;


use App\Entity\User;
use App\Repository\UserRepository;
use ChristianFramework\Service\MailerService;
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

        if (!$user->isEnabled() && $user->getConfirmationToken()) {
            throw new Exception("Contul nu a fost activat. Verifica email-ul pentru pasii de activare");
        }

        if (!$user->isEnabled()) {
            throw new Exception("Contul este dezactivat");
        }

        $_SESSION['user'] = $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @throws Exception
     */
    public function register(string $email, string $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email invalid");
        }

        $user = $this->userRepository->findUserByEmail($email);
        if ($user) {
            throw new Exception("Exista deja un utilizator cu acest email asociat");
        }

        $userRepo = new UserRepository();
        $role = $userRepo->findRoleById(1);

        $user = new User();
        $user->setRole($role);
        $user
            ->setEmail($email)
            ->setPassword($user->hashPassword($password))
            ->setConfirmationToken(sha1(random_bytes(25)))
            ->setCreated(new \DateTime())
            ->setUpdated(new \DateTime());

        $userRepo->insert($user);

        $mailerService = new MailerService();
        $mailerService->sendEmail($email, "Inca putin pana la obtinerea finantarii dorite", "http://localhost/confirm?token=" . $user->getConfirmationToken());
    }

    /**
     * @param string $token
     * @throws Exception
     */
    public function confirm(string $token)
    {
        $user = $this->userRepository->findUserByConfirmationToken($token);
        if (!$user) {
            throw new Exception("Cod invalid");
        }

        $userRepo = new UserRepository();
        $user->setConfirmationToken(null)
            ->setEnabled(true);
        $userRepo->update($user);

        $_SESSION['user'] = $user;
    }
}