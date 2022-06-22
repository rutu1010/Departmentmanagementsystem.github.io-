
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
    <div class="container">
    <br>
    
        <div class="row justify-content-md-center">
                <div class="card" style="width: 100%;">
                     <center><br>
                     <h5 class="card-title text-center">Notice</h5>
                        <hr>
                    <div class="card-body">   
                    </div></center>
                    
                    <form method="POST" action='anotice.php' enctype="multipart/form-data">
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="title" require="">
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputEmail3" name="file" require="">
                        </div>
                        </div>
                      
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="post">Post</button>
                        </div>
                    </form>
                    <br>
                    </div>
                </div>
<hr>
        <h5 class="card-title text-center">All Notice</h5>
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
               # $sid=$_SESSION['id'];
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