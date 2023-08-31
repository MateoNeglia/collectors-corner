<?php
namespace Collector\Validation;

class ProductValidation {
        
    /** @var array **/
    protected $data = [];

    /**  @var array **/
    protected $errors = [];

    public function __construct(array $data) {
        $this->data = $data;
        $this->validate();
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }

    /** @return array **/
    public function getErrors(): array {
        return $this->errors;
    }

    protected function validate() {
        if(empty($this->data['name'])) {
            $this->errors['name'] = "The item you are selling must have a name.";
        } else if(strlen($this->data['name']) < 10) {
            $this->errors['name'] = "The name of the item you are selling must have more than 10 characters.";
        }

        if(empty($this->data['description'])) {
            $this->errors['description'] = "The item you are selling must have a description.";
        }
        
        if(empty($this->data['price'])) {
            $this->errors['price'] = "You need to enter a price for your item.";
        } else if(is_numeric($this->data['price']) == false ) {
            $this->errors['price'] = "The value you entered is not a number";
        }
    }
}