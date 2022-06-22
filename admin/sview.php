<?php

$sid=$_GET['id'];
                require_once '../connection.php';
                $sql ="SELECT recept FROM  sutd_detail where id=$sid"; 
                try
                {
                    $conn = new PDO("mysql:host=$hm; dbname=$db", $un, $pw);   
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                }
                catch(PDOException $e)
                { 
                    echo "Connection failed: " . $e->getMessage(); 
                } 
                $query= $conn -> prepare($sql);
                $query-> execute();
                $result = $query -> fetchAll();
                if($query -> rowCount() > 0)
                { $sr=0;
                    foreach($result as $user)
                    {$sr++;
                    
                        echo '<img src = "data:image/png;base64,' . base64_encode($user['recept']) . '" width = "100%"/>';
                    }
                }
                 unset($result);
                $conn=null;
?>