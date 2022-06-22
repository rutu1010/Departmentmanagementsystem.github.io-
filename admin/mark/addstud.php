<?php
if(isset($_POST['add']))
{
    session_start();

                require '../../connection.php';
                $year=$_SESSION['year'];
                $sem=$_SESSION['sem'];
                $term=$_SESSION['term'];
                $subid=$_SESSION['id'];
                $sub=$_SESSION['subject'];
                $tm=$_SESSION['tm'];
                $result1=array();
                // print_r($_SESSION);
                try
                {
                    $conn1 = new PDO("mysql:host=$hm; dbname=$db", $un, $pw);   
                    //$conn1->setAttribute(PDO::ATTR_EMULATE_PREPARES, true); // i've tried true/false
                    $conn1->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                    $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //$conn1->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $sql ="SELECT name,id,mname,lname,eno FROM  sutd_detail where year='$year'"; 
                $query= $conn1 -> prepare($sql);
                $query-> execute();
                $result = $query -> fetchAll();
                if($query -> rowCount() > 0)
                { 
                    foreach($result as $user)
                    {
                        $sid=$user['id'];
                        $sname=$user['name'].' '.$user['mname'].' '.$user['lname'];
                        $eni=$user['eno'];
                        $sql1="INSERT INTO `marks`(`sid`, `subid`, `name`, `year`, `sem`, `term`, `subname`,  `tm`,`eno`) VALUES ('$sid','$subid','$sname','$year','$sem','$term','$sub','$tm','$eni')";
                        array_push($result1,$sql1);
                    }
                unset($result);
                $conn1=null;
                $_SESSION['sql']=$result1;
                header("location:insert.php");
                }
                else
                {
                    echo 'error';
                }
                }
                catch(PDOException $e)
                { 
                    echo "Connection failed: " . $e->getMessage(); 
                } 
                
                $conn1=null;

}
               

?>