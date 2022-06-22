
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

    <script>
        function changesem()
        {   
            document.getElementById('sem').innerHTML='<option disabled selected>none</option>';
            var getValue = document.getElementById('year').selectedOptions[0].value;
            var x = document.getElementById("sem");
            if(getValue=='1')
            {
                var option = document.createElement("option");
                option.text = "Semester 1";
                option.value="1";
                x.add(option);
                var option2 = document.createElement("option");
                option2.text = "Semester 2";
                option2.value="2";
                x.add(option2);
            }
            else if(getValue=='2')
            {
                var option = document.createElement("option");
                option.text = "Semester 3";
                option.value="3";
                x.add(option);
                var option2 = document.createElement("option");
                option2.text = "Semester 4";
                option2.value="2";
                x.add(option2);
            }
            else if(getValue=='3')
            {
                var option = document.createElement("option");
                option.text = "Semester 5";
                option.value="5";
                x.add(option);
                var option2 = document.createElement("option");
                option2.text = "Semester 6";
                option2.value="6";
                x.add(option2);
            }
			else if(getValue=='4')
            {
                var option = document.createElement("option");
                option.text = "Semester 7";
                option.value="7";
                x.add(option);
                var option2 = document.createElement("option");
                option2.text = "Semester 8";
                option2.value="8";
                x.add(option2);
            }
            else
            {
                document.getElementById('sem').innerHTML='<option disabled selected>none</option>';
            }
            document.getElementById('sub').value='';
        }
    </script>
    <div class="container">

        <div class="card">
            <div class='card-header'>Marking System</div>
            <div class="card-body">
            <h2>Creae Subject</h2><hr>
                  <form class="row g-3" method='post' action='asub.php'>
                    <div class="col-md-3">
                        <label for="year" class="form-label">Year</label>
                        <select id="year" class="form-select" onchange='changesem()' required name='year'>
                            <option disabled selected>none</option>
                            <option value='1'>First Year</option>
                            <option value='2'>Second Year</option>
                            <option value='3'>Third Year</option>
							<option value='4'>Fourth Year</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sem" class="form-label">Sem</label>
                        <select id="sem" class="form-select" required name='sem'>
                            <option disabled selected>none</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="sem" class="form-label">Term</label>
                        <select id="sem" class="form-select" required name='term'>
                            <option disabled selected>none</option>
                            <option value='1'>CA1</option>
                            <option value='2'>CA2</option>                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="sub" class="form-label">Subject</label>
                        <input class="form-control" type='text' id='sub' required name='sub'>
                    </div>
                    <div class="col-md-2">
                        <label for="sub" class="form-label">Total Marks </label>
                        <input class="form-control" type='text' id='sub' required name='tm'>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" name='set'>Create</button>
                    </div>
                </form>
                <br>    

                <div class="table-responsive">
                <h2>All Subject</h2><hr>
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Year</th>
                <th scope="col">Semester</th>
                <th scope="col">Term</th>
                <th scope="col">Subject</th>
                <th scope="col">Total Marks</th>
                <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
            <?php
                require_once '../connection.php';
                $sql ="SELECT * FROM `subject`;"; 
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
                            <th scope="row">
                            <?php 
                            $x=$user['year'];
                            if($x==1)
                            {
                                echo "First Year";
                            }
                            else if($x==2)
                            {
                                echo "Second Year";
                            }
                            else
                            {
                                echo "Third Year";
                            }
                            ?></th>
                            <td><?php echo $user['sem'];?></td>
                            <td>
                            <?php 
                            $x=$user['term'];
                            if($x==1)
                            {
                                echo "1<sup>st</sup> Unit";
                            }
                            else
                            {
                                echo "2<sup>nd</sup> Unit";
                            }
                            ?>
                            </td>
                            <td><?php echo $user['sub'];?></td>
                            <td><?php echo $user['tm'];?></td>
                            <td><a href='mark/addmark.php?id=<?php echo $user['id']?>' class='btn btn-outline-success'>Upload Marks</a></td>
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