<?php
session_start();
if(isset($_POST["post"])){ 
     
    $tit=$_POST['title'];
    $sid=$_SESSION['id'];
    $name=$_SESSION['name'];
    $year=$_SESSION['year'];
    $image = $_FILES['file']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 
    require '../connection.php';
    $conn=new mysqli($hm,$un,$pw,$db);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        $sql = "INSERT INTO `agalery` (`tittle`, `sid`, `name`, `year`, `post`) VALUES ('$tit', '$sid', '$name', '$year','$imgContent');";
        if ($conn->query($sql) == TRUE) 
        {
            echo "<script>alert('Posted Sucesfully')</script>";  
        }
        else
        {
             echo "<script>alert('Error: $sql <br> $conn->error')</script>";   
        }
    }
    $conn->close();
}
echo '<a href="art_g.php">Back to art gallery</a>';
echo '<script>window.location.replace("art_g.php");</script>'
?>

