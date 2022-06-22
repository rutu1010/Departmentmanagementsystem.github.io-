<?php
    session_start();
    if(!isset($_SESSION['email']))
    {
        header("location:login.php");
    }
    if(isset($_POST['signup']))
        {
            $name=$_POST['fname'];
            $lname=$_POST['lname'];
            $mname=$_POST['mname'];
            $email=$_POST['email'];
            $eno=$_POST['eno'];
            $sno=$_POST['mono'];
            $year=$_POST['year'];
            require '../connection.php';
            $conn=new mysqli($hm,$un,$pw,$db);
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            else
            {
                $sql = "UPDATE `sutd_detail` SET `name`='$name',`lname`='$lname',`mname`='$mname',`eno`='$eno',`email`='$email',`year`='$year',`mono`='$sno' WHERE `sutd_detail`.`id` = ".$_SESSION['id']."; ";
                if ($conn->query($sql) == TRUE) 
                {
                     $conn->close();
                    $_SESSION['name']=$name.' '.$lname;
                    $_SESSION['fname']=$name;
                    $_SESSION['lname']=$lname;
                    $_SESSION['mname']=$mname;
                    $_SESSION['eno']=$eno;
                    $_SESSION['mono']=$sno;
                    $_SESSION['email']=$email;
                    $_SESSION['year']=$year;
                    echo "<script>alert('Student Data updated Sucesfully')</script>";  
                }
                else
                {
                    $conn->close();
                    echo "<script>alert('Error: $sql <br> $conn->error')</script>";   
                }
            }
            
        } 
      
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="art_g.php">Art Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="leave.php"> Leave</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="Marks.php"> Result </a>
                    </li>
                    <li class="d-flex  nav-item">
                        <div class="me-2 p-2 alert-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg><?php echo " ".$_SESSION['name']?>
                            <a class="btn btn-outline-danger" href='logout.php' >Logout</a>
                        </div>
                    </li>
                </ul>
           
                
        </div>
    </nav>
    <div class="container">
    <br>
        <div class="card">
            <div class="card-body">
            <h2>Notice</h2>
         <div class="table-responsive">
        <table class="table">
           <thead>
                <tr>
                <th scope="col">srno</th>
                <th scope="col">Title</th>
                <th scope="col">Date</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sid=$_SESSION['id'];
                require_once '../connection.php';
                $sql ="SELECT * FROM  notice"; 
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
                            <td><?php echo $user['tittle'];?></td>
                            <td><?php echo $user['time']?></td>
                            <td><a href='view.php?id=<?php echo $user['id']?>' class='btn btn-danger'>View</a></td>                           
                        </tr>
                        <?php
                    }
                }
                 unset($result);
                $conn=null;
            ?>
            </tbody>
        </table>
        </div>
        <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Art Gallery</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="card-group">
                    <?php
                $sid=$_SESSION['id'];
                require_once '../connection.php';
                $sql ="SELECT * FROM  agalery WHERE state='1'"; 
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
                            
                                <div class="card">
                                <?php
                                    echo '<img src="data:image/jpg;base64,' .  base64_encode($user['post'])  . '" />';

                                ?>
                                    <img src="" class="card-img-top" >
                                    <div class="card-body">
                                    <h5 class="card-title"><?php echo $user['tittle']?></h5>
                                    <p class="card-text"><?php echo $user['name']?></p>
                                    </div>
                                </div>
                           
                        <?php
                    }
                }
                 unset($result);
                $conn=null;
            ?>
             </div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  
                <div class="row justify-content-md-center">
                <div class="card" style="width: 40rem;">
                     <center><br>
                     <h5 class="card-title text-center">Student Profile</h5>
                        <hr>
                        <div class="card-img-top" alt="...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40%" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    <div class="card-body">   
                    </center>
                    <br>
                    <form method="POST">
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputEmail3" name="fname" require="" value="<?php echo $_SESSION['fname']?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputEmail3" name="lname" require="" value="<?php echo $_SESSION['lname']?>">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputEmail3" name="mname" require="" value="<?php echo $_SESSION['mname']?>">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label" >Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" name="email" require="" value="<?php echo $_SESSION['email']?>">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label" >Enrollment No</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="eno" require="" value="<?php echo $_SESSION['eno']?>">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label" >Mobile number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="mono" require="" value="<?php echo $_SESSION['mono']?>">
                        </div>
                        </div>
                
                        <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="year" required="">
                            <option value="1" <?php if($_SESSION['year']==1){echo 'selected';}?>>First Year</option>
                            <option value="2" <?php if($_SESSION['year']==2){echo 'selected';}?>>Second Year</option>
                            <option value="3" <?php if($_SESSION['year']==3){echo 'selected';}?>>Third Year</option>
                            </select>
                        </div>
                        </div>
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="signup">Update</button>
                        </div>
                    </form>
                    <br>
                    </div>
                </div>
  
  </div>
</div>
                </div>
            </div>
            <hr>
            
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
    crossorigin="anonymous"></script>
</body>

</html>