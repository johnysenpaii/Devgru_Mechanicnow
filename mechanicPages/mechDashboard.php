<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$mechID1=$_SESSION['mechID'];
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

<body id="contbody" style="background-color: #f8f8f8" onload="GetAddress()">
    <?php include('mechHeader.php');?>
    <section id="nav-top" class="d-none d-md-block top-navigation container-fluid">
        <div class="row">
            <div class="d-flex justify-content-center pt-3">
                <a href="mechActivityLog.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn">Activity
                    Log</a>
                <a href="mechTransaction.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn">Transaction History</a>
            </div>
        </div>
    </section>
    <section id="mechContent" class="mech-content container-fluid">
        <div class="row py-3 px-sm-0 px-md-3 text-center table-responsive justify-content-center pb-5">
            <div class="col-lg-8 bg-white py-4 rounded-3 shadow-lg">
                <h4 class="text-dark pb-4">Available Request</h4>
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
                            $sql="SELECT * from request WHERE mechID=$mechID1 and status='Unaccepted'";
                            $query=$dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchALL(PDO::FETCH_OBJ);

                            if($query->rowCount()>0)
                            {
                            foreach ($results as $result)
                            {
                                if($mechID1==$mechID1)
                                {
                        ?>
                        <tr class="d-flex align-items-center justify-content-around mt-2">
                            <td><?php echo htmlentities($result->vOwnerName);?></td>
                            <td hidden><?php echo htmlentities($result->custID);?></td>
                            <td><?php echo htmlentities($result->serviceNeeded);?></td>
                            <td><a class="btn btn-warning px-3"
                                    href="mechRequestDetails.php?regeditid=<?php echo htmlentities($result->resID)?>">Details</a>
                            </td>
                        </tr> 
                        <?php  }}}
                        else {
                        ?>
                        <div class="emptyrequest pt-1 mt-4">
                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                            <h6>No request available . . .</h6>
                        </div>
                        <?php
                    }
                    ?>
                    </tbody> 
                </table>
            </div>
        </div>
      
        <!-- <div class="row container-fluid py-5 text-center table-responsive justify-content-center">
            <div class="col-lg-8">
                <h4 class="text-dark">Request Available</h4>
                <?php
                    $sql="SELECT * from request WHERE mechID=$mechID1 and status='Unaccepted'";
                    $query=$dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);

                    if($query->rowCount()>0)
                    {
                    foreach ($results as $result)
                    {
                        if($mechID1==$mechID1)
                        {
                ?>
                <table class="table table-borderless table-curved pt-2">
                    <thead>
                    </thead>
                    <tbody>
                        <div class="td-card">
                            <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                            <input type="text" hidden name="custID2"
                                value="<?php echo htmlentities($result->custID);?>">
                            <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>
                            <p><strong>Service Needed: </strong> <?php echo htmlentities($result->serviceNeeded);?></p>
                            <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                            <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                           
      
                            <iframe
                                src="https://maps.google.com/maps   ?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&output=embed"
                                fr  ameborder="0" width="700" height="400"></iframe>
                            <d  iv class="card-btn">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit" class="accept"><a
                                        href="mechRequestDetails.php?regeditid=<?php echo htmlentities($result->resID)?>">Details</a></button>
                                <button class="btn btn-primary btn-lg">Decline</button>
                            </d>
                        </div>
                    </tbody>
                </table>
                <hr class="text-light">
                <?php }}}?>
            </div>
        </div> -->
        <!-- Vertically centered modal -->
        <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Request Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row line-segment seg">
                            <div class="col-sm-3 with-image"><img src="../img/avatar.jpg"
                                    class="rounded-circle imagenajud float-end" alt=""></div>
                            <div class="col-sm-9 d-flex align-items-center">
                                <div class="per-details">
                                    <h4>Wailhi Buu</h4>
                                    <p>Maribago</p>
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
                                <p>Putaena Tibay Bubu, Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Suscipit, exercitationem.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary rounded-pill px-4"
                            data-bs-dismiss="modal">Accept</button>
                        <button type="button" class="btn btn-danger rounded-pill px-4">Decline</button>
                    </div>
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