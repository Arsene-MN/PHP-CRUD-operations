<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="post">
        <h1>Enter the marks of students</h1>
        <label for="regno">RegNo</label>
        <input type="text" name="regno"><br><br>
        <label for="ass">CAT</label>
        <input type="number" name="ass"><br><br>
        <label for="exam">Exam</label>
        <input type="number" name="exam"><br><br>
        <label for="class">Class</label>
        <input type="text" name="class"><br><br>
        <input type="submit" value="Save Marks">
    </form>
</body>
</html>


<!-- connection.php -->
<?php
$servername = 'localhost';
$username ='root';
$password ='playhasnolimit5';
$dbname ='Marks_management';

$conn = new msqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    exit('Connection failed: '.$conn->connect_error);
}
?>



<!-- create and signup-->
<?php
include 'connection.php';

if(isset($_POST['submit'])){
    $regno = $_POST['regno'];
    $ass = $_POST['ass'];
    $exam = $_POST['exam'];
    $class = $_POST['class'];
    $total = $ass + $exam;

    $sql = "INSERT INTO marks(regno,ass,exam,class,total) VALUES('$regno','$ass','$class','$total')";
    $result = $conn->query($sql);

    if ($result == true){
        echo 'New record created succesfully.';
    }
    else{
        echo 'Error:'.$sql.'<br>'.$conn->error;
    }
    $conn->close();
}
?>

<!-- view records -->
<?php
include 'connection.php';
$sql = 'SELECT * FROM marks';
$result = $conn->query($sql);
?>


<html>

    <body>
        <div class="container">
            <h1>The Entered Student Marks are:</h1>
            <table cellspacing='2px' tableborder='2px'>
                <thead>
                    <tr>
                        <th>Registration Number</th>
                        <th>CAT</th>
                        <th>EXAM</th>
                        <th>Class</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                            td><?php echo $row['id']; ?></td>
<td><?php echo $row['regno']; ?></td>
<td><?php echo $row['ass']; ?></td>
<td><?php echo $row['exam']; ?></td>
<td><?php echo $row['class']; ?></td>
<td><?php echo $row['total']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

