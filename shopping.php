<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "mobile_shop";
$conn = new mysqli($servername, $username, $password, $dbName);

if (isset($_POST["add"])) {
    if (isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], $column = "id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'id' => $_GET['p_id'],
                'name' => $_POST['hidden_name'],
                'price' => $_POST['hidden_price'],
                'quantity' => $_POST['p_quantity']
            );
            $_SESSION["cart"][$count] = $item_array;
            echo "<script>window.location='shoppingcart.php'</script>";
        } else {
            echo "<script>alert('Product is already added to cart')</script>";
            echo "<script>window.location='shoppingcart.php'</script>";
        }
    } else {
        $item_array = array(
            'id' => $_GET['p_id'],
            'name' => $_POST['hidden_name'],
            'price' => $_POST['hidden_price'],
            'quantity' => $_POST['p_quantity']
        );
        $_SESSION["cart"][0] = $item_array;
    }
}
if (isset($_GET['action'])){
    if ($_GET['action'] == "delete"){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['id'] == $_GET['id']){
                unset($_SESSION['cart'][$keys]);
                echo "<script>alert('Product has been removed')</script>";
                echo "<script>window.location='shoppingcart.php'</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Shopping cart dæmi</title>
</head>

<body>
    <div class="container">
        <?php
        $query = "SELECT * FROM products ORDER BY p_id ASC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <div class="col-md-3">
                    <form method="post" action="shoppingcart.php?action=add&id=<?php echo $row['p_id'] ?>">
                        <div class="product">
                            <h5 class="text-info"><?php echo $row['p_name']; ?></h5>
                            <h5 class="text-danger"><?php echo $row['p_price']; ?></h5>
                            <input type="text" name="quantity" class="form-control" value="1">
                            <input type="hidden" name="hidden_name" value="<?php echo $row['p_name'] ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row['p_price'] ?>">
                            <input type="submit" name="add" class="btn btn-success" value="Add to cart">
                        </div>
                    </form>
            <?php
            }
        }
            ?>
            <div> <!--style="clear: both"-->
                <h3 class="title2">Shopping cart detail</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr>
                        <th width="30%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="13%">Price</th>
                        <th width="17%">Remove Product</th>
                    </tr>
                    <?php
                    if (!empty($_SESSION["cart"])) {
                        $total = 0;
                        foreach ($_SESSION["cart"] as $key => $value) {
                    ?>
                            <tr>
                                <td><?php echo $value['p_name']; ?></td>
                                <td><?php echo $value['p_quantity']; ?></td>
                                <td>SEK <?php echo $value['p_price']; ?></td>
                                <td>SEK <?php echo number_format(number: $value['p_quantity'] * $value['p_price']); ?></td>
                                <td><a href="cart.php?action=delete&id=<?php echo $value['p_id']; ?>"><span class="text-danger">Remove Item</span></a></td>
                            </tr>
                        <?php
                            $total = $total + ($value["p_quantity"] * $value["p_price"]);
                        }
                        ?>

                        <tr>
                            <td colspan="3" text-align="right">Total</td>
                            <th text-align="right">SEK <?php echo number_format($total, 2); ?></th>
                            <td></td>
                        </tr>
                    <?php

                    }
                    ?>
                    </table>


                </div>
            </div>

                </div>

    </div>
</body>

</html>