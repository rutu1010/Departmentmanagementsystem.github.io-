<?php
session_start();
// print_r($_SESSION);
$tom=0;
$ttm=0;
$v='display:none';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script >
        window.onload=function(){
    document.getElementById('topdf').addEventListener("click",()=>{
        const pdf1=document.getElementById('pdf');
        // console.log(pdf1);
        // console.log(window);
        var opt = {
            margin:       0.5,
            filename:     '<?php echo $_SESSION["name"]." Result Semister_".$_POST["sem"]."_sessional_ ".$_POST["term"]?>.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(pdf1).save();
    })
}
        </script>
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
        }
    </script>
    <div class="container">

        <div class="card">
            <div class='card-header'>Result</div>
            <div class="card-body">
                  <form class="row g-3" method='post' >
                    <div class="col-md-4">
                        <label for="year" class="form-label">Year</label>
                        <select id="year" class="form-select" onchange='changesem()' required name='year'>
                            <option disabled selected>none</option>
                            <option value='1'>First Year</option>
                            <option value='2'>Second Year</option>
                            <option value='3'>Third Year</option>
							<option value='4'>Fourth Year</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sem" class="form-label">Sem</label>
                        <select id="sem" class="form-select" required name='sem'>
                            <option disabled selected>none</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sem" class="form-label">Term</label>
                        <select id="sem" class="form-select" required name='term'>
                            <option disabled selected>none</option>
                            <option value='1'>CA1</option>
                            <option value='2'>CA2</option>                            
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" name='set'>View Result</button>
                    </div>
                </form>
                <br>  


                <div class='btn btn-outline-primary' id='topdf' style='display:none'>Download</div>
                 <div class="table-responsive" id='pdf'>





                <?php
                if(isset($_POST['set']))
                {
                    $year=$_POST['year'];
                    $sem=$_POST['sem'];
                    $term=$_POST['term'];
                    $sid=$_SESSION['id'];
                    // echo $sid;
                    $tom=0;
                    $ttm=0;
                ?>
<center>
                 <img src="../gpa.png" class="img-fluid" ></center>
                <div class="alert alert-success" role="alert">
                    Name : <?php echo $_SESSION['name']?><br>
                    Enrollment No : <?php echo $_SESSION['eno']?><br>
                    Year : <?php echo $year?> Semester : <?php echo $sem?> <br>Term : <?php $x=$term;
                            if($x==1)
                            {
                                echo "1<sup>st</sup> Unit";
                            }
                            else
                            {
                                echo "2<sup>nd</sup> Unit";
                            }?>
                </div>
                
        <table class="table">
           <thead>
                <tr>
                <th scope="col">Sr No</th>
                <th scope="col"> Subject </th>
                <th scope="col"> Obtain Marks</th>
                <th scope="col">Total Marks</th>
                </tr>
            </thead>
            <tbody>
            <?php

                require_once '../connection.php';
                $sql ="SELECT * FROM `marks` WHERE sid='$sid' and year='$year' and sem='$sem' and term='$term'and om>'-1' order by id desc"; 
                try
                {
                    $conn = new PDO("mysql:host=$hm; dbname=$db", $un, $pw);   
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                
                $query= $conn -> prepare($sql);
                $query-> execute();
                $result = $query -> fetchAll();
                if($query -> rowCount() > 0)
                { $sr=0;

                    foreach($result as $user)
                    {$sr++;
                        $v='display:block'
                        ?>
                        <script>
                            document.getElementById('topdf').style.display="inline-block";
                        </script>
                        <tr>
                            <th scope="row"><?php echo $sr?></th>
                            <td><?php echo $user['subname'];?></td>
                            <td><?php echo $user['om'];
                            $tom=$tom+$user['om'];
                            ?></td>
                            <td><?php echo $user['tm'];
                            $ttm=$ttm+$user['tm'];?></td>
                        </tr>
                        <?php
                    }

                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert"> No subject or result </div>';
                }
                unset($result);
                }
                catch(PDOException $e)
                { 
                    echo "Connection failed: " . $e->getMessage(); 
                } 
                
                $conn=null;
            ?>
            </tbody>
        </table>
<hr>
<div class="alert alert-primary" role="alert" style="<?php echo $v?>">
  <div class="row g-0">
  <div class="col-sm-6 col-md-5"></div>
  <div class="col-6 col-md-2">Total : <?php echo $ttm?> </div>
  <div class="col-6 col-md-2">Obtain Marks : <?php echo $tom?> </div>
  <div class="col-6 col-md-2">Persentage : <?php echo $tom*(100/$ttm);?> % </div>

    </div>
</div>
<?php 
}

?>

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