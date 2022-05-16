<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');

$regeditid=$_SESSION["custID"];

 $sname = "localhost";
 $uname = "root";
 $password = "";
 $db_name = "mechanicnowdb";
 $conn = mysqli_connect($sname, $uname, $password, $db_name); 
 if (!$conn) {
     echo "Connection failed !";
    exit();
 }
 if(isset($_POST['submit']) && isset($_FILES['profile_url'])){

  $img_name = $_FILES['profile_url']['name'];
  $img_size = $_FILES['profile_url']['size'];
  $tmp_name = $_FILES['profile_url']['tmp_name'];
  $error = $_FILES[ 'profile_url']['error']; 
  
  if ($error === 0) {
    if ($img_size > 1000000) {
      $em = "Sorry, your file is too big!.";
      header ("Location: ovProfile.php?error=$em");
     }
     else{
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); 
        $img_ex_lc = strtolower($img_ex);
                
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = '../uploads/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
                    
            //insert database
            $regeditid=$_SESSION["custID"];

            $sql = "UPDATE customer set profile_url='$new_img_name' WHERE custID=$regeditid";
            mysqli_query($conn, $sql);
            header ("Location: voProfile.php?error=$em");
        }else {
            $em = "You can't upload files of this type";
            header ("Location: voProfile.php?error=$em");
        }
     }
  }else {
      $em = "unknown error occurred!";
      header ("Location: voProfile.php?error=$em");
  }

}

