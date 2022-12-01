<?php

// Enumeration for the user_type
enum UserType {
    case CUSTOMER;
    case ADMIN;
}

class User{
    private string $first_name;
    private string $last_name;
    private string $contactNum;
    private string $address;
    private string $email;
    private string $password;
    private UserType $user_type;

    // Constructor
    public function __construct(string $first_name, string $last_name, string $contactNum, string $address, 
                                string $email, string $password, UserType $user_type){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->contactNum = $contactNum;
        $this->address = $address;
        $this->email = $email;
        $this->password = $password;
        $this->user_type = $user_type;
    }

    // Setter
    public function __set($property, $value): void{
        match($property){
            "first_name" => $this->first_name = $value,
            "last_name" => $this->last_name = $value,
            "contactNum" => $this->contactNum = $value,
            "address" => $this->address = $value,
            "email" => $this->email = $value,
            "password" => $this->password = $value,
            "user_type" => $this->user_type = $value
        };
    }

    // Getter
    public function __get(string $property): mixed{
        return match($property){
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "contactNum" => $this->contactNum,
            "address" => $this->address,
            "email" => $this->email,
            "password" => $this->password,
            "user_type" => $this->userTypeToString()
        };
    }

    // Converts Enum UserType to String
    public function userTypeToString(): string{
        return match($this->user_type){
            UserType::CUSTOMER => "customer",
            UserType::ADMIN => "admin"
        };
    }

    // Converts the Product's properties into an SQL Insert query statement
    public function insertProduct(): string{
        return "INSERT INTO `users`(`first_name`,`last_name`,`contactNum`, `address`, `email`, `password`, `user_type`) VALUES 
        ('$this->first_name', '$this->last_name', '$this->contactNum', '$this->address', 
        '$this->email', '$this->password', '" .$this->userTypeToString() ."')";
    }
}

// Hamburgers
$user1 = new User('Jihoon', 'Lee', '+639876545676', '221B Baker street','leejihoon@mail.com', 'password', UserType::CUSTOMER);

echo $user1->insertProduct();
?>