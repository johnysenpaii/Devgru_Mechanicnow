<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID']; 

if(isset($_POST['car'])){

        $kilo = $_POST['kilo'];
        $sql="UPDATE mechanic set distanceKM=:kilo WHERE mechID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql);
        $query->bindParam(':kilo',$kilo,PDO::PARAM_STR);
        $query->execute();
        echo "<script type='text/javascript'>document.location='voCarmech.php';</script>";
        
}
elseif(isset($_POST['motorcycle'])){
    $kilo = $_POST['kilo'];
        $sql="UPDATE mechanic set distanceKM=:kilo WHERE mechID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql);
        $query->bindParam(':kilo',$kilo,PDO::PARAM_STR);
        $query->execute();
        echo "<script type='text/javascript'>document.location='voMotorcyclemech.php';</script>";
}
elseif(isset($_POST['bicycle'])){
    $kilo = $_POST['kilo'];
        $sql="UPDATE mechanic set distanceKM=:kilo WHERE mechID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql);
        $query->bindParam(':kilo',$kilo,PDO::PARAM_STR);
        $query->execute();
        echo "<script type='text/javascript'>document.location='voBikemech.php';</script>";
}

// if(isset($_POST['update'])){
//      $sql="UPDATE customer set latitude=:latitude,longitude=:longitude WHERE custID=:custID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
//             $query2=$dbh->prepare($sql);
//             $query2->bindParam(':latitude',$latitude,PDO::PARAM_STR);
//             $query2->bindParam(':longitude',$longitude,PDO::PARAM_STR);
//             $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
//             $query2->execute(); 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

<body id="contbody" style="background-color: #f8f8f8" onload="calcCrow()">
    <?php include('./voHeader.php');?>
    <?php include('./voTopnav.php');?>
    <section id="serviceOptions" class="container-fluid container-md py-3 pb-5 mb-5">
        <form action="" method="POST">
            <?php
            $sql="SELECT * FROM mechanic WHERE mechID";
            $query=$dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchALL(PDO::FETCH_OBJ);
            $cnt=1;       
            if( $query->rowCount()>0){
                foreach($results as $result){            
            ?> 
            <input hidden type="text" name='lat2' id="lat2" value="<?php echo htmlentities($result->latitude);?>">
            <input hidden type="text" name='lon2' id="lon2" value="<?php echo htmlentities($result->longitude);?>">  
            <?php }}?>
             <input hidden name="lat1" id="lat1" type="text" value="<?php echo htmlentities($_SESSION['latitude']);?>">
            <input hidden name="lon1" id="lon1" type="text" value="<?php echo htmlentities($_SESSION['longitude']);?>">
          <input hidden name="kilo" id="kilo" type="text" value=""> 
            <div class="row gx-5 row-ari">
                <div class="col-sm-9">
                    <div class="row">
                        <div
                            class="col-sm-8 col-md-12 col-lg-10 bg-white text-dark p-3 rounded-3 offset-sm-4 offset-md-0 offset-lg-2">
                            <h4 class="line-segment">Choose Mechanic Service Category</h4>
                            <div class="row row-cols-1 row-cols-md-3 g-4 py-3">
                                <div class="col">
                                    <div class="card h-100">
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
                                    <div class="card h-100">
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
                                    <div class="card h-100">
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
                    </div>
                </div>
                <div class="col-sm-3 bg-white text-dark rounded-3 cont-act">
                    <div class="act-content">
                        <h5 class="py-2 pb-2 text-center">Recent Activities</h5>
                        <?php
                            $sql="SELECT * from request WHERE custID=$custID1 and status='Unaccepted' order by resID DESC";
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
                            <!-- <h6><?php echo htmlentities($result->serviceNeeded);?></h6> -->
                            <p class="fs-6 pb-2">You sent an <?php echo htmlentities($result->serviceNeeded);?> request to <?php echo htmlentities($result->mechName);?></p>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="button">Details</button>
                            </div>
                        </div>
                        <?php }}}?>
                        <!-- <?php
                        $sql="SELECT * from request WHERE custID=$custID1 and status='Unaccepted' order by resID DESC";
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);

                        if($query->rowCount()>0)
                        {
                        foreach ($results as $result)
                        {
                            if($custID1==$custID1)
                            {
                        ?> -->
                        <!-- <div class="request-table">
                            <table class="table-card">
                                <tr class="row-card">
                                    <td class="data-card">
                                        <div class="td-card text-dark">
                                            <h3><?php echo htmlentities($result->mechName);?></h3>
                                            <h3>Home Service</h3>
                                            <p><strong>Description : </strong>
                                                <?php echo htmlentities($result->mechRepair);?></p>
                                            <p id="status"><strong>Status: </strong>
                                                <?php echo htmlentities($result->status);?></p>
                                            <p><strong>Specific Message:</strong>
                                                <?php echo htmlentities($result->specMessage);?></p>
                                            <p><strong>Address:</strong>
                                                <?php echo htmlentities($result->custAddress);?></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div> -->
                        <!-- <?php }}}?> -->
                    </div>
                </div>

            </div>
        </form>
        <!-- Start of modal -->
        <!-- <div class="modal" tabindex="-1" id="myModal" >
            <form method="POST">
            <div class="modal-dialog text-dark">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Some of the function may require location, Do you want to turn it on?</p>
                    <input   type="text"  id="latitude" name="latitude" value="">
                    <input  type="text"  id="longitude" name="longitude" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" >Yes</button>
                    <button type="submit" class="btn btn-secondary" name="update">Back</button>
                </div>
                </div>
            </div>
            </form>
        </div> -->
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
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
    <script>   
//     var x = document.getElementById("latitude");
//     var y = document.getElementById("longitude");
// function getLocation() {
//     if (navigator.geolocation) {
//         navigator.geolocation.getCurrentPosition(showPosition);
//     } else { 
//         x.value = "Geolocation is not supported by this browser.";
//         y.value = "Geolocation is not supported by this browser.";
//     }
//     function showPosition(position) {
//     x.value = position.coords.latitude;
//     y.value = position.coords.longitude;
//     document.getElementById("latitude").innerHTML = x;
//     document.getElementById("longitude").innerHTML = y;
//     }
        var km = document.getElementById('kilo');
        var lat1 = document.getElementById('lat1').value;
        var lon1 = document.getElementById('lon1').value;
        var lat2 = document.getElementById('lat2').value;
        var lon2 = document.getElementById('lon2').value;
        km.value = (calcCrow(lat1,lon1,lat2,lon2).toFixed(1));
//This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
function calcCrow(lat1, lon1, lat2, lon2) 
{
  var R = 6371; // km
  var dLat = toRad(lat2-lat1);
  var dLon = toRad(lon2-lon1);
  var lat1 = toRad(lat1);
  var lat2 = toRad(lat2);

  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c;
  return d;
}

// Converts numeric degrees to radians
function toRad(Value) 
{
    return Value * Math.PI / 180;
}


</script>
    
</body>

</html>