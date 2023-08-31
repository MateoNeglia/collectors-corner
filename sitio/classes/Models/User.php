<?php
namespace Collector\Models;
use Collector\DatabaseConnection\DBConnection;
use Collector\Models\UserRole;
use PDO;

class User extends Model {
    protected int $user_id;
    protected int $user_role_fk;
    protected string $email;
    protected string $password;
    protected ?string $name;
    protected ?string $last_name;
    protected ?string $nick_name;

    protected string $table = "users";
    protected string $primaryKey = "user_id";
    protected array $properties =
    ['user_id', 'user_role_fk', 'email', 'password', 'name', 'last_name', 'nick_name'];

    public function getByEmail(string $email): ?self {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM users
                WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $user = $stmt->fetch();       

        return $user ? $user : null;
    }

    public function getUserRoleFromId(int $user_role_id) {
        return (new UserRole())->getById($user_role_id);
    }

    public function editPassword(string $password) {
        $db = (new DBConnection())->getDB();
        $query = "UPDATE users
                SET password = :password
                WHERE user_id = :id";
        $db->prepare($query)->execute([
            'id' => $this->getUserId(),
            'password' => $password,
        ]);
    }


    /*--------------------------------------------------------------------------
     | Setters & Getters
     +-------------------------------------------------------------------------*/
    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param mixed $id
     */
    public function setUserId($user_id): void {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($user_id): void {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void {
        $this->password = $password;
    }
    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name): void {
        $this->last_name = $last_name;
    }
    /**
     * @return mixed
     */
    public function getNickName() {
        return $this->nick_name;
    }

    /**
     * @param mixed $nick_name
     */
    public function setNickName($nick_name): void {
        $this->nick_name = $nick_name;
    }

        /**
     * @return mixed
     */
    public function getUserRole() {
        return $this->user_role_fk;
    }

    /**
     * @param mixed $nick_name
     */
    public function setUserRole($user_role_fk): void {
        $this->user_role_fk = $user_role_fk;
    }



}