<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];

   if(isset($_POST["readall"])){
    $resID=$_POST['resID'];
    $sql1245="UPDATE request set historyStatus='Read' WHERE custID=:custID1"; 
    $query1245=$dbh->prepare($sql1245);
    $query1245->bindParam(':custID1',$custID1,PDO::PARAM_STR);
    $query1245->execute();
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
    <style >
    .star .star-widget input {
        text-align: center;
        display: none;
    }

    .star-widget label {
        font-size: 20px;
        color: #444;
        padding: 10px;
        float: right;
        transition: all 0.2s ease;
    }

    input:not(:checked)~label:hover,
    input:not(:checked)~label:hover~label {
        color: #9132DA;
    }

    input:checked~label {
        color: #9132DA;
    }

    input#rate-5:checked~label {
        color: #9132DA;
        text-shadow: 0 0 20px #952;
    }

    #rate-1:checked~form header:before {
        content: "I just hate it ";
    }

    #rate-2:checked~form header:before {
        content: "I don't like it ";
    }

    #rate-3:checked~form header:before {
        content: "It is awesome ";
    }

    #rate-4:checked~form header:before {
        content: "I just like it ";
    }

    #rate-5:checked~form header:before {
        content: "I just love it ";
    }
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

<body id="contbody" style="background-color: #f8f8f8" onload="rating()">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section id="activityLog" class="container">
            <div class="scroll-area">
                <div class="row py-3 px-sm-0 px-md-3 justify-content-center pb-5">
                    <div class="col-lg-7  py-4  ">
                        <div class="selection-2">
                                <form method="GET">
                                    <!-- <input type="text" name="searchs"> -->
                                    <select class="selection" name="searchs">
                                        <option disabled selected>Filter by Services</option>
                                        <option value="Emergency">Emergency Services</option>
                                        <option value="Home">Home Services</option>
                                    </select>
                                    <button name="sea" type="submit">Filter</button><br>
                                </form>
                            <form action="" method="POST">
                            </div>
                            <button class="my-1 p-1 rounded btn fw-bold mb-1 text-info border-0" id="tago" type="submit" name="readall" style="font-size: 13px;"><i class="fa-solid fa-square-check"></i> Mark all as read</button><br><br>
                
                            <?php
                                $searchcont = $_GET['searchs'] ?? null;
                                $custID1=$_SESSION['custID'];
                                $sql3 ="SELECT *, DATE_FORMAT(Sdate, '%a %M-%d-%Y at %H:%i %p') as timess, DATE_FORMAT(Edate, '%a %M-%d-%Y at %H:%i %p') as Endtime from request where custID = $custID1 and status= 'Complete' and serviceNeeded like '%{$searchcont}%' order by resID DESC";
                                if(isset($_GET['sea'])){
                                    $query3 = $dbh -> prepare($sql3);
                                    $query3->execute();
                                    $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                    $transac=$query3->rowCount();
                                    if($transac == 0){
                                        echo "<script> document.getElementById('tago').style.display = 'none';</script>";
                                    }
                                    if($query3->rowCount()>0){
                                        foreach ($results3 as $result){
                                            if( $result->historyStatus== 'Unread' ){?>
                                    <div class="card text-dark mb-3 p-2" type="submit" name="hide">
                                        <div class="row g-1">
                                            <div class="col-md-2 bg-light border border-1 rounded text-center fw-bold py-4">
                                                <p style="font-size: 20px;"><?php echo number_format($result->ratePercentage,1);?></p>
                                                <p class="fw-bold disabled text-muted" style="font-size: 13px;">
                                                <span class="text-warning"><i class="fa-solid fa-star"></i></span> ratings</p>
                                            </div>
                                            <div class=" col-md-10 p-0 m-0">
                                                <div class="card-body py-0 text-center" onclick="hideone() ">
                                                    <input type="text" hidden name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                                                    <input type="hidden" name="resID" value="<?php echo htmlentities($result->resID);?>">
                                                    <p class="fw-bold text-end text-warning rounded" style="font-size: 12px;">  <i class="fa-solid fa-eye-slash"></i>
                                                    <?php echo htmlentities($result->historyStatus);?></p>
                                                    <h5 class="card-title fw-bold">Request: <?php echo htmlentities($result->serviceNeeded);?></h5>
                                                    <div class="row text-center details-p">
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-id-badge"></i> Transaction id: <?php echo htmlentities($result->resID);?> </p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> Start date: <?php echo htmlentities($result->timess);?></p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> End date: <?php echo htmlentities($result->Endtime);?></p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-toolbox"></i> Mechanic name: <?php echo htmlentities($result->mechName);?></p>
                                                    </div>
                                                    <p class="card-text fw-bold disabled text-muted" style="font-size: 12px;"><button type="submit" name="read" class="btn fw-bold mb-1" style="font-size: 13px;"><a href="mechViewDetails.php?regeditid=<?php echo htmlentities($result->resID);?>" class="text-info"><i class="fa-solid fa-eye"></i> view more</a></button></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{?>
                                        <div class="card text-dark mb-3 p-2" type="submit" name="hide">
                                        <div class="row g-1">
                                            <div class="col-md-2 bg-light border border-1 rounded text-center fw-bold py-4">
                                                <p style="font-size: 20px;"><?php echo number_format($result->ratePercentage,1);?></p>
                                                <p class="fw-bold disabled text-muted" style="font-size: 13px;">
                                                <span class="text-warning"><i class="fa-solid fa-star"></i></span> ratings</p>
                                            </div>
                                            <div class=" col-md-10 p-0 m-0">
                                                <div class="card-body py-0 text-center" onclick="hideone() ">
                                                    <input type="text" hidden name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                                                    <input type="hidden" name="resID" value="<?php echo htmlentities($result->resID);?>">
                                                    <p class="fw-bold text-end text-warning rounded" style="font-size: 12px;">  <i class="fa-solid fa-eye"></i>
                                                    <?php echo htmlentities($result->historyStatus);?></p>
                                                    <h5 class="card-title fw-bold">Request: <?php echo htmlentities($result->serviceNeeded);?></h5>
                                                    <div class="row text-center details-p">
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-id-badge"></i> Transaction id: <?php echo htmlentities($result->resID);?> </p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> Start date: <?php echo htmlentities($result->timess);?></p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> End date: <?php echo htmlentities($result->Endtime);?></p>
                                                        <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-toolbox"></i> Mechanic name: <?php echo htmlentities($result->mechName);?></p>
                                                    </div>
                                                    <p class="card-text fw-bold disabled text-muted" style="font-size: 12px;"><button type="submit" name="read" class="btn fw-bold mb-1" style="font-size: 13px;"><a href="voViewDetails.php?regeditid=<?php echo htmlentities($result->resID);?>" class="text-info"><i class="fa-solid fa-eye"></i> view more</a></button></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }}
                                } else{?>
                                        <div class="emptyrequest mt-5 pt-5" >
                                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                            <h6>No Transactions made yet. . .</h6>
                                        </div>
                                        <?php
                                        }
                                }else{
                                    $sql41 ="SELECT *, DATE_FORMAT(Sdate, '%a %M-%d-%Y at %H:%i %p') as timess, DATE_FORMAT(Edate, '%a %M-%d-%Y at %H:%i %p') as Endtime from request where custID = $custID1 and status= 'Complete' ";
                                    $query3 = $dbh -> prepare($sql41);
                                    $query3->execute();
                                    $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                    $transac=$query3->rowCount();
                                    if($transac == 0){
                                        echo "<script> document.getElementById('tago').style.display = 'none';</script>";
                                    }
                                    if($query3->rowCount()>0){
                                        foreach ($results3 as $result){
                                            // if( $result->historyStatus== 'Unread' && $result->serviceNeeded == $searchcont){?>
                                        <div class="card text-dark mb-3 p-2" type="submit" name="hide">
                                            <div class="row g-1">
                                                <div class="col-md-2 bg-light border border-1 rounded text-center fw-bold py-4">
                                                    <p style="font-size: 20px;"><?php echo number_format($result->ratePercentage,1);?></p>
                                                    <p class="fw-bold disabled text-muted" style="font-size: 13px;">
                                                    <span class="text-warning"><i class="fa-solid fa-star"></i></span> ratings</p>
                                                </div>
                                                <div class=" col-md-10 p-0 m-0">
                                                    <div class="card-body py-0 text-center" onclick="hideone() ">
                                                        <input type="text" hidden name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                                                        <input type="hidden" name="resID" value="<?php echo htmlentities($result->resID);?>">
                                                        <p class="fw-bold text-end text-warning rounded" style="font-size: 12px;">  <i class="fa-solid fa-eye"></i>
                                                        <?php echo htmlentities($result->historyStatus);?></p>
                                                        <h5 class="card-title fw-bold">Request: <?php echo htmlentities($result->serviceNeeded);?></h5>
                                                        <div class="row text-center details-p">
                                                            <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-id-badge"></i> Transaction id: <?php echo htmlentities($result->resID);?> </p>
                                                            <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> Start date: <?php echo htmlentities($result->timess);?></p>
                                                            <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-calendar-days"></i> End date: <?php echo htmlentities($result->Endtime);?></p>
                                                            <p class="card-text fw-bold disabled text-muted"><i class="fa-solid fa-toolbox"></i> Mechanic name: <?php echo htmlentities($result->mechName);?></p>
                                                        </div>
                                                        <p class="card-text fw-bold disabled text-muted" style="font-size: 12px;"><button type="submit" name="read" class="btn fw-bold mb-1" style="font-size: 13px;"><a href="voViewDetails.php?regeditid=<?php echo htmlentities($result->resID);?>" class="text-info"><i class="fa-solid fa-eye"></i> view more</a></button></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }} else{?>
                                            <div class="emptyrequest mt-5 pt-5" >
                                                <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                                <h6>No Transactions made yet. . .</h6>
                                            </div>
                                            <?php
                                            }
                                        }
                                        ?>
                    </div>
                </div>
            </div>

        </form>
    </section>
    <?php include('voBottom-nav.php');?>
    <script>
    let star = document.getElementsByName('rate');
    let showValue = document.getElementById('value');

    for (let i = 0; i < star.length; i++) {
        star[i].addEventListener('click', function() {
            i = this.value;

            showValue.value = i;
        });
    }

    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };

    function hideone() {
        document.getElementById("hide1").style.display = "none";
    }
    </script>

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
    <script src="js/addons/rating.js"></script>
</body>

</html>