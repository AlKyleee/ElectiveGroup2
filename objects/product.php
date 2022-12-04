<?php

include 'abstractTable.php';

class Product extends abstractTable{
    private int $product_id;
    private string $product_name;
    private int $price;
    private string $category;

    // Constructor
    public function __construct(int $product_id, string $product_name, int $price, string $category){
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->price = $price;
        $this->category = $category;
    }

    // Setter
    public function __set($property, $value): void{
        match($property){
            "product_id" => $this->product_id = $value,
            "product_name" => $this->product_name = $value,
            "price" => $this->price = $value,
            "category" => $this->category = $value,
        };
    }

    // Getter
    public function __get(string $property): mixed{
        return match($property){
            "product_id" => $this->product_id,
            "product_name" => $this->product_name,
            "price" => $this->price,
            "category" => $this->category
        };
    }

    // Converts the Product's properties into an SQL Insert query statement
    public function insertSQL(): string{
        return "INSERT INTO `product` (`product_id`, `product_name`, `price`, `category`) VALUES 
        ($this->product_id, '$this->product_name', $this->price, '" .$this->category ."')";
    }
}

// Hamburgers
$product1 = new Product(1, 'Beef Burger Sandwich', 30, "HAMBURGERS");
$product2 = new Product(2, 'Cheese Burger Sandwich', 40, "HAMBURGERS");

// Hotdog Sanswiches
$product3 = new Product(3, 'Cheesy Hotdog Sandwich', 30, "HOTDOGSANDWICHES");
$product4 = new Product(4, 'Jumbo Cheese Footlong Sandwich', 45, "HOTDOGSANDWICHES");
$product5 = new Product(5, 'Cheesy Hungarian Sausage', 55, "HOTDOGSANDWICHES");

// Ham Sandwiches
$product6 = new Product(6, 'Ham Sandwich', 18, "HAMSANDWICHES");
$product7 = new Product(7, 'Ham & Cheese Sandwich', 23, "HAMSANDWICHES");
$product8 = new Product(8, 'Ham & Egg Sandwich', 30, "HAMSANDWICHES");
$product9 = new Product(9, 'Ham, Cheese & Egg Sandwich', 35, "HAMSANDWICHES");

// Bacon Sandwiches
$product10 = new Product(10, 'Bacon Sandwich', 25, "BACONSANDWICHES");
$product11 = new Product(11, 'Bacon & Cheese Sandwich', 30, "BACONSANDWICHES");
$product12 = new Product(12, 'Bacon & Egg Sandwich', 37, "BACONSANDWICHES");
$product13 = new Product(13, 'Bacon, Cheese & Egg Sandwich', 42, "BACONSANDWICHES");

// Drinks
$product14 = new Product(14, 'Lipton Iced Tea', 30, "DRINKS");
$product15 = new Product(15, 'Bottled Water', 16, "DRINKS");
$product16 = new Product(16, 'Coke', 17, "DRINKS");
$product17 = new Product(17, 'Pepsi', 17, "DRINKS");

$products = array($product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8, $product9, $product10,
                $product11, $product12, $product13, $product14, $product15, $product16, $product17);

?>