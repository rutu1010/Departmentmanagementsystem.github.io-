<?php
 if(isset($_POST['set']))
    {
        $year=$_POST['year'];
        $sem=$_POST['sem'];
        $term=$_POST['term'];
        $sub=$_POST['sub'];
        $tm=$_POST['tm'];
        print_r($_POST);
        require '../connection.php';
        $conn=new mysqli($hm,$un,$pw,$db);
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "INSERT INTO `subject`(`year`, `sem`, `term`, `sub`, `tm`) VALUES ('$year','$sem','$term','$sub','$tm')";
            if ($conn->query($sql) == TRUE) 
            {
                echo "<script>alert('Subject Created');
                window.location.href='Marks.php';
                </script>";

            }
            else
            {
                echo "<script>alert('Error: $sql <br> $conn->error')</script>";   
            }
        }
        $conn->close();
        }

?>