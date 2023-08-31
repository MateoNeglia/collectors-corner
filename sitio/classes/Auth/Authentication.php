<?php
namespace Collector\Auth;
use Collector\DatabaseConnection\DBConnection;
use Collector\Models\User;
use PDO;

class Authentication {
    public function logIn(string $email, string $password): bool {
        $user = (new User())->getByEmail($email);
        if(!$user) {            
            return false;
        }

        if(!password_verify($password, $user->getPassword())) {            
            return false;
        }

        $this->authenticate($user);
        return true;
    }
   
    public function registerAccount(array $data) {
        $dbConnection = new DBConnection();        
        $db = $dbConnection->getDB();
        $query = "INSERT INTO users (email, password, name, nick_name, last_name, user_role_fk) VALUES (:email, :password, :name, :nick_name, :last_name, :user_role_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'email'      => $data['email'],
            'password'   => $data['password'],
            'nick_name'  => $data['nick_name'],
            'name'       => $data['name'],
            'last_name'  => $data['last_name'],
            'user_role_fk'  => $data['user_role']
        ]);        
        
    }

    public function authenticate(User $user) {        
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['user_role_fk'] = $user->getUserRole();
    }

    public function logOut() {
        unset($_SESSION['user_id']);
    }

    public function isAuthenticated(): bool {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin(): bool {
        return $_SESSION['user_role_fk'] === 1;
    }

    public function getId(): ?int {
        return $this->isAuthenticated() ?
            $_SESSION['user_id'] :
            null;
    }

    public function getUser(): ?User {
        return $this->isAuthenticated() ?
            (new User())->getById($_SESSION['user_id']) : null;
    }
}
