<?php

if(isset($_POST["post"])){ 

     

    $tit=$_POST['title'];

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

        $sql = "INSERT INTO `notice` (`tittle`,`post`) VALUES ('$tit', '$imgContent');";

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

echo '<a href="notice.php">Back to art notice</a>';
#echo '<script>window.location.replace("notice.php");</script>'
?>



