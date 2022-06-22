<?php

if(isset($_POST['signup']))
{
  $name=$_POST['fname'];
  $lname=$_POST['sname'];
  $mname=$_POST['mname'];
  $email=$_POST['email'];
  $eno=$_POST['eno'];
  $sno=$_POST['smono'];
  $pno=$_POST['pmono'];
  $pass=$_POST['scpass'];
  $cpass=$_POST['spass'];
  $year=$_POST['year'];
  $image = $_FILES['file']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));  
  if($cpass==$pass)
  {
    require '../connection.php';
     try
        {
            $conn = new PDO("mysql:host=$hm; dbname=$db", $un, $pw);   
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "INSERT INTO `sutd_detail` (`name`, `lname`, `mname`, `eno`, `email`, `pass`, `year`, `mono`, `pmono`,`recept`) VALUES ('$name', '$lname', '$mname', '$eno', '$email', '$cpass', '$year', '$sno', '$pno','$imgContent');";
            $conn->exec($sql);
            echo "<script>alert('Student Registered Sucesfully')</script>";  
            $conn=null;
        }
        catch(PDOException $e)
        { 
            echo "Connection failed: " . $e->getMessage(); 
        } 
            $conn=null;


  }
  else
  {
    echo"<script>alert('Both password must be same')</script>";
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
  <title> ELECTRONIC & TELECOMMUNICATION ENGINEERING</title>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"> ELECTRONIC & TELECOMMUNICATION ENGINEERING</span>
      </div>
    </div>
  </nav>
  <br><br>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="card" style="width: 40rem;">
        <div class="card-header">
          <img src="https://getmyuni.azureedge.net/college-images-test/deogiri-institute-of-engineering-and-management-studies-diems-aurangabad/6750521d00e04f49a0f0b34c2a4c3fba.jpeg"
            class="card-img-top" alt="...">
        </div>
        <div class="card-body">
          <center>
            <h5 class="card-title text-center">Register student</h5>
            <hr>
          </center>
          <br>
          <form method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="inputEmail3" name="sname" required placeholder='Last Name'>
              </div>
               <div class="col-sm-4">
                <input type="text" class="form-control" id="inputEmail3" name="fname" required placeholder='First Name'>
              </div>
               <div class="col-sm-3">
                <input type="text" class="form-control" id="inputEmail3" name="mname" required placeholder='Middle Name'>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name="email" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="scpass" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"  require>Conform Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="spass" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword6" class="col-sm-2 col-form-label">Enrollent Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword6" name="eno" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword7" class="col-sm-2 col-form-label">Student Mobile Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword7" name="smono" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword8" class="col-sm-2 col-form-label">Parents Mobile Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword8" name="pmono" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword10" class="col-sm-2 col-form-label">Admission Recept</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="inputPassword10" name="file" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
              <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="year" required>
                  <option selected disabled>none</option>
                  <option value="1">First Year</option>
                  <option value="2">Second Year</option>
                  <option value="3">Third Year</option>
				  <option value="4">Fourth Year</option>
                </select>
              </div>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
            </div>
          </form>
          <br>
          <a href="login.php">Student Login</a>
          <br>
          <br><br>
        </div>
      </div>
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