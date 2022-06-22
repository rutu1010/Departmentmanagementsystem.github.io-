<?php



session_start();
$id=$_SESSION['id'];
$sql=$_SESSION['sql'];

    require '../../connection.php';

    try 

    {

        $conn = new PDO("mysql:host=$hm; dbname=$db", $un, $pw); 

        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach($sql as $q)

        {

            // echo $q;

            $conn->exec($q);

        }

        header('location:addmark.php?id=$id');

        // echo "New record created successfully";

    } 

    catch(PDOException $e) 

    {

        echo   $e->getMessage();

    }



$conn = null;



?>