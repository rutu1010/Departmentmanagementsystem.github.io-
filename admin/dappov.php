<?php

$id=$_GET['id'];
$x='';
 require '../connection.php';

    $conn=new mysqli($hm,$un,$pw,$db);

    if ($conn->connect_error) 

    {

        die("Connection failed: " . $conn->connect_error);

    }

    else

    {

        $sql = "UPDATE `agalery` SET `state` = '2' WHERE `agalery`.`id` = $id;";

        if ($conn->query($sql) == TRUE) 

        {

            $x= "Posted Approvd Sucesfully ";  

        }

        else

        {

            $x= "Post Approved Failed ";   

        }

    }
  
    echo "<script>alert('$x');
    window.location.replace('art_g.php');
    </script>";
    $conn->close();

?>