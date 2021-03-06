<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$regeditid=$_SESSION["mechID"];
if(isset($_POST['total1'])){
    $total1=floatval($_POST['total1']);
    $id1=intval($_SESSION['mechID']);
    if($id1 != ''){
    $sql="UPDATE mechanic set average=:total1 where mechID=:id1";
    $query=$dbh->prepare($sql);
    $query->bindParam(':total1',$total1,PDO::PARAM_STR);
    $query->bindParam(':id1',$id1,PDO::PARAM_STR);
    $query->execute(); 
    }  
}
 $sname = "localhost";
 $uname = "root";
 $password = "";
 $db_name = "mechanicnowdb";
 $conn = mysqli_connect($sname, $uname, $password, $db_name); 
 if (!$conn) {
     echo "Connection failed !";
    exit();
 }
 if(isset($_POST['submit'])){

  $img_name = $_FILES['profile_url']['name'];
  $img_size = $_FILES['profile_url']['size'];
  $tmp_name = $_FILES['profile_url']['tmp_name'];
  $error = $_FILES[ 'profile_url']['error']; 
  
  if ($error === 0) {
    if ($img_size > 10000000) {
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
            $sql="UPDATE mechanic set Password=:hashedPwd WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
            $query=$dbh->prepare($sql);
            $query->bindParam(':hashedPwd',$hashedPwd,PDO::PARAM_STR);
            $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
            $query->execute(); 
            echo "<script>alert('Password changed successfully')</script>";
            echo "<script type='text/javascript'>document.location='./mechProfile.php';</script>";
        }
    }else{
        echo "<script>alert('Current Password is incorrect')</script>";
    }
    
}
if(isset($_POST['total1'])){
    $total1=floatval($_POST['total1']);
    $id1=intval($_POST['id1']);
    if($id1 != ''){
    $sql="UPDATE mechanic set average=:total1 where mechID=:id1";
    $query=$dbh->prepare($sql);
    $query->bindParam(':total1',$total1,PDO::PARAM_STR);
    $query->bindParam(':id1',$id1,PDO::PARAM_STR);
    $query->execute(); 
    }  
}
if(empty($_SESSION['mechID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['mechID']);
      }
      if(isset($_POST["logout"])) {
        $mechID=$_SESSION['mechID'];
        $sql12344="UPDATE mechanic set stats='Not active' WHERE mechID=:mechID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query12344=$dbh->prepare($sql12344);
        $query12344->bindParam(':mechID', $mechID, PDO::PARAM_STR);
        $query12344->execute();
        session_destroy(); 
        unset($_SESSION['mechID']);
        header("Location:http://localhost/Devgru_Mechanicnow/login.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>

<body id="contbody" style="background-color: #f8f8f8" onload="getStars();">
    <?php include('mechHeader.php');?>
    <section id="Profilepage container-fluid">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php //select transaction
              $regeditid=$_SESSION["mechID"];
              $sql="SELECT * from mechanic WHERE mechID=:regeditid";
              $query=$dbh->prepare($sql);
              $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0){
                foreach ($results as $result){ ?>
            <div class="row text-light m-0 user-infoPanel">
                <?php
                    $sql = "SELECT * FROM mechanic where mechID = $regeditid";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows ($res) > 0) {
                    while ($images = mysqli_fetch_assoc ($res)){ 
                        if($regeditid == $regeditid ){
                    ?>
                    <div class="profimage" style="width: 200px; height: 200px; padding: 2em;">
                        <img src="../uploads/<?=$images['profile_url']?>" onerror="this.src='../img/mech.jpg';" class="mainimage pimage" style=" max-width: 100%; border-radius: 50%; object-fit: cover;" alt="">
                    </div>
                    <?php }} }?>
                    <div class="user-info-info column">
                        <input type="hidden" name="id" value="<?php echo htmlentities($result->mechID);?>" required="required">
                        <h4><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></h4>
                        <div class="col-12">
                            <p hidden><i>No Ratings Yet</i></p>
                            <p name="vehicleType"><?php echo htmlentities($result->vehicleType);?></p>
                             <?php
                                $mechID=$_SESSION['mechID'];
                                $sql="SELECT mechID,AVG(ratePercentage) as total from ratingandfeedback where mechID = $mechID";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;       
                                if( $query->rowCount()>0){   
                                    foreach($results as $result1){
                            ?>
                            <input type="hidden" id="starss" name="total1" value="<?php echo number_format($result1->total,1);?>">
                                
                            <span type="text" id="stars"
                                name="total"><?php echo number_format($result1->total,1);?></span>
                            <?php $cnt=$cnt+1;}}?>
                            <!-- <i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-solid fa-star "></i><i class="fa-regular fa-star "></i> -->
                        </div>
                        <div class="d-grid p-2 mx-5">
                            <button class="btn btn-light rounded-pill shadow" type="button" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#exampleModalTogglel">Edit Profile</button>
                        </div>
                    </div>
                    <div class="column">
                        <div class="text-start">
                            <p class="pt-3" name="custEmail"><?php echo htmlentities($result->mechEmail);?></p>
                            <p name="custCnumber"><?php echo htmlentities($result->mechCnumber);?></p>
                            <p name="custAddress"><?php echo htmlentities($result->mechAddress);?></p>
                        </div>    
                    </div>
            </div>
            <h5 class="text-center text-dark py-4">FEEDBACKS</h5>
            <div class="row text-dark feedback-container text-center m-0">
                <?php
                    $sql004 = "SELECT * from ratingandfeedback where mechID = :regeditid order by ratingID DESC limit 0,3 ";
                    $query5 = $dbh->prepare($sql004);
                    $query5->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                    $query5->execute();
                    $results=$query5->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                        if($query5->rowCount()>0){
                            foreach($results as $res){
                ?>
                <div class="col-sm-12 col-md-4 col-lg-4 pt-3"><i>"<?php echo htmlentities($res->feedback); ?>"</i></div>
                    <?php }
                }else{
                    ?>
                    <div class="emptyrequest mt-5 pt-5" >
                                        <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                        <h6>No Feedbacks made yet. . .</h6>
                                    </div>
                <?php
                }
                ?>
            </div>
            
            <?php }}?>
           
            <!-- Vertically centered modal -->
            <div class="modal fade" id="exampleModalTogglel" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body form">
                            <div class="row line-segment seg">
                                <div class="col-sm-3 with-image">
                                    <?php
                                        $sql = "SELECT * FROM mechanic where mechID = $regeditid";
                                        $res = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows ($res) > 0) {
                                        while ($images = mysqli_fetch_assoc ($res)){ 
                                            if($regeditid == $regeditid ){
                                    ?>
                                    <img src="../uploads/<?=$images['profile_url']?>"
                                        class="rounded-circle imagenajud float-end" alt="">
                                    <?php }} }?>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center pt-3">
                                    <div class="row g-2">
                                        <div class="col-sm-12 col-md-6">
                                            <input type="file" name="profile_url" class="form-control">
                                        </div>
                                        <div class="field col-md-6">
                                            <input type="submit" name="submit"
                                                class="btn btn-primary rounded-pill shadow" value="Upload">
                                        </div>
                                        <input type="hidden" name="id"
                                            value="<?php echo htmlentities($result->mechID);?>" required="required">
                                        <label>Personal Details</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechFirstname"
                                                value="<?php echo htmlentities($result->mechFirstname);?>"
                                                placeholder="Firstname" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechLastname"
                                                value="<?php echo htmlentities($result->mechLastname);?>"
                                                placeholder="Lastname" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="Email" name="mechEmail"
                                                value="<?php echo htmlentities($result->mechEmail);?>"
                                                placeholder="Email" aria-label="default input example">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="mechCnumber"
                                                value="<?php echo htmlentities($result->mechCnumber);?>"
                                                pattern="((^(\+)(\d){12}$)|(^\d{11}$))" placeholder="Contact Number"
                                                aria-label="default input example">
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="mechAddress"
                                                value="<?php echo htmlentities($result->mechAddress);?>"
                                                placeholder="Baranggay, City, Province"
                                                aria-label="default input example">
                                        </div>
                                        <label>Account Information</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="Username"
                                                value="<?php echo htmlentities($result->Username);?>"
                                                placeholder="Username" aria-label="default input example">
                                        </div>
                                        <div class="my-2">
                                            <button class="btn btn-primary rounded-pill shadow" type="button" class="btn btn-warning px-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close">Edit Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <h6 class="pb-2">Mechanic Type :</h6>
                                    <div class="form-check">
                                        <?php
                                                $divide = explode(",",$result->vehicleType); //return Bicycle
                                                // var_dump($divide);
                                                $specialization1 = array("Car Mechanic","Motorcycle Mechanic","Bicycle Mechanic"); //have 3 values 
                                                // var_dump($specialization1);
                                                foreach($specialization1 as $result2){ //travel each index in an array
                                                    if(strcmp($result2, $divide[0] ?? null) && strcmp($result2, $divide[1] ?? null) && strcmp($result2, $divide[2] ?? null)){ //compare bicycle to car motorcycle and bicycle
                                                    //first it compares bicycle to car, then fail so go to else
                                                    ?>
                                        <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>"
                                            name="vehicleType[]" id="flexCheckDefault">
                                        <label class="form-check-label"
                                            for="flexCheckDefault"><?php echo $result2;?></label>
                                        <br>
                                        <?php
                                                    }else{
                                                    ?>
                                        <input class="form-check-input" type="checkbox" value="<?php echo $result2;?>"
                                            name="vehicleType[]" id="flexCheckDefault" checked="checked">
                                        <label class="form-check-label"
                                            for="flexCheckDefault"><?php echo $result2;?></label>
                                        <br>
                                        <?php
                                                    }
                                                }
                                                ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="pb-2">Specialization: </h6>
                                    <div class="form-check">
                                        <?php
                                            //selected repairs
                                            $divide=explode(",",$result->Specialization);
                                            //var_dump($divide);
                                            //overall repairs
                                            $specialization1 = array("Tire Repair","Break Repair" ,"Chain Loosening Repair","Engine Overheat Repair" ,"Dead Battery Repair","Dead Light Repair");
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary rounded-pill px-4 shadow" name="edit">Save Changes</button> -->
                            <button class="btn btn-primary rounded-pill px-4 shadow" type="submit" name="edit">Save
                                Changes</button>
                        </div>

                    </div>
                            </form>                                                    
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                <form method="POST">
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

    <script>
    var starss = document.getElementById("starss").value;
    document.getElementById("stars").innerHTML = getStars(starss);

    function getStars(rating) {

        // Round to nearest half
        rating = Math.round(rating * 2) / 2;
        let output = [];

        // Append all the filled whole stars
        for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: #302d32;"></i>&nbsp;');

        // If there is a half a star, append it
        if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: #302d32;"></i>&nbsp;');

        // Fill the empty stars
        for (let i = (5 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: #302d32;"></i>&nbsp;');

        return output.join('');
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>