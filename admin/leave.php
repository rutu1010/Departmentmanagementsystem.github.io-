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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="art_g.php">Art Gallery</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="notice.php">Notice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Marks.php">Marks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="leave.php">Leave</a>
                    </li>
                </ul>
            </div>
    </nav>
            <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pending Aprovel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Approved Leave</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Disapproved Leave</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    



                        <div class="table-responsive">
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Sr No</th>
                <th scope="col">Enrollment <br>No</th>
                <th scope="col">Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Descreption</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Number <br> of Days</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once '../connection.php';
                $sql ="SELECT * FROM `leave` WHERE state='0' order by id desc"; 
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
                            <td><?php echo $user['sid'];?></td>
                            <td><?php echo $user['name'];?></td>
                            <td><?php echo $user['sub'];?></td>
                            <td><?php echo $user['desc'];?></td>
                            <td><?php echo $user['from'];?></td>
                            <td><?php echo $user['to'];?></td>
                            <td><?php echo $user['count'];?></td>
                            <td><a href="aleave.php?id=<?php echo $user['id'];?>" class='btn btn-outline-success m-2'>Approve</a><a href="dleave.php?id=<?php echo $user['id'];?>" class='btn btn-danger m-2'>Dis-approve</a></td>
                           
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">  No Leave to approval </div>';
                }
                 unset($result);
                $conn=null;
            ?>
            </tbody>
        </table>
        </div>

                    
                    
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
                        <div class="table-responsive">
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Sr No</th>
                <th scope="col">Enrollment <br>No</th>
                <th scope="col">Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Descreption</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Number <br> of Days</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once '../connection.php';
                $sql ="SELECT * FROM `leave` WHERE state='1' order by id desc"; 
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
                            <td><?php echo $user['sid'];?></td>
                            <td><?php echo $user['name'];?></td>
                            <td><?php echo $user['sub'];?></td>
                            <td><?php echo $user['desc'];?></td>
                            <td><?php echo $user['from'];?></td>
                            <td><?php echo $user['to'];?></td>
                            <td><?php echo $user['count'];?></td>
                           
                           
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
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    
                    <div class="table-responsive">
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Sr No</th>
                <th scope="col">Enrollment <br>No</th>
                <th scope="col">Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Descreption</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Number <br> of Days</th>

                </tr>
            </thead>
            <tbody>
            <?php
                require_once '../connection.php';
                $sql ="SELECT * FROM `leave` WHERE state='2' order by id desc"; 
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
                            <td><?php echo $user['sid'];?></td>
                            <td><?php echo $user['name'];?></td>
                            <td><?php echo $user['sub'];?></td>
                            <td><?php echo $user['desc'];?></td>
                            <td><?php echo $user['from'];?></td>
                            <td><?php echo $user['to'];?></td>
                            <td><?php echo $user['count'];?></td>
                           
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