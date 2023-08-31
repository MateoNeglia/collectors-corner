<?php
namespace Collector\Mail;

use Collector\Models\User;
use PHPMailer\PHPMailer\PHPMailer;

class EmailRetrievePassword {
    private PHPMailer $mail;
    private User $user;
    private string $token;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;        
        $this->mail->Username = '753520c1889dd4';
        $this->mail->Password = '06f8664f913c1e';
        $this->mail->CharSet = 'UTF-8';
    }

    public function send() {
        try {
            $this->mail->setFrom("no-reply@collectors-corner.com", "Collector's Corner");
    
            $link = 'http://localhost/neglia-mateo/sitio/panel/index.php?s=update-password&token=' . $this->token . '&user=' . $this->user->getUserId();
    
            $body = file_get_contents(__DIR__ . '/../../mail-templates/retrieve-password-template.html');
    
            $body = str_replace([
                '@@LINK@@',
                '@@USER@@',
            ], [
                $link,
                $this->user->getEmail(),
            ], $body);
    
            $this->mail->addAddress($this->user->getEmail());
            $this->mail->Subject = "Retrieve Password | Collector's Corner";
            $this->mail->Body = $body;
            $this->mail->isHTML();
            $this->mail->send();
    
        } catch(\Exception $e) {            
            $filename = date('YmdHis_') . "retrieve-password_" . $this->user->getEmail() . ".html";
            file_put_contents(__DIR__ . '/../../failed-mails/' . $filename, $body);
            
            throw $e;
        }
    }    

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void {
        $this->token = $token;
    }

}