if(isset($_POST['edit']) && isset($_FILES['profile_url']))
{
    $id=$_POST['id'];
    $custFirstname=$_POST['custFirstname'];
    $custLastname=$_POST['custLastname'];
    $custAddress=$_POST['custAddress'];
    $custEmail=$_POST['custEmail'];
    $custCnumber=$_POST['custCnumber'];
    $Username=$_POST['Username'];
    // $Password=$_POST['Password'];

    if(isset($_POST["vehicleType"])){
        $vehicleType_update=implode(",",$_POST["vehicleType"]);
    }
    if(empty($vehicleType_update)){
         echo "<script>alert('Please Select Vehicle Type')</script>";
    }else{
        try{
            if(!isset($errorMsg)){
                $sql="UPDATE customer set custID=:id,custFirstname=:custFirstname,custLastname=:custLastname, custAddress=:custAddress, custEmail=:custEmail, custCnumber=:custCnumber, vehicleType=:vehicleType_update, Username=:Username WHERE custID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
                $query=$dbh->prepare($sql);
                $query->bindParam(':id',$id,PDO::PARAM_STR);
                $query->bindParam(':custFirstname',$custFirstname,PDO::PARAM_STR);
                $query->bindParam(':custLastname',$custLastname,PDO::PARAM_STR);
                $query->bindParam(':custAddress',$custAddress,PDO::PARAM_STR);
                $query->bindParam(':custEmail',$custEmail,PDO::PARAM_STR);
                $query->bindParam(':custCnumber',$custCnumber,PDO::PARAM_STR);
                $query->bindParam(':vehicleType_update',$vehicleType_update,PDO::PARAM_STR);
                $query->bindParam(':Username',$Username,PDO::PARAM_STR);
                $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                $query->execute(); 

                echo "<script type='text/javascript'>document.location='./voProfile.php';</script>";
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
if(isset($_POST['confirmPassword'])){
    $CPassword = $_POST['CPassword'];
    $NPassword = $_POST['NPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $hashedPassword = $_POST['hashedPassword'];
    //check if password inputed is matched with the password inside the database
    if(password_verify($CPassword, $hashedPassword) == 1){
        //check if new password and old password match
        if ( $NPassword != $confirmPassword){
            echo "<script>alert('Current Password is incorrect')</script>";
        }else{
            $hashedPwd = password_hash($NPassword, PASSWORD_DEFAULT);
            $sql="UPDATE customer set Password=:hashedPwd WHERE custID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
            $query=$dbh->prepare($sql);
            $query->bindParam(':hashedPwd',$hashedPwd,PDO::PARAM_STR);
            $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
            $query->execute(); 
            echo "<script>alert('Password changed successfully')</script>";
            echo "<script type='text/javascript'>document.location='./voProfile.php';</script>";
        }
    }else{
        echo "<script>alert('Current Password is incorrect')</script>";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body id="contbody" style="background-color: #f8f8f8">
    <?php include('voHeader.php');?>
    <section id="Profilepage container-fluid">
            <?php //select transaction
              $regeditid=$_SESSION["custID"];
              $sql="SELECT * from customer WHERE custID=:regeditid";
              $query=$dbh->prepare($sql);
              $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result) 
              {
            ?>
            <div class="row text-light m-0 user-infoPanel user-infoPanel-vo">
                <?php
                    $sql = "SELECT * FROM customer where custID = $regeditid";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows ($res) > 0) {
                    while ($images = mysqli_fetch_assoc ($res)){ 
                        if($regeditid == $regeditid ){
                    ?>
                    <div class="profimage profimage-vo" style="width: 200px; height: 200px; padding: 2em;">
                        <img src="../uploads/<?=$images['profile_url']?>" onerror="this.src='../img/mech.jpg';" class="mainimage pimage" style=" max-width: 100%; border-radius: 50%; object-fit: cover;" alt="">
                    </div>
                    <?php }} }?>
                    
            </div>
                    <div class="info-div row">
                        <div class="columns1 col-6">
                            <input type="hidden" name="id" value="<?php echo htmlentities($result->custID);?>" required="required">
                            <h5><?php echo htmlentities($result->custFirstname." ".$result->custLastname);?></h5>
                            <div class="col-12">
                                <p hidden><i>No Ratings Yet</i></p>
                                <p name="vehicleType"><?php echo htmlentities($result->vehicleType);?> Owner</p>
                                <!-- <i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-regular fa-star "></i> -->
                            </div>
                            
                        </div> 
                        <div class="columns2 col-6">
                            <div class="text-start">
                                <p name="custEmail"><?php echo htmlentities($result->custEmail);?></p>
                                <p name="custCnumber"><?php echo htmlentities($result->custCnumber);?></p>
                                <p name="custAddress"><?php echo htmlentities($result->custAddress);?></p>
                            </div>
                        </div>
                    </div>
                    <div class=" p-2 mx-5 text-center py-3 pt-4">
                        <button class="btn btn-primary rounded-pill shadow px-5" type="button" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#exampleModalTogglel">Edit Profile</button>
                    </div>
        <div class="modal fade" id="exampleModalTogglel" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body form">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row line-segment seg">
                            <div class="col-sm-3 with-image">
                                    <?php
                                        $sql = "SELECT * FROM customer where custID = $regeditid";
                                        $res = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows ($res) > 0) {
                                        while ($images = mysqli_fetch_assoc ($res)){ 
                                            if($regeditid == $regeditid ){
                                    ?>
                                    <img src="../uploads/<?=$images['profile_url']?>" onerror="this.src='../img/mech.jpg';" class="imagenajud pimage rounded-circle px-5" style="min-width: 20%; max-width: 250px;" alt="">
                                    <?php }} }?>
                                </div>                        
                            <div class="col-12 d-flex align-items-center pt-3">
                                <div class="row g-2">
                                    <div class="col-sm-12 col-md-6">
                                    <input type="file" name="profile_url" class="form-control">
                                    </div>
                                    <div class="field col-md-6">
                                        <input type="submit" name="submit" class="btn btn-primary rounded-pill shadow" value="Upload">
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo htmlentities($result->custID);?>" required="required">
                                    <label>Personal Details</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="custFirstname" value="<?php echo htmlentities($result->custFirstname);?>"  placeholder="Firstname" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="custLastname" value="<?php echo htmlentities($result->custLastname);?>" placeholder="Lastname" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="custEmail" value="<?php echo htmlentities($result->custEmail);?>" placeholder="Email" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="custCnumber" value="<?php echo htmlentities($result->custCnumber);?>" placeholder="Contact Number" aria-label="default input example">
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" name="custAddress" value="<?php echo htmlentities($result->custAddress);?>" placeholder="Baranggay, City, Province" aria-label="default input example">
                                    </div>
                                    <label>Account Information</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" name="Username" value="<?php echo htmlentities($result->Username);?>" placeholder="Username" aria-label="default input example">
                                    </div>
                                    <div class="my-2">
                                        <button class="btn btn-primary rounded-pill shadow" type="button" class="btn btn-warning px-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close">Edit Password</button>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-12 d-flex align-items-center pt-3">
                                <div class="row g-2">
                                    <h6 class="pb-2">Vehicle Type :</h6>
                                    <div class="col-md-6">
                                       <div class="form-check">
                                                <?php
                                                $divide = explode(",",$result->vehicleType); //return Bicycle
                                                // var_dump($divide);
                                                $specialization1 = array("Car","Motorcycle","Bicycle"); //have 3 values 
                                                // var_dump($specialization1);
                                                foreach($specialization1 as $result2){ //travel each index in an array
                                                            //car       bicycle = false
                                                    if(strcmp($result2, $divide[0] ?? null) && strcmp($result2, $divide[1] ?? null) && strcmp($result2, $divide[2] ?? null)){ //compare bicycle to car motorcycle and bicycle
                                                    //first it compares bicycle to car, then fail so go to else
                                                    ?> 
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>" name="vehicleType[]" id="flexCheckDefault" >
                                                    <label class="form-check-label" for="flexCheckDefault"><?php echo $result2;?></label>
                                                    <br>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>" name="vehicleType[]" id="flexCheckDefault" checked="checked">
                                                    <label class="form-check-label" for="flexCheckDefault"><?php echo $result2;?></label>
                                                    <br>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Say something about yourself" rows="3"></textarea>
                                    </div> -->
                                </div>    
                            </div>
                        </div>        
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary rounded-pill px-4 shadow" data-bs-dismiss="modal" name="edit">Save Changes</button>-->
                    <button class="btn btn-primary rounded-pill px-4 shadow" name="edit">Save Changes</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }}?>
        <!-- </div> -->
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">
                    <form method="POST">
                    <?php //select transaction
                        $regeditid=$_SESSION["mechID"];
                        $sql="SELECT * from customer WHERE custID=:regeditid";
                        $query=$dbh->prepare($sql);
                        $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);

                        if($query->rowCount()>0){
                            foreach ($results as $result){
                    ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Change Password</h5>
                        <button type="button" class="btn-close shadow-none border-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <input class="form-control shadow-none my-2" type="Password" name="CPassword" placeholder="Enter Current Password" aria-label="default input example">
                        </div>
                        <input class="form-control" type="text" name="hashedPassword" value="<?php echo htmlentities($result->Password);?>" placeholder="Username" aria-label="default input example" hidden>
                        <div class="col-md-12">
                            <input class="form-control shadow-none my-2" type="Password" name="NPassword" placeholder="Enter New Password" aria-label="default input example">
                        </div>
                        <div class="col-md-12">
                            <input class="form-control shadow-none my-2" type="Password" name="confirmPassword" placeholder="Confirm Password" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary shadow" name="changePassword">Save Changes</button>
                    </div>
                    <?php }}?>
                    </form>
                </div>
            </div>
        </form>
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>function preventBack(){window.history.forward();}
        setTimeout("preventBack()",0);
        window.onunload = function(){ null };</script>
</body>
</html>