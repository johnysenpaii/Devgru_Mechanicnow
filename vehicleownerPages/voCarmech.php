<?php
session_start();
include('../config.php');
$custAddress1=$_SESSION['custAddress'];
$custID1=$_SESSION['custID'];

if(isset($_POST['send'])){  
    $host="localhost";
    $username="root"; 
    $word="";
    $db_name="mechanicnowdb"; 
    $tbl_name="request"; 
    $con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  
    $mechName=$_POST['mechName']; 
    $Specialization=$_POST['Specialization'];
    $mechAddress=$_POST['mechAddress'];
    $custAddress=$_POST['custAddress'];
    $specMessage=$_POST['specMessage'];
    $checkbox1=$_POST['mechRepair'];  
    $vOwnerName=$_POST['vOwnerName'];
    $service=$_POST['service'];
    $mechID=$_POST['mechID'];
    $chk=""; 
    $spec="";
    $mechN="";
    $vON="";
    $mID="";
    $Specl="";
    $mechAdd="";
    $custAdd="";
    $serv="";
    foreach($checkbox1 as $chk1){  
        $chk .= $chk1.", ";
    } 
    $spec .= $specMessage;  
    $mechN .= $mechName;
    $vON .= $vOwnerName;
    $mID .= $mechID;
    $Specl .= $Specialization;
    $mechAdd .= $mechAddress;
    $custAdd .= $custAddress;
    $serv .= $service;

    $in_ch=mysqli_query($con,"INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, serviceNeeded, mechID, custID, mechAddress, custAddress) values ('$mechN', '$vON' , '$spec', '$chk', '$Specl', '$serv', '$mID', '$custID1', '$mechAdd', '$custAdd')");  
    if($in_ch==1)  
    {  
        echo'<script>alert("Request Sent Successfully, Wait for Mechanic to Confirm!")</script>';  
        echo"<script>location.replace('voDashboard.php');</script>";  
    }  
    else  
    {  
        echo'<script>alert("Failed to Send Request")</script>';  
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
<body onload="getLocation();" id="contbody" style="background-color: #f8f8f8">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section id="mechContent" class="mech-content container-fluid">
        <div class="emptyrequest" hidden>
            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
            <h6>There is no mechanic nearby..</h6>
        </div>
        <div class="row py-3 px-sm-0 px-md-3 text-center table-responsive justify-content-center pb-5">
            <div class="col-lg-8 bg-white py-4 rounded-3 shadow-lg">
                <h4 class="text-dark pb-4">Available Car Mechanics</h4>
                <div class="row d-flex justify-content-end align-items-center px-sm-0 px-md-4">                   
                    <div class="col-9 col-md-6 searchlogo">
                        <input class="form-control rounded-pill" type="text" placeholder="Filter Search">
                    </div>
                    <div class="col-3 col-md-1 searchlogo justify-content-center align-items-center">
                        <i class="fa-solid fa-filter fa-2x" data-bs-toggle="modal" data-bs-target="#Filter-modal"></i>
                    </div>
                </div>
                <table class="table table-borderless table-curved pt-1 px-sm-0 px-md-4">
                    <thead>
                    </thead>
                    <tbody>
                        <?php
                     
                                $sql="SELECT * from mechanic WHERE mechAddress='$custAddress1' and Specialization='Car Mechanic'";
                               $query=$dbh->prepare($sql);
                               $query->execute();
                               $results=$query->fetchALL(PDO::FETCH_OBJ);
                               $cnt=1;       
                               if( $query->rowCount()>0){
                                   
                                foreach($results as $result){
                                    if($custAddress1==$custAddress1)
                                {
                                    ?>
                        <tr class="d-flex align-items-center justify-content-around mt-2">
                            <td class="col-sm-3 with-image"><img src="../img/vo.jpg" class="rounded-circle imagenajud float-end"></td>
                            <td><?php echo htmlentities($result->mechID);?></td>
                            <td><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></td>
                            <td><?php echo htmlentities($result->Specialization);?></td>
                            <td><button class="btn btn-warning px-3" data-bs-toggle="modal" href="voCarmech.php?regeditid=<?php  echo htmlentities($result->mechID);?>#detail-modal">Details</button></td>
                            
                        </tr>
                    </tbody>
                    <?php  } $cnt=$cnt+1;}}?>
                </table>
            </div>
        </div>
        <!-- Mechanic Info -->
        <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                <?php
                  $regeditid=intval($_GET['regeditid']);
                   // $regeditid=$_SESSION["mechID"];
                    $sql="SELECT * from mechanic WHERE mechID=:regeditid";
                    $query=$dbh->prepare($sql);
                    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);

                    if($query->rowCount()>0)
                    {
                    foreach ($results as $result) 
                    {
                ?>
                <div class="modal-body">
                    <div class="row line-segment seg">
                        <div class="col-sm-3 with-image"><img src="../img/avatar.jpg" class="rounded-circle imagenajud float-end" alt=""></div>
                        <div class="col-sm-9 d-flex align-items-center">
                            <div class="per-details">
                                <h4><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></h4>
                                <p hidden><i>No Ratings Yet</i></p>
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                                <p>Maribago, Lapu-Lapu, City</p>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-3">
                            <h6>Request Service: </h6>
                            <p>Emergency</p>
                        </div>
                        <div class="col-lg-3">
                            <h6>Vehicle Problem:</h6>
                            <p>Tire Repair, Engine Overheat</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Note:</h6>
                            <p>Putaena Tibay Bubu, Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, exercitationem.</p>
                        </div>
                    </div>
                </div>
                <?php }}?>
                <input type="text"  id="latitude" name="latitude" value=" ">
                <input type="text"  id="longitude"  name="longitude" value=" ">

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Accept</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4">Decline</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Filter Search -->
        <div class="modal fade" id="Filter-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Filter Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Apply Search</button>
                </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>