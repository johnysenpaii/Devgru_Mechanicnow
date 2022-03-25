<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(isset($_POST['register']))
{
    $custFirstname=$_POST['custFirstname'];
    $custLastname=$_POST['custLastname'];
    $custAddress=$_POST['custAddress'];
    $custEmail=$_POST['custEmail'];
    $custCnumber=$_POST['custCnumber'];
    $vehicleType=$_POST['vehicleType'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $role=$_POST['role'];

    //check password
  if ($_POST['Password']!= $_POST['custconfirmpassword'])
  {
    echo '<script>alert("Oops! Password did not match! Please try again.")</script>';
    echo "<script type='text/javascript'>document.location='./vehicleOwnerSignup.php';</script>";
  }
  else{
    //hashed password
    $input = $_POST['Password'];
    $hashedPwd = password_hash($Password, PASSWORD_DEFAULT);
    //check email
    $sql="SELECT * FROM customer WHERE custEmail = ?";
    $query = $dbh->prepare($sql);
    $query->execute([$custEmail]);
    $result = $query->rowCount();
    if($result > 0){
        //$error="<span class='text-danger'>Email hac already Exist!!</span>";
        echo '<script>alert("Oops! Email has already Exist!.")</script>';
        echo "<script type='text/javascript'>document.location='./vehicleOwnerSignup.php';</script>";
    }else{
      //check Username
      $sql2="SELECT * FROM customer WHERE Username = ?";
      $query = $dbh->prepare($sql2);
      $query->execute([$Username]);
      $result = $query->rowCount();
      if($result > 0){
          // $error="<span class='text-danger'>Username has already Exist!!</span>";
          echo '<script>alert("Oops! Username Already Exist!")</script>';
          echo "<script type='text/javascript'>document.location='./vehicleOwnerSignup.php';</script>";
      }else{
        $sql="SELECT * FROM customer WHERE Username=:Username";
        $query=$dbh->prepare($sql);
        $query->bindParam(':Username',$Username,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()>0)
        {
          echo "<script type='text/javascript'>document.location='../login.php';</script>";
        }else{
          $sql="INSERT INTO customer(custFirstname, custLastname, custAddress, custEmail, custCnumber, vehicleType, Username, Password, role,latitude,longitude)VALUES(:custFirstname, :custLastname, :custAddress, :custEmail, :custCnumber, :vehicleType, :Username, :hashedPwd, :role,:latitude,:longitude)";
          $query=$dbh->prepare($sql);
          $query->bindParam(':custFirstname',$custFirstname,PDO::PARAM_STR);
          $query->bindParam(':custLastname',$custLastname,PDO::PARAM_STR);
          $query->bindParam(':custAddress',$custAddress,PDO::PARAM_STR);
          $query->bindParam(':custEmail',$custEmail,PDO::PARAM_STR);
          $query->bindParam(':custCnumber',$custCnumber,PDO::PARAM_STR);
          $query->bindParam(':vehicleType',$vehicleType,PDO::PARAM_STR);
          $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
          $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
          $query->bindParam(':Username',$Username,PDO::PARAM_STR);
          $query->bindParam(':hashedPwd',$hashedPwd,PDO::PARAM_STR);
          $query->bindParam(':role',$role,PDO::PARAM_STR);
          $query->execute();

          session_regenerate_id();
        
          echo "<script type='text/javascript'>document.location='../login.php';</script>";
        }
      }
    }
  }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Mechanic Now | Signup</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body onload="getLocation()">
    <div class="btag">
        <div class="wrapper">
        <section class="form signup">
            <div class="headdiv headdiv-s">
                <h3>Sign Up</h3>
                <i class="fa-solid fa-car"></i>
            </div>
            <form method="POST">
                <div class="err-txt" hidden>This is an error message</div>
                <label>Personal details</label>
                <div class="name-details">
                        <div class="field input">
                        <input type="text" placeholder="Firstname" name="custFirstname" required>
                    </div>
                    <div class="field input">
                        <input type="text" placeholder="Lastname" name="custLastname" required>
                    </div>
                </div>
                    <div class="name-details">
                        <div class="field input">
                            <input type="Email" placeholder="Email Address" name="custEmail" required>
                        </div>
                        <div class="field input">
                            <input type="tel" placeholder="Phone Number" pattern="((^(\+)(\d){12}$)|(^\d{11}$))" name="custCnumber" required>
                        </div>
                    </div>
                    <label>Address</label>
                    <div class="field input">
                        <input type="text" placeholder="Baranggay, City, Province" name="custAddress" required>
                    </div>
                    <div class="field input">
                        <select name="vehicleType" id="" name="vehicleType" required>
                            <option disabled selected hidden>Choose Vehicle Type...</option>
                            <option value="Bicycle">Bicycle</option>
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="Car">Car</option>
                        </select>
                    </div>
                    <label>Account Information</label>
                    <div class="name-details">
                        <div class="field input">
                            <input type="text" placeholder="Username" name="Username" required>
                        </div>
                        <div class="field input">
                            <input type="Password" placeholder="Password" name="Password" required>
                        </div>
                    </div>
                    <div class="field input">
                        <input type="Password" placeholder="Confirm Password" name="custconfirmpassword" required>
                        <input type="hidden" name="role" value="vehicleOwner">
                    </div>
                    <!-- <div class="div field">
                        <label>Select Image</label>
                        <input type="file">
                    </div> -->
                    <div class="field button but">
                        <input type="submit" name="register" value="Create Account">
                    </div>
                    <input hidden type="text"  id="latitude" name="latitude" value="">
                    <input hidden type="text"  id="longitude" name="longitude" value="">
          
                    <div class="link">Do you have an account? <a href="../login.php">login</a></div>
            </form>
        </section>
    </div>
    </div>
    <script type="text/javascript">
var x = document.getElementById("latitude");
var y = document.getElementById("longitude");
function getLocation() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showPosition);
} else { 
x.value = "Geolocation is not supported by this browser.";
y.value = "Geolocation is not supported by this browser.";
}
}
function showPosition(position) {
  x.value = position.coords.latitude;
  y.value = position.coords.longitude;

}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>