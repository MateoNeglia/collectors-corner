<?php
namespace Collector\Models;
use Collector\DatabaseConnection\DBConnection;
use PDO;

class Product extends Model {
    protected int $product_id;
    protected int $user_fk;
    protected string $publish_datetime;
    protected string $name;
    protected string $description;
    protected string $price;
    protected ?string $img;
    protected ?string $img_large;
    protected ?string $img_lore;

    protected string $table = "products";
    protected string $primaryKey = "product_id";
    protected array $properties = ['product_id', 'user_fk', 'publish_datetime', 'name', 'description', 'price', 'img', 'img_lore'];

    /** @var array */
    protected array $tag_fk = [];    

    /** @var array|Tag[] */
    protected array $tags = [];

    /**
     * @return self[]  List of products.
     */
    public function getAll(): array {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM products";

        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);

        return $stmt->fetchAll();

    }

    public function getByAmount(int $itemAmount): array {
        $filteredProducts = [];
        $products = (new self())->getAll();
        $filteredProducts = array_slice($products, $itemAmount);
        return $filteredProducts;
    }
    /**
     * @return void
     * @throws PDOException
     */
    public function createNew(array $data) {
        $dbConnection = new DBConnection();        
        $db = $dbConnection->getDB();
        $query = "INSERT INTO products (user_fk, publish_datetime, name, description, price, img, img_lore) VALUES (:user_fk, :publish_datetime, :name, :description, :price, :img, :img_lore)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'user_fk'           => $data['user_fk'],
            'publish_datetime'  => $data['publish_datetime'],
            'name'              => $data['name'],
            'description'       => $data['description'],
            'price'             => $data['price'],
            'img'               => $data['img'],            
            'img_lore'          => $data['img_lore'],            
        ]);
        $id = $db->lastInsertId();
        $this->saveTags($id, $data['tags']);               
    }

    /**
     * @return void
     * @throws PDOException
     */

    public function editExisting(array $data) {
        $this->updateTags($data['tags']);
        $db = (new DBConnection())->getDB();
        $db->beginTransaction();
        
        try {
            
            $query = "UPDATE products SET 
            user_fk = :user_fk,                                      
            name = :name,
            description = :description,
            price = :price,
            img =  :img,                                      
            img_lore = :img_lore
            WHERE product_id = :product_id";

            $stmt = $db->prepare($query);
            $stmt->execute([
                'product_id'        => $this->getProductId(),
                'user_fk'           => $data['user_fk'],            
                'name'              => $data['name'],
                'description'       => $data['description'],
                'price'             => $data['price'],
                'img'               => $data['img'],            
                'img_lore'          => $data['img_lore'],
            ]);
          
            $db->commit();
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    /**    
     * @return void
     */
    protected function updateTags(array $tags) {       
        $this->deleteTags();
        $this->saveTags($this->getProductId(), $tags);
    }

    /**
     * @return void
     * @throws PDOException
     */
    public function deleteProduct(): void {
        try {
            $this->deleteTags();
            $db = (new DBConnection())->getDB();
            $query = "DELETE FROM products WHERE product_id = ?";
            $stmt = $db->prepare($query)->execute([$this->getProductId()]);
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
        
    }
    public function searchProduct(string $searchQuery): array {
        try {
            $db = (new DBConnection())->getDB();
            $stmt = $db->prepare("SELECT * FROM products WHERE name LIKE :searchQuery");
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
            $stmt->execute();            
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
            $searchResults = $stmt->fetchAll();

            return $searchResults;
            
        } catch (\Exception $e) {
            throw $e;
        }
    }
    

     /**
     * @return void
     */
    public function loadTags() {
        $db = (new DBConnection)->getDB();
        $query = "SELECT e.* FROM products_has_tags nte
                INNER JOIN tags e ON nte.tags_fk = e.tag_id
                WHERE products_fk = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->getProductId()]);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->tag_fk[] = $row['tag_id'];            
            $tag = new Tag();
            $tag->loadProperties($row);
            $this->tags[] = $tag;
        }
    }

    /**
     * @return void
     */
    protected function saveTags(int $productId, array $tags) {        
        if(count($tags) === 0) return;
        $insertPairs = [];
        $values = [];

        foreach($tags as $tagId) {            
            $insertPairs[] = "(?, ?)";
            $values[] = $productId;
            $values[] = $tagId;
        }

        $db = (new DBConnection)->getDB();
        $pairList = implode(', ', $insertPairs);
        $query = "INSERT INTO products_has_tags (products_fk, tags_fk) VALUES {$pairList}";
        $db->prepare($query)->execute($values);
    }

    /**
     * @return void
     */
    protected function deleteTags() {
        $db = (new DBConnection)->getDB();
        $query = "DELETE FROM products_has_tags
                WHERE products_fk = ?";
        $db->prepare($query)->execute([$this->getProductId()]);
    }
   

    /*--------------------------------------------------------------------------
     | Setters & Getters
     +-------------------------------------------------------------------------*/
    /**
     * @return mixed
     */
    public function getProductId() {
        return $this->product_id;
    }

    /**
     * @param mixed $id
     */
    public function setProductId($product_id): void {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getPublishDate() {
        return $this->publish_datetime;
    }

    /**
     * @param mixed $id
     */
    public function setPublishDate($publish_datetime): void {
        $this->product_id = $publish_datetime;
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
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getImg() {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getImgLore() {
        return $this->img_lore;
    }

    /**
     * @param mixed $img_lore
     */
    public function setImgLore($img_lore): void {
        $this->img_lore = $img_lore;
    }

        /**
     * @return array
     */
    public function getTagsFk(): array {
        return $this->tag_fk;
    }

    /**
     * @param array $tag_fk
     */
    public function setTagsFk(array $tag_fk): void {
        $this->tag_fk = $tag_fk;
    }

    /**
     * @return array|Tag[]
     */
    public function getTags(): array {
        return $this->tags;
    }

    /**
     * @param array|Tags[] $tags
     */
    public function setTags(array $tags): void {
        $this->tags = $tags;
    }

}
