<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "online_store";

// 1. Connect to MySQL server (without specifying database yet)
$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Create Database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}

// 3. Select the database
if (!mysqli_select_db($conn, $database)) {
    die("Error selecting database: " . mysqli_error($conn));
}

// 4. Create Tables if they don't exist
$tables_sql = [];

// Table: users (Based on image_bc3428.jpg)
$tables_sql[] = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address_line1 VARCHAR(255) DEFAULT NULL,
    address_line2 VARCHAR(255) DEFAULT NULL,
    city VARCHAR(100) DEFAULT NULL,
    state VARCHAR(100) DEFAULT NULL,
    postal_code VARCHAR(20) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    contact_number VARCHAR(20) DEFAULT NULL
)";

// Table: products (Based on image_bc3424.png)
$tables_sql[] = "CREATE TABLE IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    rating INT(11) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    gallery1 VARCHAR(255) DEFAULT NULL,
    gallery2 VARCHAR(255) DEFAULT NULL,
    gallery3 VARCHAR(255) DEFAULT NULL,
    gallery4 VARCHAR(255) DEFAULT NULL
)";

// Table: orders (Based on image_bc3408.png)
$tables_sql[] = "CREATE TABLE IF NOT EXISTS orders (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL,
    delivery_address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    contact_number VARCHAR(30) NOT NULL
)";

// Table: order_items (Based on image_bc340c.png)
$tables_sql[] = "CREATE TABLE IF NOT EXISTS order_items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    price DECIMAL(10,2) NOT NULL
)";

// Table: cart_items (Inferred standard structure as screenshot was missing)
$tables_sql[] = "CREATE TABLE IF NOT EXISTS cart_items (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL
)";

// Execute table creation queries
foreach ($tables_sql as $sql) {
    if (!mysqli_query($conn, $sql)) {
        die("Error creating table: " . mysqli_error($conn));
    }
}

// Connection is now ready to use with the $conn variable
?>