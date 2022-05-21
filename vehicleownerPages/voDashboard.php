<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];

if(isset($_POST['car'])){
        $l1=$_SESSION["latitude"];
        $l2=$_SESSION["longitude"];
        header("Location:voCarmech.php?/lat=$l1&long=$l2"); 
}
elseif(isset($_POST['motorcycle'])){
    $l1=$_SESSION["latitude"];
    $l2=$_SESSION["longitude"];
    header("Location:voMotorcyclemech.php?/lat=$l1&long=$l2"); 
}
elseif(isset($_POST['bicycle'])){
    $l1=$_SESSION["latitude"];
    $l2=$_SESSION["longitude"];
    header("Location:voBikemech.php?/lat=$l1&long=$l2"); 
}
if(isset($_POST['update'])){
    $resID = $_POST['resID'];
    $mechID=$_POST['mechID'];  
    $sql = "UPDATE request set status='cancelled' WHERE resID=:resID";
    $query=$dbh->prepare($sql);
    $query->bindParam(':resID',$resID,PDO::PARAM_STR);
    $query->execute();
 
    $sql7 = "INSERT INTO notification(custID, mechID , status) VALUES(:custID1, :mechID,'cancelled')";
    $query7 = $dbh->prepare($sql7);
    $query7->bindParam(':custID1',$custID1,PDO::PARAM_STR);
    $query7->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query7->execute();
}
if(empty($_SESSION['custID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['custID']);
      }
      if(isset($_POST["logout"])) { 
        unset($_SESSION['custID']);
        session_destroy();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
    <style>
        section .bot-nav{
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 55px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            background-color: #fff;
            display: flex;
            overflow-x: auto;
        }
        .bot-nav .nav-links{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            min-width: 50px;
            overflow: hidden;
            white-space: nowrap;
            color: #302D32;
            font-size: 6px;
            color: var(--clr-primary-800);
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
            transition: background-color 0.1s ease-in-out;
        }
        .nav-links i{
            padding-bottom: 5px;
            font-size: 16px;
        }
        .nav-links:hover{
            color: #9132DA;
        }
        @media only screen and (min-width: 764px) {
            .botsec{
                display: none;
            }
        }
    </style>
</head>

<body id="contbody" style="background-color: #f8f8f8" onload="calcCrow()">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>
    <section id="serviceOptions" class="container-fluid container-md py-3 pb-5 mb-5">
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <form method="POST">
                        <div class="col-sm-8 col-md-12 col-lg-10 bg-white text-dark p-3 rounded-3 offset-sm-4 offset-md-0 offset-lg-2" >
                            <h4 class="line-segment">Choose Mechanic Service Category</h4>
                            <div class="row row-cols-1 row-cols-md-3 g-4 py-3" >
                                <div class="col">
                                    <div class="card h-100" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                                        <img src="../img/car.svg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title">Car</h5>
                                            </center>
                                            <center>
                                                <p class="card-text">Car Repair and Services.</p>
                                            </center>
                                            <div class="text-center"><button class="btn btn-primary px-5 rounded-pill my-2"
                                                    name="car" type="submit" >Find</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                                        <img src="../img/moto.svg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title">Motorcycle</h5>
                                            </center>
                                            <center>
                                                <p class="card-text">Motorcycle Repair and Services.</p>
                                            </center>
                                            <div class="text-center"><button class="btn btn-primary px-5 rounded-pill my-2"
                                            name="motorcycle" type="submit" >Find</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                                        <img src="../img/bicycle.svg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title">Bicycle</h5>
                                            </center>
                                            <center>
                                                <p class="card-text">Bicycle Repair and Services.</p>
                                            </center>
                                            <div class="text-center"><button class="btn btn-primary px-5 rounded-pill my-2"
                                            name="bicycle" type="submit">Find</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-3 bg-white text-dark rounded-3 cont-act">
                    <div class="act-content">
                        <h5 class="py-4 pb-2 text-center line-segment">Recent Activities</h5>
                        <?php
                            $sql="SELECT *, DATE_FORMAT(Sdate, '%d-%m-%Y %H:%i:%s %p') as timedate from request WHERE custID=$custID1 and status='Unaccepted' order by resID DESC";
                            $query=$dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchALL(PDO::FETCH_OBJ);

                            if($query->rowCount()>0)
                            {
                            foreach ($results as $result)
                            {
                                if($custID1==$custID1)
                                {
                        ?>
                        <div class="col py-2 hovers rounded-3">
                            <p class="fs-6 pb-2 pt-2"><?php echo htmlentities($result->serviceNeeded);?> Request</p>
                            <div class="d-grid">
                                <button class="btn btn-primary shadow" type="button" data-bs-toggle="modal" data-bs-target="#detailsmodal">Details</button>
                            </div>
                            <hr/>
                        </div>
                        <!-- modal -->
                        <div class="modal fade" id="detailsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form method="POST">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Activity Details</h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="resID" value="<?php echo htmlentities($result->resID);?>" >
                                        <input type="hidden" name="mechID" value="<?php echo htmlentities($result->mechID);?>" >
                                        <h6><?php echo htmlentities($result->serviceNeeded);?> Request</h6>
                                        <div class="p-2">
                                            <p class="pt-3 pb-1"><?php echo htmlentities($result->mechName);?></p>
                                            <?php
                                                $spec = explode(",", $result->mechRepair);
                                                foreach($spec as $specialize){
                                                    ?>
                                                        <span class="badge badge-design row m-0 px-0">
                                                            <p class="px-1 text-align-center"><?php echo $specialize; ?></p>
                                                        </span>
                                                    <?php
                                                }
                                            ?>
                                            <p class="pt-2"><?php echo htmlentities($result->timedate);?></p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update" class="btn btn-primary rounded-pill shadow-none">Cancel Request</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php }}}
                        else { 
                        ?> 
                            <div class="emptyrequest mt-5 pt-4" >
                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                            <center><h6>No Activity. . .</h6></center>
                            </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>

            </div>
            
    <!-- <div class="row d-block d-lg-none"></div> -->
    </section>
    <?php include('voBottom-nav.php');?>
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
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script> 
    AOS.init({
        duration: 3000,
        once: true,
    });  
    function preventBack(){window.history.forward();}
            setTimeout("preventBack()",0);
            window.onunload = function(){ null };
    </script>
    
</body>

</html>