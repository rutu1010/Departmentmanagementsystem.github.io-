<?php
$id=$_GET['id'];
 require '../connection.php';
    $conn=new mysqli($hm,$un,$pw,$db);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    else
    {
        $sql = "UPDATE `leave` SET `state` = '2' WHERE `leave`.`id` = $id;";
        if ($conn->query($sql) == TRUE) 
        {
            $x= "Posted Dis-Approvd Sucesfully ";  
        }
        else
        {
            $x= "Post Dis-Approved Failed ";   
        }
    }

    echo 'alert($x)<a href="leave.php" >Back to Leave</a> <script>window.location.replace("leave.php");</script>';
    $conn->close();

?>