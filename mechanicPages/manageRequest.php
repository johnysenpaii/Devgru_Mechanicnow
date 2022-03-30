<?php
session_start();
include('../config.php');
$mechID1=$_SESSION['mechID']; 

// if(isset($_POST["verify"])){
//  $resID=intval($_POST['resID']);
//   $sql1="UPDATE request set status='verify' WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
//   $query=$dbh->prepare($sql1);
//   $query->bindParam(':resID',$resID,PDO::PARAM_STR);
//   $query->execute(); 
//   echo '<script>alert("please wait vehicle onwer to approve")</script>';


// }



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>

<body id="contbody" style="background-color: #f8f8f8">
    <?php include('mechHeader.php');?>
    <!-- <?php include('mechTopnav.php');?> -->

    <section id="manageRequest">
        <div class="row container-fluid py-3 text-dark">
            <div class="col-sm-12 col-md-6">
                 <div id="google-maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d125600.64171524956!2d123.91604364000311!3d10.340280042809674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1smechanic%20shops%20near%20Cebu%20City%2C%20Cebu!5e0!3m2!1sen!2sph!4v1648229944458!5m2!1sen!2sph" frameborder="0" width="100%" height="540" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 bg-white p-3 rounded-3 shadow">
                <p class="pb-5">Please Update the progress bar so that your client know the status of his/her request.</p>
                <div class="progress rounded-pill">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
                <div class="row p-2 d-flex align-self-end justify-content-end">
                    <p class="pt-3 pb-1">Make sure to complete the request before clicking the button.</p>
                    <button class="btn btn-primary col-md-4 rounded-pill">Request Complete</button>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>