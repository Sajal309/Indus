<?php 
class model{
    private $id;
    private $name;
    private $description;
    private $price;
    private $category_id;
    private $category_name;

    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setCategory_id($category_id){
        $this->category_id = $category_id;
    }
    public function setCategory_name($category_name){
        $this->category_name = $category_name;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getCategory_id(){
        return $this->category_id;
    }
    public function getCategory_name(){
        return $this->category_name;
    }
}

?>

