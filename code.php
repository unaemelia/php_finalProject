<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Products with categories</title>
</head>
<body>

<?php
//session_start();
//Database connection created
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "mobile_shop";
    $conn = new mysqli($servername, $username, $password, $dbName);
    $categories = "";
    $products = "";

    //join the category table, the products table and the cat_prod table
    //$sql = "SELECT categories.*, cat_prod.* FROM categories JOIN products ON categories.c_id = cat_prod.c_id JOIN cat_prod ON products.p_id=cat_prod.p_id";
    //$sql = "SELECT categories.*, products.*, cat_prod.* FROM categories INNER JOIN products ON categories.c_id = products.c_id INNER JOIN cat_prod ON categories.c_id = cat_prod.c_id";
    $sql = "SELECT categories.c_id, products.* FROM categories JOIN products ON categories.c_id = products.c_id";
    //$sql = "SELECT categories.c_id, products.*, cat_prod.* FROM categories JOIN products ON categories.c_id = products.c_id JOIN cat_prod ON categories.c_id = cat_prod.c_id";
    $result = $conn->query($sql);
    if($result !== false && $result->num_rows > 0){
        echo "<table><th><tr><td>ID</td><td>Category</td><td>Name</td><td>Model</td><td>Price</td><td>Quantity</td></tr></th>";
        while($row=$result->fetch_assoc()){
            echo "<tr><td>".$row["c_id"]."</td><td>".$row["p_category"]."</td><td>".$row["p_name"]."</td><td>".$row["p_model"]."</td><td>".$row["p_price"]."</td><td>".$row["p_quantity"]."</td></tr>";
        }
        echo "</table>";
        } else {
        echo "No Record Found";
    }
?>


</body>
</html>