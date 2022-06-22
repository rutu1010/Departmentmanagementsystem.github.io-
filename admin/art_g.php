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
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Art Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Approve Art <span class="badge bg-secondary" id='bg'></span></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-group">
                            <?php
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
                                                <img src="" class="card-img-top">
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

                            <?php
                                require_once '../connection.php';
                                $sql ="SELECT * FROM  agalery WHERE state='0'"; 
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
                                                <img src="" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $user['tittle']?></h5>
                                                    <p class="card-text"><?php echo $user['name']?></p>
                                                    <a href='appov.php?id=<?php echo $user["id"]?>' class='btn btn-outline-success'>Approv Post</a>
                                                    <a href='dappov.php?id=<?php echo $user["id"]?>' class='btn btn-outline-danger'>Disapprov Post</a>
                                                </div>
                                            </div>

                                            <?php
                                    }
                                    echo "<script>document.getElementById('bg').innerHTML=$sr;</script>";
                                }
                                else
                                {
                                    echo '<br><br><div class="alert alert-danger" role="alert"> No Art for approval</div>';
                                }
                                unset($result);
                                $conn=null;
                            ?>

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