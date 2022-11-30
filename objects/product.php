<?php

// Enumeration for the Category
enum Category {
    case HAMBURGERS;
    case HOTDOGSANDWICHES;
    case HAMSANDWICHES;
    case BACONSANDWICHES;
    case DRINKS;
}

class Product{
    private int $product_id;
    private string $product_name;
    private int $price;
    private Category $category;

    // Constructor
    public function __construct(int $product_id, string $product_name, int $price, Category $category){
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
            "category" => $this->categoryToString()
        };
    }

    // Converts Enum Category to String
    public function categoryToString(): string{
        return match($this->category){
            Category::HAMBURGERS => "HAMBURGERS",
            Category::HOTDOGSANDWICHES => "HOTDOG SANDWICHES",
            Category::HAMSANDWICHES => "HAM SANDWICHES",
            Category::BACONSANDWICHES => "BACON SANDWICHES",
            Category::DRINKS => "DRINKS",
        };
    }

    // Converts the Product's properties into an SQL Insert query statement
    public function insertProduct(): string{
        return "($this->product_id, $this->product_name, $this->price, " .$this->categoryToString() .")";
    }
}

// Hamburgers
$product1 = new Product(1, 'Beef Burger Sandwich', 30, Category::HAMBURGERS);
$product2 = new Product(2, 'Cheese Burger Sandwich', 40, Category::HAMBURGERS);

// Hotdog Sanswiches
$product3 = new Product(3, 'Cheesy Hotdog Sandwich', 30, Category::HOTDOGSANDWICHES);
$product4 = new Product(4, 'Jumbo Cheese Footlong Sandwich', 45, Category::HOTDOGSANDWICHES);
$product5 = new Product(5, 'Cheesy Hungarian Sausage', 55, Category::HOTDOGSANDWICHES);

// Ham Sandwiches
$product6 = new Product(6, 'Ham Sandwich', 18, Category::HAMSANDWICHES);
$product7 = new Product(7, 'Ham & Cheese Sandwich', 23, Category::HAMSANDWICHES);
$product8 = new Product(8, 'Ham & Egg Sandwich', 30, Category::HAMSANDWICHES);
$product9 = new Product(9, 'Ham, Cheese & Egg Sandwich', 35, Category::HAMSANDWICHES);

// Bacon Sandwiches
$product10 = new Product(10, 'Bacon Sandwich', 25, Category::BACONSANDWICHES);
$product11 = new Product(11, 'Bacon & Cheese Sandwich', 30, Category::BACONSANDWICHES);
$product12 = new Product(12, 'Bacon & Egg Sandwich', 37, Category::BACONSANDWICHES);
$product13 = new Product(13, 'Bacon, Cheese & Egg Sandwich', 42, Category::BACONSANDWICHES);

// Drinks
$product14 = new Product(14, 'Lipton Iced Tea', 30, Category::DRINKS);
$product15 = new Product(15, 'Bottled Water', 16, Category::DRINKS);
$product16 = new Product(16, 'Coke', 17, Category::DRINKS);
$product17 = new Product(17, 'Pepsi', 17, Category::DRINKS);

$products = array($product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8, $product9, $product10,
                $product11, $product12, $product13, $product14, $product15, $product16, $product17);

foreach ($products as $product){
    echo $product->insertProduct() ."<br>";
}
?>