<?php
namespace Collector\Auth;

use Collector\DatabaseConnection\DBConnection;
use Collector\Mail\EmailRetrievePassword;
use Collector\Models\User;
use Collector\Encryption\EmailToken;
use PHPMailer\PHPMailer\PHPMailer;
use DateTime;
use PDO;

class RetrievePassword {
    protected ?User $user;
    protected string $token;
    protected DateTime $expiration;

    /**
     * @param User $user
     * @return void
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendRecoveryEmail(User $user) {
        $this->user = $user;        
        $this->deleteToken();

        $this->token = $this->generateToken();
        $this->storeToken();

        $this->sendEmail();
    }

    public function setUserById(int $id) {
        $this->user = (new User())->getById($id);
    }

    public function setToken(string $token) {
        $this->token = $token;
    }

    /**     
     * @return bool
     */
    public function isValid(): bool {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM retrive_password
                WHERE   user_fk     = :user_fk
                AND     token       = :token";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'user_fk' => $this->user->getUserId(),
            'token'   => $this->token,
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row) {
            return false;
        }
        
        $this->expiration = new DateTime($row['expiration']);

        return true;
    }

    /**     
     * @return bool
     */
    public function checkExpiration(): bool {
        $currentDate = new DateTime();

        if($currentDate >= $this->expiration) {            
            $this->deleteToken();
            return true;
        }

        return false;
    }

    /**     
     * @param string $password
     * @return void
     */
    public function updatePassword(string $password) {
        $this->user->editPassword($password);

        $this->deleteToken();
    }

    /**     
     * @return void
     */
    protected function deleteToken() {
        $db = (new DBConnection())->getDB();
        $query = "DELETE FROM retrive_password
                WHERE user_fk = ?";
        $db->prepare($query)->execute([$this->user->getUserId()]);
    }

    /**     
     * @return string
     */
    protected function generateToken(): string {
        return (new EmailToken())->generate();
    }

    protected function storeToken() {
        $db = (new DBConnection())->getDB();
        $query = "INSERT INTO retrive_password (user_fk, token, expiration) 
                VALUES (:user_fk, :token, :expiration)";
        $stmt = $db->prepare($query);

        $this->expiration = new DateTime();
        $this->expiration->modify('+1 hour');

        $stmt->execute([
            'user_fk' => $this->user->getUserId(),
            'token' => $this->token,
            'expiration' => $this->expiration->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @throws \Exception
     */
    protected function sendEmail() {
        $email = new EmailRetrievePassword();
        $email->setUser($this->user);
        $email->setToken($this->token);
        $email->send();
    }

    /**
     * @return PHPMailer
     */
    protected function getMailInstance(): PHPMailer {        
        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;        
        $phpmailer->Username = '753520c1889dd4';
        $phpmailer->Password = '06f8664f913c1e';
        $phpmailer->CharSet = 'UTF-8';

        return $phpmailer;
    }

    /**
     * @return void
     * @throws \PHPMailer\PHPMailer\Exception
     */
    protected function sendEmailMailer() {
        try {
            $mail = $this->getMailInstance();
            $mail->setFrom("no-reply@collectors-corner.com.ar", "Collector's Corner");

            $link = 'http://localhost/neglia-mateo/sitio/panel/index.php?s=update-password&token=' . $this->token . '&user=' . $this->user->getUserId();

            $body = file_get_contents(__DIR__ . '/../../mail-templates/retrieve-password-template.html');

            $body = str_replace([
                '@@LINK@@',
                '@@USER@@',
            ], [
                $link,
                $this->user->getEmail(),
            ], $body);

            $mail->addAddress($this->user->getEmail());
            $mail->Subject = "Retrieve Password | Collector's Corner";
            $mail->Body = $body;
            $mail->isHTML();
            $mail->send();

        } catch(\Exception $e) {            
            $filename = date('YmdHis_') . "retrieve-password_" . $this->user->getEmail() . ".html";
            file_put_contents(__DIR__ . '/../../failed-mails/' . $filename, $body);
            
            throw $e;
        }
    }

    protected function sendEmailHTML() {
        $to = $this->user->getEmail();
        $subject = "Restablecer Password | Collector's Corner";        
        $link = 'http://localhost/neglia-mateo/sitio/panel/index.php?s=update-password&token=' . $this->token . '&user=' . $this->user->getUserId();

        $body = file_get_contents(__DIR__ . '/../../mail-templates/retrieve-password-template.html');
        
        $body = str_replace([
            '@@LINK@@',
            '@@USER@@',
        ], [
            $link,
            $this->user->getEmail(),
        ], $body);

        $headers  = "From: no-reply@collectors-corner.com" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8" . "\r\n";

        if(!mail($to, $subject, $body, $headers)) {            
            $filename = date('YmdHis_') . "retrieve-password_" . $this->user->getEmail() . ".html";
            file_put_contents(__DIR__ . '/../../failed-mails/' . $filename, $body);
        }
    }

    protected function sendEmailPlainText() {
        $to = $this->user->getEmail();
        $subject = "Restablecer Password | Collector's Corner";        
        $body = "Dear xxx
                
        We received a request to reset your password at  Collector's Corner.
        If it wasn't you, you can ignore this email.
        
        To reset your password, go to the link:
        
        http://localhost/neglia-mateo/sitio/panel/index.php?s=update-password&token=" . $this->token . "&user=" . $this->user->getUserId() . "
        
        Kind regards,
        The Collector's Corner Staff";

        $headers = "From: no-reply@collectors-corner.com" . "\r\n";

        if(!mail($to, $subject, $body, $headers)) {            
            $filename = date('YmdHis_') . "retrieve-password_" . $this->user->getEmail() . ".txt";
            file_put_contents(__DIR__ . '/../../failed-mails/' . $filename, $body);
        }
    }
}
