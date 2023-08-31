<?php
namespace Collector\Models;
use PDO;

class UserRole extends Model {
    protected int $user_role_id;
    protected string $name;

    protected string $table = "user_roles";
    protected string $primaryKey = "user_role_id";

    /** @var array|string[] */
    protected array $propiedades = ['user_role_id', 'name'];

    /**
     * @return int
     */
    public function getUserRoleId(): int {
        return $this->user_role_id;
    }

    /**
     * @param int $user_role_id
     */
    public function setUserRoleId(int $user_role_id): void {
        $this->user_role_id = $user_role_id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }
}