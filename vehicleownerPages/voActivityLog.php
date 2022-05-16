<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
if(isset($_POST["confirm"])){
    $resID=intval($_POST['resID']);
     $sql1="UPDATE request set status='confirmed' WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
     $query=$dbh->prepare($sql1);
     $query->bindParam(':resID',$resID,PDO::PARAM_STR);
     $query->execute(); 
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
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

<body id="contbody" style="background-color: #f8f8f8">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section id="activityLog" class="container">
        <form action="" method="POST">
            <div class="row py-3 px-sm-0 px-md-3 justify-content-center pb-5">
                <div class="col-lg-8  py-4">
                    <?php
                        $sql="SELECT * from request WHERE custID = $custID1 and status = 'Accepted' || status = 'verify' order by resID DESC";
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        if($query->rowCount()>0){
                            foreach ($results as $result){
                                if($result-> status =="Accepted"){
                    ?>
                    <div class="card text-dark mb-2">
                        <div class="card-body">
                            <input type="text" hidden name="resID" value="<?php echo htmlentities($result->resID);?>">
                            <small class="card-text float-end pt-0" style="color: green;"><?php echo htmlentities($result->status);?></small>
                            <h6 class="card-title"><?php echo htmlentities($result->mechName);?></h6>
                            <small class="card-text t-6"><?php echo htmlentities($result->mechRepair);?></small>
                            <div class='alert alert-primary text-start py-0 pb-1 mb-0 fw-bold'>
                                <h6 class="pt-2"><small>Note:</small></h6>
                                <small class="card-text"><?php echo htmlentities($result->specMessage);?></small>
                            </div>
                            <a class="btn btn-primary rounded-pill py-0 mt-1 shadow border-0" href="./voMonitorMechService.php?regeditid=<?php echo htmlentities($result->resID);?>"><small>Monitor Service</small></a>
                        </div>
                    </div>
                    <?php } else if($result-> status =="verify"){?>
                        <div class="card text-dark mb-2">
                        <div class="card-body">
                            <input type="text" hidden name="resID" value="<?php echo htmlentities($result->resID);?>">
                            <small class="card-text float-end pt-0" style="color: green;"><?php echo htmlentities($result->status);?></small>
                            <h6 class="card-title"><?php echo htmlentities($result->mechName);?></h6>
                            <small class="card-text t-6"><?php echo htmlentities($result->mechRepair);?></small>
                            <div class='alert alert-primary text-start py-0 pb-1 mb-0 fw-bold'>
                                <h6 class="pt-2"><small>Note:</small></h6>
                                <small class="card-text"><?php echo htmlentities($result->specMessage);?></small>
                            </div>
                            <a class="btn btn-primary rounded-pill py-0 mt-1 shadow border-0" href="./voMonitorMechService.php?regeditid=<?php echo htmlentities($result->resID);?>"><small>Monitor Service</small></a>
                        </div>
                    </div>
                    
                   <?php }}} else { ?>
                   
                    <div class="emptyrequest mt-5 pt-5">
                        <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                        <h6>No available activities. . .</h6>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </section>

    <?php include('voBottom-nav.php');?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>function preventBack(){window.history.forward();}
        setTimeout("preventBack()",0);
        window.onunload = function(){ null };</script>
</body>

</html>