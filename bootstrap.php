<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Categories</h1>
        <div class="table responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbName = "mobile_shop";
                    $conn = new mysqli($servername, $username, $password, $dbName);

                    $query = "SELECT * FROM categories ORDER BY c_id ASC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td scope="row">' . $row["c_id"] . '</td><td>' . $row["c_name"] . '</td></tr>';
                            }
                        } else {
                            echo "error";
                        }
                    }
                    ?>
                </tbody>
        </div>
        </table>

        <div>
            <h3>Updating Category</h3>
            <?php
            $categories2 = "";
            $c_name = "";
            if (isset($_POST['update'])) {
                $sql2 = "UPDATE categories SET c_name";
            }
            if (isset($_POST['submit'])) {
                $c_name = $_POST['c_name'];
                $sql2 = "INSERT categories (c_name) VALUES('$c_name')";
                if ($conn->query($sql2) === TRUE) {
                    $last_id = $conn->insert_id;
                    $sql2 = "INSERT categories (c_name) VALUES ('$last_id', '$c_name')";
                    if ($conn->query($sql2) === TRUE) {
                        echo "Category updated successfully";
                    } else {
                        echo "Error in updating category" . $conn->error;
                    }
                }
            }
            ?>

            <form method="post" id="">
                <input type="text" id="c_name2" name="c_name2">
                <select id="c_id" name="c_id">
                    <?php
                    //select from classes - dropdown
                    $sql2 = "SELECT * FROM categories";
                    $result2 = $conn->query($sql2);
                    $count2 = mysqli_num_rows($result2);
                    if ($count2 > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "<option value=" . $row['c_id'] . ">" . $row['c_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" name="update" value="update category">
            </form>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('.editUser').click(function(){
    let id = $(this).attr("data-id");
    let c_name = $(this).attr("data-c_name");
    let c_id = $(this).attr("data-c_id");
    $('#c_name').val(c_name);
    $('#c_id').val(c_id);
})
</script>

</html>