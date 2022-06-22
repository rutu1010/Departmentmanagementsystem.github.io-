<?php
session_start();
    $id=$_GET['id'];
    require_once '../../connection.php';
    $sql ="SELECT * FROM `subject` WHERE id='$id'"; 
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
    { 
        foreach($result as $user)
        {
            $_SESSION['id']=$user['id'];
            $_SESSION['year']=$user['year'];
            $_SESSION['sem']=$user['sem'];
            $_SESSION['term']=$user['term'];
            $_SESSION['subject']=$user['sub'];
            $_SESSION['tm']=$user['tm'];
            break;
        }
    }
    unset($result);
    $conn=null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Department Management System</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Department Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../art_g.php">Art Gallery</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="../notice.php">Notice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Marks.php">Marks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../leave.php">Leave</a>
                    </li>
                </ul>
            </div>
    </nav>
    <div class="container"><br>
        <div class="card">
            <div class="card-body">
            <h2><?php echo $_SESSION['subject']?></h2>
            <h6><?php echo 'Year : '.$_SESSION['year']."<br> Semester : ".$_SESSION['sem'].'<br> Total Marks : '.$_SESSION['tm'];?></h6><hr>
                 <div class="table-responsive card ">


                 

        <table class="table ">
           <thead>
                <tr>
                    <th scope="col">Sr No</th>
                    <th scope="col">Enrollment No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Marks</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                $subid=$_SESSION['id'];
                $sql ="SELECT * FROM `marks` WHERE subid='$subid' "; 
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
                        ?>
                        <tr>
                            <th scope="row"><?php echo $sr?></th>
                            <td><?php echo $user['eno'];?></td>
                            <td><?php echo $user['name'];?></td>
                            <td>
                            <?php
                                if($user['om']==-1)
                                {
                            ?>
                                <form method='post' action='umark.php'>
                                        <input type="hidden"  class="form-control-plaintext"  value="<?php echo $user['id'];?>" name='id'>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Marks Obtain</label>
                                        <div class="col-sm-3">
                                        <input type="text" class="form-control" id="inputPassword" name='mark'>/<?php echo $_SESSION['tm']; ?>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                        <input type="submit" class="form-control btn btn-primary" value='Save' name='save'>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                }
                                else
                                {
                                    echo $user['om'];
                                }
                                ?>
                            </td>
                           
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">  No Student Added <form action="addstud.php" method="POST">
                    <input type="submit" class="btn btn-outline-primary" value="Add Student" name="add">
                 </form> </div>';
                }
                 unset($result);
                $conn=null;
            ?>
            </tbody>
        </table>
        </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous">
    </script>
</body>

</html>