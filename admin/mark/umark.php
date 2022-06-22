<?php
session_start();
$subid=$_SESSION['id'];
if(isset($_POST['save']))

{

    $id=$_POST['id'];

    $mark=$_POST['mark'];

 require '../../connection.php';

    $conn=new mysqli($hm,$un,$pw,$db);

    if ($conn->connect_error) 

    {

        die("Connection failed: " . $conn->connect_error);

    }

    else

    {

        $sql = "UPDATE `marks` SET `om` = '$mark' WHERE `marks`.`id` = $id;";

        if ($conn->query($sql) == TRUE) 

        {

    $conn->close();



            echo "<script>

                alert('Marks uploaded sucesfully');

                window.location.href='addmark.php?id=$subid';

            </script>";  

        }

        else

        {

    $conn->close();



             echo "<script>

                alert('Error occured');

                window.location.href='addmarks.php?id=$subid';

            </script>";   

        }

    }

  

}

?>