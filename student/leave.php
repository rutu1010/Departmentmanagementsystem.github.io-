<?php
session_start();
    if(!isset($_SESSION['email']))
    {
        header("location:login.php");
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
        <div class="row justify-content-md-center">
                <div class="card" style="width: 100%;">
                     <center><br>
                     <h5 class="card-title text-center">Apply Leave</h5>
                    <hr>
                    <div class="card-body">   
                    </div></center>
                    
                    <form method="POST" action='aleave.php'>
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="sub" required>
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="inputEmail6" class="col-sm-2 col-form-label" >From</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputEmail6" name="from"  min="<?php echo date('Y-m-d');?>" required>
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="inputEmail8" class="col-sm-2 col-form-label">To</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputEmail38" name="to" min="<?php echo date('Y-m-d');?>" required>
                        </div>
                        </div>


                        <div class="row mb-3">
                        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Descreption</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name='desc' rows="3" required></textarea>
                        </div>
                        </div>
                      
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="post">Apply</button>
                        </div>
                    </form>
                    <br>
                    </div>
                </div>
<hr>
        <h5 class="card-title text-center">My Leave</h5>
        <div class="table-responsive">
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Sr No</th>
                <th scope="col">Subject</th>
                <th scope="col">Descreption</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Number <br> of Days</th>
                <th scope="col">State</th>

                </tr>
            </thead>
            <tbody>
            <?php
                $sid=$_SESSION['eno'];
                require_once '../connection.php';
                $sql ="SELECT * FROM `leave` WHERE sid='$sid' "; 
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
                            <td><?php echo $user['sub'];?></td>
                            <td><?php echo $user['desc'];?></td>
                            <td><?php echo $user['from'];?></td>
                            <td><?php echo $user['to'];?></td>
                            <td><?php echo $user['count'];?></td>
                            <td>
                            <?php 
                                
                                if($user['state']==0)
                                {
                                    echo '<p class="text-warning">Approval Pending</p>';
                                }
                                elseif($user['state']==1)
                                {
                                    echo '<p class="text-sucess">Approved</p>';
                                }
                                else
                                {
                                    echo '<p class="text-danger">Sorry your Leavet is Denied</p>';
                                }
                            ?></td>
                           
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