<?php


namespace ChristianFramework\Service;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    public const TO_EMAIL = "contact@cristianionescu.ro";

    private PHPMailer  $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->config();
    }

    /**
     * @param string $sender
     * @param string $subject
     * @param string $text
     * @param array $opts
     * @throws Exception
     */
    public function sendEmail(string $sender, string $subject, string $text, array $opts = []): void
    {
        $this->mailer->addAddress($sender);

        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $text;

        try {
            $this->mailer->send();
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
            exit;
        }
    }

    private function config()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->setFrom(self::TO_EMAIL, "CristianIonescu.ro");
        $this->mailer->isSMTP();                                            // Send using SMTP
        $this->mailer->Host = 'mail.cristianionescu.ro';                    // Set the SMTP server to send through
        $this->mailer->SMTPAuth = true;                                   // Enable SMTP authentication
        $this->mailer->Username = "contact@cristianionescu.ro";                     // SMTP username
        $this->mailer->Password = 'Rechinushark45';                               // SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mailer->Port = 26;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    }
}