<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Inserting a product with user input-->
    <div>
            <h3>Add Product</h3>
            <?php
            //Inserting product with PHP Code
            $products = "";
            if ($_POST) {
                $products = $_POST['p_name'];
                $sql = "INSERT products (p_name) VALUES('$products')";
                if ($conn->query($sql) === TRUE) {
                    echo "Product Inserted Successfully";
                } else {
                    echo "Error in inserting product" . $conn->error;
                }
            }
            ?>
            <!--Form to insert Categories-->
            <form method="post">
                <input type="text" name="p_name">
                <input type="submit" name="submit" value="insert category">
            </form>
        </div>

        <!--Inserting a product with user input-->
        <div>
                <h3>Add Product</h3>
                <?php
                //Inserting product with PHP Code
                $products = "";
                if ($_POST) {
                    $products = $_POST['p_name'];
                    $sql = "INSERT products (p_name, p_model, p_quantity, p_category, p_price, p_sold) VALUES('$products')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Product Inserted Successfully";
                    } else {
                        echo "Error in inserting product" . $conn->error;
                    }
                }
                ?>
                <!--Form to insert Categories-->
                <form method="post">
                    <input type="text" name="p_name" placeholder="product name">
                    <input type="text" name="p_model" placeholder="product model">
                    <input type="text" name="p_quantity" placeholder="product quantity">
                    <input type="text" name="p_category" placeholder="product category">
                    <input type="text" name="p_price" placeholder="product price">
                    <input type="text" name="p_sold" placeholder="products sold">
                    <input type="submit" name="submit" value="insert product">
                </form>
            </div>
</body>
</html>