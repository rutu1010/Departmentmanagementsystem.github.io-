<?php
session_start();
if(isset($_POST["post"])){ 
     
    $tit=$_POST['sub'];
    $sid=$_SESSION['eno'];
    $name=$_SESSION['name'];
    $desc=$_POST['desc'];
    $f=$_POST['from'];
    $t=$_POST['to'];
    
    $date1=date_create($f);
    $date2=date_create($t);
    $diff=date_diff($date1,$date2);
    $count= $diff->format("%a");
    
    require '../connection.php';
    $conn=new mysqli($hm,$un,$pw,$db);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        $sql = "INSERT INTO `leave`( `sid`, `name`, `sub`, `desc`, `from`, `to`,`count`) VALUES ('$sid','$name','$tit','$desc','$f','$t','$count')";
        if ($conn->query($sql) == TRUE) 
        {
            echo "<script>alert('Applied Sucesfully')</script>";  
        }
        else
        {
             echo "<script>alert('Error: $sql <br> $conn->error')</script>";   
        }
    }
    $conn->close();
}
echo '<a href="leave.php">Back to Application</a>';
echo '<script>window.location.replace("leave.php");</script>'
?>

