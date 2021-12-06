<?php
$session_start();
$connect = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST["add_to_cart"])) {
    if(isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id)){
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array (
                'item_id'=> $_GET['p_id'],
                'item_name'=> $_POST['hidden_name'],
                'item_price'=> $_POST['hidden_price'],
                'item_quantity'=> $_POST['p_quantity']
            );
            $_SESSION["shopping_cart"[$count] = $item_array;
        } else {
            echo "Item has already been added";
        }
    } else {
        $item_array = array(
            'item_id'=> $_GET['p_id'],
            'item_name'=> $_POST['hidden_name'],
            'item_price'=> $_POST['hidden_price'],
            'item_quantity'=> $_POST['p_quantity']
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Shopping cart</title>
</head>
<body>
    <div class="container">
        <h3>Shopping Cart</h3>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "mobile_shop";
        $conn = new mysqli($servername, $username, $password, $dbName);
        $categories = "";
        $products = "";

        $query = "SELECT * FROM product ORDER BY id ASC";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
        ?>
        <div class="col-md-4">
            <form method="post" <?php echo $row['p_category']; ?>>
                <div>
                    <h4><?php echo $row['p_name']; echo $row['p_model']; ?></h4>
                    <h4><?php echo $row['p_price']?></h4>
                    <h4><?php echo $row['p_quantity']?></h4>
                    <input type="text" name="quantity" class="form-control" value="1">
                    <input type="hidden" name="hidden_name" value="<?php echo $row['p_name'] ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['p_price'] ?>">
                    <input type="submit" name="add_to_cart" class="btn btn-success" value="Add to Cart">

                </div>
            </form>
        </div>
        <?php
        }
    }
        ?>
    <div style="clear:both"></div>
    <br>
    <h3>Order details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
        </table>
    </div>
    <?php
    if(!empty($_SESSION["shopping_cart"])) {
        $total = 0;
        foreach($_SESSION["shopping_cart"] as $keys => $values) {
            ?>
            <tr>
                <td><?php echo $values["item_name"]; ?></td>
                <td><?php echo $values["item_quantity"]; ?></td>
                <td><?php echo $values["item_price"]; ?></td>
                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?><span class="text-danger">Remove</span></td>
                
            </tr>
            <php
        }
    }
    ?>

</body>
</html>