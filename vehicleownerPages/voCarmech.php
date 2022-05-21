<?php
session_start();
include('../config.php');
    $custAddress1=$_SESSION['custAddress'];
    $v1 = doubleval($_SESSION["latitude"]);
    $v2 = doubleval($_SESSION["longitude"]);
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
<body id="contbody" style="background-color: #f8f8f8">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section id="mechContent" class="mech-content container-fluid">
         
        <div class="row py-3 px-sm-0 px-md-3 text-center justify-content-center pb-5"> 
            <div class="col-lg-8 py-4 rounded-3">
                <h4 class="text-dark text-start pb-4">Available Car Mechanics</h4>
                    <form method="GET">
                        <div class="row m-0 m-md-3 col-12 searchlogo align-items-center">
                            <div class="input-group-sm col-10">
                                <input class="form-control rounded-pill shadow-none" autocomplete="off" name="searchs" type="text" placeholder="  Filter Search">
                            </div>
                            <button class="fa-solid fa-magnifying-glass s-button col-1 px-0" name="sea" type="submit"></button>
                            <!-- <i class="fa-solid fa-filter fa-2x filter col-1" data-bs-toggle="modal" data-bs-target="#Filter-modal"></i> -->
                        </div>
                    </form>
                <div class="countRecords">
                    <?php
                    
                    ?>
                    Requests 
                    <?php {}?>
                </div>
                <div class="overflow-auto">
                <table class="table table-borderless table-curved table-responsive pt-1 px-sm-0 px-md-0">
                    <thead>
                    </thead>
                    <tbody>
                        <?php
                        $searchcont = $_GET['searchs'] ?? null;
                    $sql="SELECT mechID,mechFirstname,mechLastname,Specialization,average,
                    (3959 * acos(cos(radians($v1)) *cos(radians(latitude))* cos(radians(longitude)-radians($v2))+sin(radians($v1))
                    *sin(radians(latitude)))) as distance  from  mechanic WHERE 
                    vehicleType like '%Car Mechanic%' and status='approve' having distance < 3 order by distance limit 0, 20 ";
                    $sqlsearch="SELECT mechID, mechFirstname, mechLastname, Specialization, average, (3959 * acos(cos(radians($v1)) *cos(radians(latitude))* cos(radians(longitude)-radians($v2))+sin(radians($v1))
                    *sin(radians(latitude)))) as distance  from  mechanic WHERE 
                    vehicleType like '%Car Mechanic%' and status='approve' and stats='Active' and Specialization like '%{$searchcont}%' having distance < 3 order by distance limit 0, 20 ";
                    if(isset($_GET['sea'])){
                        $query=$dbh->prepare($sqlsearch);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        $cnt=1;       
                        if( $query->rowCount()>0){   
                            foreach($results as $result){?> 
                            <tr class="mt-2 ">
                                <td class="t-content"><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></td>
                                <td class="t-content"><?php echo htmlentities($result->Specialization);?></td>
                                <td class="t-content">k.m <?php echo number_format($result->distance,1);?> </td>
                                <td class="t-content"><a class="btn btn-warning px-3 shadow-none" href="voCarmechRequest.php?regeditid=<?php echo htmlentities($result->mechID)?>">Details</a></td>
                            </tr>
                            <?php $cnt=$cnt+1;}}     
                                else{?>    
                                <div class="emptyrequest mt-1 pt-4" >
                                <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                <h6 class="t-content">"<?php echo $searchcont ?>" Search not found. . .</h6>
                                </div>
                                <?php
                                }         
                    }elseif(isset($_GET['filt'])){
                        $filtarr=implode(",",$_GET["filter"] ?? null);
                        //var_dump($filtarr);
                        $divide=explode(",",$filtarr);
                        var_dump($divide);
                        // $finalFilter = $divide;
                        
                        
                        $sqlfilt ="SELECT mechID,mechFirstname,mechLastname,Specialization,average,
                        (3959 * acos(cos(radians($v1)) *cos(radians(latitude))* cos(radians(longitude)-radians($v2))+sin(radians($v1))
                        *sin(radians(latitude)))) as distance  from  mechanic WHERE 
                        vehicleType like '%Car Mechanic%' and status='approve' and stats='Active' and Specialization like '%{$divide[0]}%' having distance < 3 order by distance limit 0, 20 ";
                        $query=$dbh->prepare($sqlfilt);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        $cnt=1;       
                        if( $query->rowCount()>0){   
                            foreach($results as $result){?> 
                            <tr class=" mt-2 ">
                                <td class="t-content"><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></td>
                                <td class="t-content"><?php echo htmlentities($result->Specialization);?></td>
                                <td class="t-content">k.m <?php echo number_format($result->distance,1);?> </td>
                                <td class="t-content"><a class="btn btn-warning px-3 shadow-none" href="voCarmechRequest.php?regeditid=<?php echo htmlentities($result->mechID)?>">Details</a></td>
                            </tr>
                            <?php $cnt=$cnt+1;}}     
                                else{?>    
                                <div class="emptyrequest mt-1 pt-4" >
                                <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                <h6>No mechanic nearby. . .</h6>
                                </div>
                                <?php
                                }        
                    }else{
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        $cnt=1;       
                        if( $query->rowCount()>0){   
                            foreach($results as $result){?> 
                            <tr class=" mt-2 " data-aos="fade-left" data-aos-duration="500">
                                <td class="t-content text-start p-3 px-4"><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></td>
                                <td class="t-content text-start p-3">
                                    <?php
                                    $spec = explode(",", $result->Specialization);
                                    foreach($spec as $specialize){
                                        ?>
                                            <span class="badge badge-design row m-0 px-0">
                                                <p class="px-1 text-align-center"><?php echo $specialize; ?></p>
                                            </span>
                                        <?php
                                    }
                                ?>
                                </td>
                                <td class="t-content p-3"><?php echo number_format($result->distance,1);?> KM</td>
                                <td class="t-content px-3"><a class="btn btn-warning px-3" href="voCarmechRequest.php?regeditid=<?php echo htmlentities($result->mechID)?>">Details</a></td>
                            </tr>
                            <?php $cnt=$cnt+1;}}     
                                else{?>    
                                <div class="emptyrequest mt-1 pt-4" >
                                <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                <h6>No mechanic nearby. . .</h6>
                                </div>
                                <?php
                                }        
                    }
                    ?>
                    </tbody>
                </table>
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
                <form method="GET">
                    <div class="modal-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Tire Repair" name="filter[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Tire Repair</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Break Repair" name="filter[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Break Repair</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Engine Overheat Repair" name="filter[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Engine Overheat Repair</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Dead Battery Repair" name="filter[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Dead Battery Repair</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Dead Light Repair" name="filter[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Dead Light Repair</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-pill px-4" name="filt">Apply Search</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    
    </section>
    <?php include('voBottom-nav.php');?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    function preventBack(){window.history.forward();}
        setTimeout("preventBack()",0);
        window.onunload = function(){ null };
    AOS.init({
        duration: 3000,
        once: true,
    });                
   
    </script>
</body>
</html>