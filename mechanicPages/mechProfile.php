<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');

$regeditid=$_SESSION["mechID"];

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
      header ("Location: mechProfile.php?error=$em");
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
            $regeditid=$_SESSION["mechID"];

            $sql = "UPDATE mechanic set profile_url='$new_img_name' WHERE mechID=$regeditid";
            mysqli_query($conn, $sql);
            header ("Location: mechProfile.php?error=$em");
        }else {
            $em = "You can't upload files of this type";
            header ("Location: mechProfile.php?error=$em");
        }
     }
  }else {
      $em = "unknown error occurred!";
      header ("Location: mechProfile.php?error=$em");
  }

}

if(isset($_POST['edit']) && isset($_FILES['profile_url']))
{
    $id=$_POST['id'];
    $mechFirstname=$_POST['mechFirstname'];
    $mechLastname=$_POST['mechLastname'];
    $mechEmail=$_POST['mechEmail'];
    $mechCnumber=$_POST['mechCnumber'];
    $mechAddress=$_POST['mechAddress'];
    $Username=$_POST['Username'];
    // $Password=$_POST['Password'];

    if(isset($_POST["vehicleType"]) && isset($_POST["Specialization"])){
        $vehicleType_update=implode(",",$_POST["vehicleType"]);
        $Specializations=implode(",",$_POST["Specialization"]);
    }
    if(empty($vehicleType_update) && empty($Specializations)){
         echo "<script>alert('Please Select Vehicle Type')</script>";
    }else{
        try{
            if(!isset($errorMsg)){
                $sql="UPDATE mechanic set mechID=:id,mechFirstname=:mechFirstname,mechLastname=:mechLastname,mechEmail=:mechEmail,mechCnumber=:mechCnumber,mechAddress=:mechAddress,vehicleType=:vehicleType_update,Specialization=:Specializations,Username=:Username WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
                $query=$dbh->prepare($sql);
                $query->bindParam(':id',$id,PDO::PARAM_STR);
                $query->bindParam(':mechFirstname',$mechFirstname,PDO::PARAM_STR);
                $query->bindParam(':mechLastname',$mechLastname,PDO::PARAM_STR);
                $query->bindParam(':mechEmail',$mechEmail,PDO::PARAM_STR);
                $query->bindParam(':mechCnumber',$mechCnumber,PDO::PARAM_STR);
                $query->bindParam(':mechAddress',$mechAddress,PDO::PARAM_STR);
                $query->bindParam(':vehicleType_update',$vehicleType_update,PDO::PARAM_STR);
                $query->bindParam(':Specializations',$Specializations,PDO::PARAM_STR);
                $query->bindParam(':Username',$Username,PDO::PARAM_STR);
                $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                $query->execute(); 
                echo "<script type='text/javascript'>document.location='./mechProfile.php';</script>";
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
 
//   $sql="UPDATE mechanic set mechID=:id,mechFirstname=:mechFirstname,mechLastname=:mechLastname,mechEmail=:mechEmail,mechCnumber=:mechCnumber,mechAddress=:mechAddress,vehicleType=:vehicleType_update,Username=:Username WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
//   $query=$dbh->prepare($sql);
//   $query->bindParam(':id',$id,PDO::PARAM_STR);
//   $query->bindParam(':mechFirstname',$mechFirstname,PDO::PARAM_STR);
//   $query->bindParam(':mechLastname',$mechLastname,PDO::PARAM_STR);
//   $query->bindParam(':mechEmail',$mechEmail,PDO::PARAM_STR);
//   $query->bindParam(':mechCnumber',$mechCnumber,PDO::PARAM_STR);
//   $query->bindParam(':mechAddress',$mechAddress,PDO::PARAM_STR);
//   $query->bindParam(':vehicleType_update',$vehicleType_update,PDO::PARAM_STR);
//   $query->bindParam(':Username',$Username,PDO::PARAM_STR);
//   $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
//   $query->execute(); 

//   $checkbox1=$_POST["Specialization"];
//   $check = "";

//   foreach($checkbox1 as $partialcheck){
//       $check .=$partialcheck.", ";
//   }

//   $sql2="UPDATE mechanic set Specialization='$check' WHERE mechID=:regeditid";
//   $query1=$dbh->prepare($sql2);
//   $query1->execute(); 

//   echo "<script type='text/javascript'>document.location='./mechProfile.php';</script>";
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
    <?php include('mechHeader.php');?>
    <section id="Profilepage container-fluid"> 
              <?php //select transaction
              $regeditid=$_SESSION["mechID"];
              $sql="SELECT * from mechanic WHERE mechID=:regeditid";
              $query=$dbh->prepare($sql);
              $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0){
                foreach ($results as $result){
            ?>
        <div class="row text-dark pt-2 justify-content-evenly">
            <div class="row note justify-content-center">
                <div class="col-6 text-end pb-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="col-6 text-start">
                    <p>Please setup your account so that the vehicle owners can find you.</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5 with-image bg-white rounded-3 pb-2 p-3 mr-sm-0 mr-md-1 mb-5 mb-md-0 mb-lg-0 shadow-lg text-center">
                <div class="cont-image text-center">
                    <?php
                        $sql = "SELECT * FROM mechanic where mechID = $regeditid";
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows ($res) > 0) {
                        while ($images = mysqli_fetch_assoc ($res)){ 
                            if($regeditid == $regeditid ){
                    ?>
                    <img src="../uploads/<?=$images['profile_url']?>" onerror="this.src='../img/mech.jpg';" class="imagenajud pimage rounded-circle px-5" style="min-width: 20%; max-width: 250px;" alt="">
                    <?php }} }?>
                </div>
                <input type="hidden" name="id" value="<?php echo htmlentities($result->mechID);?>" required="required">
                <div class="row pt-4 text-center">
                    <div class="col-12"><h4><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></h4></div>
                    <div class="col-12">
                        <p hidden><i>No Ratings Yet</i></p>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                    </div>
                </div>
                <p class="pt-3" name="mechEmail"><?php echo htmlentities($result->mechEmail);?></p>
                <p name="mechCnumber"><?php echo htmlentities($result->mechCnumber);?></p>
                <p name="mechAddress"><?php echo htmlentities($result->mechAddress);?></p>
                <div class="d-grid p-3 pt-5">
                    <button class="btn btn-primary rounded-pill shadow" type="button" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#edit-modal">Edit Profile</button>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-6 bg-white p-4 ml-sm-0 ml-md-1 mt-sm-1 mt-md-0 shadow-lg rounded-3">
                <div class="row">
                    <p><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, laboriosam aperiam atque perferendis adipisci molestiae praesentium quo blanditiis ab voluptatem, sint rerum earum. Cumque, facere?"</i></p>
                </div>
                <div class="row pt-3">
                    <h5 class="pt-2">Specialization:</h5>
                    <!-- value="<?php echo htmlentities($result->Specialization);?>" -->
                    <p style="text-indent:5%;" name="Specialization">Lorem, ipsum, dolor.</p>
                    <div class="row pt-5">
                        <h6>Feedbacks:</h6>
                        <div class="col-12">
                            <p class="p-3 text-center" hidden>Theres no feedback yet.</p>
                        </div>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div> 
                    </div>
                </div>
            </div>
        </div>
        <?php }}?>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
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
                                        $sql = "SELECT * FROM mechanic where mechID = $regeditid";
                                        $res = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows ($res) > 0) {
                                        while ($images = mysqli_fetch_assoc ($res)){ 
                                            if($regeditid == $regeditid ){
                                    ?>
                                    <img src="../uploads/<?=$images['profile_url']?>" class="rounded-circle imagenajud float-end" alt="">
                                    <?php }} }?>
                                </div>                 
                                <div class="col-sm-12 d-flex align-items-center pt-3">
                                    <div class="row g-2">
                                        <div class="col-sm-12 col-md-6">
                                            <input type="file" name="profile_url" class="form-control">
                                        </div>
                                        <div class="field col-md-6">
                                            <input type="submit" name="submit" class="btn btn-primary rounded-pill shadow" value="Upload">
                                        </div>
                                         <input type="hidden" name="id" value="<?php echo htmlentities($result->mechID);?>" required="required">
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechFirstname" value="<?php echo htmlentities($result->mechFirstname);?>" placeholder="Firstname" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechLastname" value="<?php echo htmlentities($result->mechLastname);?>" placeholder="Lastname" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="Email" name="mechEmail" value="<?php echo htmlentities($result->mechEmail);?>" placeholder="Email" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechCnumber" value="<?php echo htmlentities($result->mechCnumber);?>" pattern="((^(\+)(\d){12}$)|(^\d{11}$))" placeholder="Contact Number" aria-label="default input example">
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="mechAddress" value="<?php echo htmlentities($result->mechAddress);?>" placeholder="Baranggay, City, Province" aria-label="default input example">
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="Username" value="<?php echo htmlentities($result->Username);?>" placeholder="Username" aria-label="default input example">
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="row pt-3">
                                        <div class="col-md-6">
                                            <h6 class="pb-2">Vehicle Type: </h6>
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
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Motorcycle" name="vehicleType[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Motorcycle
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Bicycle" name="vehicleType[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Bicycle
                                                </label>
                                            </div> -->
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="pb-2">Specialization: </h6>
                                            <div class="form-check">
                                                <?php
                                                $divide=explode(",",$result->Specialization);
                                                //var_dump($divide);
                                                $specialization1 = array("Diesel Mechanic","General Automotive Mechanic","Brake and Transmission Technician","Auto Body Mechanic","Service Technician","Auto Glass Mechanic","Heavy Equipment Mechanic","Small Engine Mechanic","Tire Mechanic");
                                                foreach($specialization1 as $result2){
                                                    if(strcmp($result2, $divide[0] ?? null) && strcmp($result2, $divide[1] ?? null) && strcmp($result2, $divide[2] ?? null) && strcmp($result2, $divide[3] ?? null) && strcmp($result2, $divide[4] ?? null) && strcmp($result2, $divide[5] ?? null) && strcmp($result2, $divide[6] ?? null) && strcmp($result2, $divide[7] ?? null) && strcmp($result2, $divide[8] ?? null) && strcmp($result2, $divide[9] ?? null)){
                                                    ?>
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>" name="Specialization[]" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault"><?php echo $result2;?></label>
                                                    <br>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>" name="Specialization[]" id="flexCheckDefault" checked>
                                                    <label class="form-check-label" for="flexCheckDefault"><?php echo $result2;?></label>
                                                    <br>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <!-- <input class="form-check-input" type="checkbox" value="Diesel Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Diesel Mechanic
                                                </label> -->
                                            </div>
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="General Automotive Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    General Automotive Mechanic
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Break and Transmission Technician" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Brake and Transmission Technician
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Auto Body Mechanic" name="Specialization[]"value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Auto Body Mechanic
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Service Technician" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Service Technician
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Auto Glass Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Auto Glass Mechanic
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Heavy Equipment Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Heavy Equipment Mechanic
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Small ENgine Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Small Engine Mechanic
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Tire Mechanic" name="Specialization[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tire Mechanic
                                                </label>
                                            </div> -->
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Say something about yourself" rows="3"></textarea>
                                        </div> -->
                            </div>
                        </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary rounded-pill px-4 shadow" name="edit">Save Changes</button> -->
                        <button class="btn btn-primary rounded-pill px-4 shadow" name="edit">Save Changes</button>
                    </div>
                            </form>
                </div>
            </div>
        </div>
    </section>
    <div class="row d-block d-lg-none"><?php include('mechBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>