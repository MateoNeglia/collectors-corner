<?php

namespace Collector\Models;
use Collector\DatabaseConnection\DBConnection;
use PDO;

class Purchase extends Model {
    protected int $purchase_id;
    protected string $product_name;
    protected int $product_quantity;
    protected string $price;

    protected string $table = "purchases";
    protected string $primaryKey = "purchase_id";
    protected array $properties = ["purchase_id", "product_name"];

        /**
     * @return void
     * @throws PDOException
     */
    public function createNew(array $data) {
        $db = (new DBConnection())->getDB();
        $query = "INSERT INTO purchases (product_name, product_quantity, product_price, user_fk) VALUES (:product_name, :product_quantity, :product_price, :user_fk)";
        $stmt = $db->prepare($query);
        $stmt->execute([                        
            'product_name'              => $data['product_name'],
            'product_quantity'       => $data['product_quantity'],
            'product_price'             => $data['product_price'],
            'user_fk'               => $data['user_fk'],                        
        ]);
    }

    public function getByUserId(int $id): ?array {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM purchases WHERE user_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        $purchases = $stmt->fetchAll();

        return $purchases ? $purchases : null;
    }

    /**
     * @return int
     */
    public function getPurchaseId(): int {
        return $this->purchase_id;
    }

    /**
     * @param int $Purchase_id
     */
    public function setPurchaseId(int $purchase_id): void {
        $this->purchase_id = $purchase_id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->product_name;
    }

    /**
     * @param string $Purchase_name
     */
    public function setName(string $product_name): void {
        $this->product_name = $product_name;
    }

        /**
     * @return string
     */
    public function getProductQuantity(): string {
        return $this->product_quantity;
    }

    /**
     * @param string $Purchase_name
     */
    public function setProductQuantity(string $purchase_name): void {
        $this->product_quantity = $product_quantity;
    }

        /**
     * @return mixed
     */
    public function getPrice() {
        return $this->product_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($product_price): void {
        $this->product_price = $product_price;
    }

            /**
     * @return mixed
     */
    public function getUserFk() {
        return $this->user_fk;
    }

    /**
     * @param mixed $user_fk
     */
    public function setUserFk($user_fk): void {
        $this->user_fk = $user_fk;
    }
}
