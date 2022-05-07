<?php
session_start();
include('./config.php');
$error=" ";
if(isset($_POST['Login']))
{
    $regeditid = $_SESSION['mechID'];
    $regeditid1 = $_SESSION['custID'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $sql="UPDATE customer set latitude=:latitude,longitude=:longitude WHERE custID=:regeditid1"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql);
    $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
    $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
    $query->bindParam(':regeditid1',$regeditid1,PDO::PARAM_STR);
    $query->execute(); 
    $Username=$_POST['Username'];
    
    //$valid = password_verify($input, $Password); //1 or 0
    $sql1 = "SELECT * FROM customer WHERE Username=:Username AND role='vehicleOwner'";
    $query=$dbh->prepare($sql1);
    $query->bindParam(':Username',$Username,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount() == 1){
        $query->fetch(PDO::FETCH_ASSOC);
        $custID=$results['custID'];
        $latitude=$results['latitude'];
        $longitude=$results['longitude'];
        $custFirstname=$results['custFirstname'];
        $custLastname=$results['custLastname'];
        $custAddress=$results['custAddress'];
        $attemptedUsername=$results['Username'];
        $hashedPwd=$results['Password'];

        $Password=$_POST['Password'];
        if(password_verify($Password, $hashedPwd) == 1){
            session_regenerate_id();
            $_SESSION['custID']=$custID;
            $_SESSION['custFirstname']=$custFirstname;
            $_SESSION['custLastname']=$custLastname;
            $_SESSION['latitude']=$latitude;
            $_SESSION['longitude']=$longitude;
            $_SESSION['custAddress']=$custAddress;
            $_SESSION['Username']=$attemptedUsername;
            $_SESSION['Password']=$hashedPwd;
            echo "<script type='text/javascript'>document.location='./vehicleownerPages/voDashboard.php';</script>";
        }else{
            $error="<div class='alert alert-danger text-center fw-bold' role='alert'>Username and password mismatch!</div>";
        }
    }else{
        $regeditid = $_SESSION['mechID'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $sql="UPDATE mechanic set latitude=:latitude,longitude=:longitude,statActiveNotActive='Active' WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql);
        $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
        $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
        $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
        $query->execute(); 
        //echo '<script>alert("User not found!")</script>';
        $sql="SELECT * FROM mechanic WHERE Username=:Username AND role='MECHANIC'";
        $query1=$dbh->prepare($sql);
        $query1->bindParam(':Username',$Username,PDO::PARAM_STR);
        $query1->execute();
        $results1=$query1->fetch(PDO::FETCH_ASSOC);
        if($query1->rowCount() == 1){
            $query1->fetch(PDO::FETCH_ASSOC);
            $mechID=$results1['mechID'];
            $mechFirstname=$results1['mechFirstname'];
            $mechLastname=$results1['mechLastname'];
            $attemptedMUsername=$results1['Username'];
            $mechAddress=$results1['mechAddress'];
            $hashedPwdM=$results1['Password'];
            $latitude=$results1['latitude'];
            $longitude=$results1['longitude'];
            $status=$results1['status'];
            $statActiveNotActive=$results1['statActiveNotActive'];
            $Password1=$_POST['Password'];
            if(password_verify($Password1, $hashedPwdM) == 1){
                session_regenerate_id();
                $_SESSION['mechID']=$mechID;
                $_SESSION['latitude']=$latitude;
                $_SESSION['longitude']=$longitude;
                $_SESSION['mechFirstname']=$mechFirstname;
                $_SESSION['mechLastname']=$mechLastname;
                $_SESSION['mechAddress']=$mechAddress;
                $_SESSION['Username']=$attemptedMUsername;
                $_SESSION['Password']=$hashedPwdM;
                $_SESSION['status']=$status;
                $_SESSION['statActiveNotActive']=$statActiveNotActive;
                echo "<script type='text/javascript'>document.location='./mechanicPages/mechDashboard.php';</script>";
                header( "refresh:5;url=./mechanicPages/mechDashboard.php" );
            }else{
                $error="<div class='alert alert-danger text-center fw-bold' role='alert'>Username and password mismatch!</div>";
            }
        }else{
            //echo '<script>alert("User not found!")</script>';
            $Password=$_POST['Password'];
            $sql="SELECT * FROM admin WHERE Username=:Username AND Password=:Password AND role='admin'";
            $query=$dbh->prepare($sql);
            $query->bindParam(':Username',$Username,PDO::PARAM_STR);
            $query->bindParam(':Password',$Password,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetch(PDO::FETCH_ASSOC);
            if($query->rowCount()>0)
            {
            session_regenerate_id();
            $_SESSION['Username']=$results['Username'];
            $_SESSION['Password']=$results['Password'];
           echo "<script type='text/javascript'>alert('Welcome Admin!');</script>";
           echo "<script type='text/javascript'>document.location='./Admin/adminSide.php';</script>";
            }
            else{
               $error="<div class='alert alert-danger text-center fw-bold' role='alert'>User not found!</div>";
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Mechanic Now | Login</title>
    <link rel="shortcut icon" type="x-icon" href="img/mechanicnowlogo.svg">
</head>

<body onload="getLocation()">
    <div class="btag">
        <div class="wrapper">
            <section class="form signup">
                <div class="headdiv">
                    <h3>Login</h3>
                    <img src="img/navlogo.png" alt="">
                </div>
                <form method="POST">
                    <input  type="text" id="latitude" name="latitude" value="">
                    <input  type="text" id="longitude" name="longitude" value="">

                    <p>
                       <?php echo $error; ?>
                    </p>
                    <div class="err-txt" hidden>This is an error message</div>
                    <div class="field input">
                        <label>Username</label>
                        <input type="text" placeholder="Enter Username" name="Username">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="Password" placeholder="Enter Password" name="Password">
                    </div>
                    <div class="field button">
                        <input type="submit" name="Login" value="Login">

                    </div>
                    <div class="link">Doesn't have an account yet? <a href="#" data-bs-toggle="modal"
                            data-bs-target="#reg-modal">Signup</a></div>
                </form>
            </section>
            <!-- Vertically centered modal -->
            <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Choose Account type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 justify-content-around">
                                <a href="./vehicleownerPages/vehicleOwnerSignup.php" class="col-sm-5 text-center ms1">
                                    <i class="fa-solid fa-car"></i>
                                    <p>Vehicle Owner</p>
                                </a>
                                <a href="./mechanicPages/mechanicSignup.php" class="col-sm-5 text-center">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                    <p>Mechanic</p>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p>Do you have an account? <a href="login.php">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
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
    function preventBack(){window.history.forward();}
        setTimeout("preventBack()",0);
        window.onunload = function(){ null };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>