<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registraring 2 forms and updating with jQuery</title>
    <style>
    table{
        width: 100%;
    }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "students";
    $conn = new mysqli($servername, $username, $password, $dbName);
    $student_name="";
    $class_name="";
    $sql3 = "SELECT student.*, classes.*, std_class.* FROM std_class JOIN student ON student.s_id=std_class.s_id JOIN classes ON classes.c_id=std_class.c_id";
    $result3 =$conn->query($sql3);
    $count = mysqli_num_rows($result3);
    if($count > 0){
        echo "<table><tr><th>ID</th><th>Student Name</th><th>Classes</th><th>Actions</th>";
        while($row = $result3->fetch_assoc()){
            echo "<tr><td>".$row['s_id']."</td><td>".$row['s_name']."</td><td>".$row['c_name']."</td><td><button class='editUser' data-id=".$row['s_id']."data-s_name=".$row['s_name']."data-c_id=".$row['c_id'].">Edit</button></td></tr>";
        }
        echo "</table>";
    }
    
    if(isset($_POST['update'])){
        //query of update write here
    }
    if(isset($_POST['submit'])){
        $student_name = $_POST['s_name'];
        $class_name = $_POST['c_name'];
        $sql = "INSERT student (s_name) VALUES('$student_name')";
        if($conn->query($sql)===TRUE){
            $last_id = $conn->insert_id;
            $sql2 = "INSERT std_class (s_id, c_id) VALUES ('$last_id', '$class_name')";
            if($conn->query($sql2)===TRUE){
                echo "Student registered successfully";
            } else {
                echo "Error in student registration" .$conn->error;
            }
        }
    }

    ?>
    <h2>Student registration</h2>
    <form method="post">
        <input type="text" name="s_name">
        <select name="c_name">
        <?php 
        //select from classes - dropdown
        $sql2 = "SELECT * FROM classes";
        $result2 = $conn->query($sql2);
        $count2 = mysqli_num_rows($result2);
        if($count2 > 0){
            while($row = $result2->fetch_assoc()){
                echo "<option value=".$row['c_id'].">".$row['c_name']."</option>";
            }
        }
        ?>
        </select>
        <input type="submit" name="submit" value="Register student">
    </form>

    <h2>Student update form</h2>
    <form method="post" id="">
        <input type="text" id="s_name" name="s_name">
        <select id="c_name" name="c_name">
        <?php 
        //select from classes - dropdown
        $sql2 = "SELECT * FROM classes";
        $result2 = $conn->query($sql2);
        $count2 = mysqli_num_rows($result2);
        if($count2 > 0){
            while($row = $result2->fetch_assoc()){
                echo "<option value=".$row['c_id'].">".$row['c_name']."</option>";
            }
        }
        ?>
        </select>
        <input type="submit" name="update" value="Register student">
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('.editUser').click(function(){
    let id = $(this).attr("data-id");
    let s_name = $(this).attr("data-s_name");
    let c_id = $(this).attr("data-c_id");
    $('#s_name').val(s_name);
    $('#c_name').val(c_id);
})
</script>
</html>