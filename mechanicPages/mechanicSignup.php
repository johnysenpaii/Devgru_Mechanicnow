<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(isset($_POST['register']) && isset($_FILES['mechValidID']))
{
    $img_name = $_FILES[ 'mechValidID']['name'];
    $img_size = $_FILES['mechValidID']['size'];
    $tmp_name = $_FILES['mechValidID']['tmp_name'];
    $error = $_FILES[ 'mechValidID']['error']; 


    if ($error === 0) {
        if ($img_size > 1000000) {
        $em = "Sorry, your file is too big!.";
        header ("Location: mechanicSignup.php?error=$em");
        }
        else{
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); 
            $img_ex_lc = strtolower($img_ex);
                    
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }else {
                $em = "You can't upload files of this type";
                header ("Location: mechanicSignup.php?error=$em");
            }
        }
    }else{
        $em = "unknown error occurred!";
        header ("Location: mechanicSignup.php?error=$em");
    }

    $mechFirstname=$_POST['mechFirstname'];
    $mechLastname=$_POST['mechLastname'];
    $mechAddress=$_POST['mechAddress'];
    $mechEmail=$_POST['mechEmail'];
    $mechCnumber=$_POST['mechCnumber'];
    // $Specialization=$_POST['Specialization'];
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $role=$_POST['role'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
   
      //check password
      if ($_POST['Password']!= $_POST['passwordcheck'])
      {
        echo "<script>alert('Oops! Password did not match! Please try again.')</script>";
        echo "<script type='text/javascript'>document.location='./mechanicSignup.php';</script>";
      }else{
        //hashed password
        $hashedPwd = password_hash($Password, PASSWORD_DEFAULT);
        //check email
        $sql = "SELECT * FROM mechanic WHERE mechEmail = ?";
        $query = $dbh->prepare($sql);
        $query->execute([$mechEmail]);
        $result = $query->rowCount();
        if($result > 0){
            //$error="<span class='text-danger'>Email hac already Exist!!</span>";
            echo "<script>alert('Oops! Email has already Exist!.')</script>";
            echo "<script type='text/javascript'>document.location='./mechanicSignup.php';</script>";
        }else{
            //check Username
            $sql2="SELECT * FROM mechanic WHERE Username = ?";
            $query = $dbh->prepare($sql2);
            $query->execute([$Username]);
            $result = $query->rowCount();
            if($result > 0){
                    // $error="<span class='text-danger'>Username has already Exist!!</span>";
                    echo "<script>alert('Oops! Username Already Exist!')</script>";
                    echo "<script type='text/javascript'>document.location='./mechanicSignup.php';</script>";
            }else{
                $sql="SELECT * FROM mechanic WHERE Username=:Username";
                $query=$dbh->prepare($sql);
                $query->bindParam(':Username',$Username,PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetch(PDO::FETCH_ASSOC);
                if($query->rowCount()>0)
                {
                echo "<script type='text/javascript'>document.location='../login.php';</script>";
                }else{
                                $sql="INSERT INTO mechanic(mechFirstname, mechLastname, mechAddress, mechEmail, mechCnumber, mechValidID, Username, Password, role,latitude,longitude)VALUES(:mechFirstname, :mechLastname, :mechAddress, :mechEmail, :mechCnumber, :mechValidID, :Username, :hashedPwd, :role, :latitude,:longitude )"; //specialization
                                $query=$dbh->prepare($sql);
                                $query->bindParam(':mechFirstname',$mechFirstname,PDO::PARAM_STR);
                                $query->bindParam(':mechLastname',$mechLastname,PDO::PARAM_STR);
                                $query->bindParam(':mechAddress',$mechAddress,PDO::PARAM_STR);
                                $query->bindParam(':mechEmail',$mechEmail,PDO::PARAM_STR);
                                $query->bindParam(':mechCnumber',$mechCnumber,PDO::PARAM_STR);
                                $query->bindParam(':mechValidID',$new_img_name,PDO::PARAM_STR);
                                $query->bindParam(':Username',$Username,PDO::PARAM_STR);
                                $query->bindParam(':hashedPwd',$hashedPwd,PDO::PARAM_STR);
                                $query->bindParam(':role',$role,PDO::PARAM_STR);
                                $query->bindParam(':latitude',$latitude,PDO::PARAM_STR);
                                $query->bindParam(':longitude',$longitude,PDO::PARAM_STR);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">_
    <title>Mechanic Now | Signup</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>

<body onload="getLocation()">
    <div class="btag">
        <div class="wrapper">
            <section class="form signup">
                <div class="headdiv headdiv-s">
                    <h3>Sign Up</h3>
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <form method="POST" action="./mechanicSignup.php" enctype="multipart/form-data">
                  
                    <div class="err-txt" hidden>This is an error message</div>
                    <label>Personal details</label>
                    <div class="name-details">
                        <div class="field input">
                            <input type="text" placeholder="Firstname" name="mechFirstname" required>
                        </div>
                        <div class="field input">
                            <input type="text" placeholder="Lastname" name="mechLastname" required>
                        </div>
                    </div>
                    <div class="name-details">
                        <div class="field input">
                            <input type="Email" placeholder="Email Address" name="mechEmail" required>
                        </div>
                        <div class="field input">
                            <input type="tel" placeholder="Phone Number" pattern="((^(\+)(\d){12}$)|(^\d{11}$))"
                                name="mechCnumber" required>
                        </div>
                    </div>
                    <label>Address</label>
                    <div class="field input">
                        <input type="text" placeholder="Baranggay, City, Province" name="mechAddress" required>
                    </div>
                    <div class="">
                        <label>Please attach Valid ID or Certificate</label>
                        <input class="form-control" name="mechValidID" type="file" id="formFileMultiple"
                            placeholder="Attach Valid ID" multiple required>
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
                        <input type="Password" placeholder="Confirm Password" name="passwordcheck" required>
                        <input type="hidden" name="role" value="mechanic">
                        <?php if (isset($_GET['error'])): ?>
                        <p><?php echo $_GET['error']; ?></p>
                        <?php endif ?>
                    </div>
                    <input hidden type="text" id="latitude" name="latitude" value="">
                    <input hidden type="text" id="longitude" name="longitude" value="">

                    <div class="field button">
                        <input type="submit" onclick="checkLocation()" name="register" value="Create Account">
                    </div>
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