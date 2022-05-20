<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
$latitude=$_SESSION['latitude'];
$longitude=$_SESSION['longitude'];


if(isset($_POST['send'])){  
    $latitude=$_SESSION['latitude'];
    $longitude=$_SESSION['longitude'];
    $mechName=$_POST['mechName'];
    $voName=$_POST['voName'];
    $Specialization=$_POST['Specialization'];
    $vehicleType=$_POST['vehicleType'];
    $specMessage=$_POST['specMessage'];
    $mechRepair=$_POST['mechRepair'];  //checkbox1
    $service=$_POST['service'];
    $mechID=$_POST['mechID'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $custID=$_SESSION['custID'];
    

    
    // $currentlocation=$_POST['currentlocation'];
    if(isset($_POST["mechRepair"])){
        $mechRepairInsert = implode(',', $_POST['mechRepair']);
    }
    if(empty($mechRepairInsert)){
         echo "<script>alert('Please select vehicle problem')</script>";
    }else{
        try{
            if(!isset($errorMsg)){
                $sql12="INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, serviceNeeded, mechID, custID, latitude, longitude, date, timess) 
                values (:mechName, :voName , :specMessage, :mechRepairInsert, :Specialization, :service,:mechID ,:custID ,:latitude , :longitude, :date, :time)";
                $query12=$dbh->prepare($sql12);
                $query12->bindParam(':mechName',$mechName,PDO::PARAM_STR);
                $query12->bindParam(':voName',$voName,PDO::PARAM_STR);
                $query12->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
                $query12->bindParam(':mechRepairInsert',$mechRepairInsert,PDO::PARAM_STR);
                $query12->bindParam(':Specialization',$Specialization,PDO::PARAM_STR);
                $query12->bindParam(':service',$service,PDO::PARAM_STR);
                $query12->bindParam(':latitude',$latitude,PDO::PARAM_STR);
                $query12->bindParam(':longitude',$longitude,PDO::PARAM_STR);
                $query12->bindParam(':custID',$custID,PDO::PARAM_STR);
                $query12->bindParam(':mechID',$mechID,PDO::PARAM_STR);
                $query12->bindParam(':date',$date,PDO::PARAM_STR);
                $query12->bindParam(':time',$time,PDO::PARAM_STR);
                $query12->execute();
                 $msg='Request success!!';
                header("Location:voActivityLog.php?/requestForm=$msg");
            }else{
                $msgFailed = 'Request Failed!!';
                header("Location:voCarMechRequest.php?/requestForm=$msgFailed");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>

<body id="contbody" style="background-color: #f8f8f8;" onload="GetAddress();">

    <section id="mechRequest">
        <form method="POST">
            <?php
                $regeditid=intval($_GET['regeditid']);
                $sql="SELECT * from mechanic WHERE mechID=:regeditid";
                $query=$dbh->prepare($sql);
                $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);

                if($query->rowCount()>0){
                    foreach ($results as $result) {
            ?>
            <div class="container-fluid p-0">
                <div class="row m-0 p-0">
                    <iframe class="col-12 col-md-8" src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed" frameborder="0" style="height: 100vh;padding: 0px"></iframe>
                    <div class="col-12 col-sm-4 m-0 info-panel shadow-lg p-3" style="background-color: #fff">
                        <div class="row align-items-center">
                            <div class="col-3 mx-3 with-image" style="width: 100px; padding: 5px;">
                                <img src="../uploads/<?=$result->profile_url ?>" onerror="this.src='../img/mech.jpg';" class="float-center imagenajud" alt="" style="max-width: 100%; height: 90px; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="mech-inforeq col-7">
                                <h4><input readonly type="text" class="border-0 no-shadow shadow-none mt-2" name="mechName" value="<?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?>"></h4>
                                <input type="hidden" id="starss" value="<?php echo htmlentities($result->average);?>">
                                <span type="text" id="stars" onload="getStars()" name="total"></span><br>
                                <input readonly type="text" class="border-0 m-info " size="20" name="vehicleType" value="<?php echo htmlentities($result->vehicleType);?>"><br>
                                <input readonly type="hidden" class="border-0 m-info" size="30" name="Specialization" value="<?php echo htmlentities($result->Specialization);?>">
                                <div class="spec-sec">
                                <?php
                                    $spec = explode(",", $result->Specialization);
                                    foreach($spec as $specialize){
                                        ?>
                                            <span class="badge bg-success px-0" style="margin: 1px;">
                                                <p class="px-1 " style="padding-inline: 2px;"><?php echo $specialize; ?></p>
                                            </span>
                                        <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        
                        <input hidden type="text" name="voName" value="<?php echo htmlentities($_SESSION["custFirstname"]); ?> <?php echo htmlentities($_SESSION["custLastname"]); ?>">
                        <input hidden type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                        <input id="address" name='latitude' value="<?php echo htmlentities($_SESSION["latitude"]); ?>" hidden>
                        <input id="address" name='longitude' value="<?php echo htmlentities($_SESSION["longitude"]); ?>" hidden>
                        <input type="hidden" name="role" value="sender">
                        <hr class="divider">
                        <div class="request-form" style="color: #302D32">
                            <div class="alert alert-primary text-start py-0 pb-1 mb-0 note-alert shadow-sm">
                                <div class="row warning-rani">
                                    <i class="fa-solid fa-circle-exclamation col-1 text-end px-0" style="color: #9132da"></i> 
                                    <p class="col-10 col-sm-11 py-1">
                                        If you want a long term service, select Home Service. Select Emergency service if you are
                                        on-road.
                                    </p>
                                </div>
                            </div>
                            <div class="request-content text-start">
                                <div class="form-check">
                                    <input class="form-check-input mt-2" type="radio" value="Home Service" name="service"
                                        id="exampleRadios1">
                                    <label class="form-check-label mt-1" for="exampleRadios1">
                                        Home Service
                                    </label>
                                </div>
                                <div id="textboxes" style="display: none">
                                    Date: <input onfocus="this.value=''" name="date" type="date" />
                                    Time: <input onfocus="this.value=''" name="time" type="time" />
                                </div>
                                <div class="form-check pb-2">
                                    <input class="form-check-input" type="radio" value="Emergency Service" name="service"
                                        id="exampleRadios2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Emergency Service
                                    </label>
                                </div>
                                <span class="sub-title">Please select and/or specify mechanical problem below.</span>
                                <div class="repair-list" id="repairbox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                            name="mechRepair[]" value="Tire Repair">
                                        <label class="form-check-label" for="flexCheckDefault">Tire Repair</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                            name="mechRepair[]" value="Engine Overheat Repair">
                                        <label class="form-check-label" for="flexCheckDefault">Engine Overheat Repair</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                            name="mechRepair[]" value="Dead Battery Repair">
                                        <label class="form-check-label" for="flexCheckDefault">Dead Battery Repair</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                            name="mechRepair[]" value="Break Repair">
                                        <label class="form-check-label" for="flexCheckDefault">Break Repair</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                            name="mechRepair[]" value="Dead Light Repair">
                                        <label class="form-check-label" for="flexCheckDefault">Dead Light Repair</label>
                                    </div>
                                    <div class="mt-2">
                                        <label for="">Leave a Message</label>
                                        <textarea class="form-control shadow-none" id="exampleFormControlTextarea1"
                                            placeholder="Please specify..." rows="3" name="specMessage"
                                            value="specMessage"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row request-buttons">
                            <div class="col-md-6 d-grid "><a type="button" class="btn btn-primary rounded-pill shadow border-0" id="trap" onclick="trappings()">Request</a></div>
                            <div class="col-md-6 d-grid "> <button class="btn btn-secondary rounded-pill shadow border-0" type="button"><a href="./voCarmech.php">Back</a></button></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal for confirmation -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <?php
                            $regeditid=intval($_GET['regeditid']);
                            $sql="SELECT * from mechanic WHERE mechID=:regeditid";
                            $query=$dbh->prepare($sql);
                            $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchALL(PDO::FETCH_OBJ);

                            if($query->rowCount()>0){
                                foreach ($results as $result){
                        ?>
                        Are you sure to send a request to <?php echo htmlentities($result->mechFirstname." ".$result->mechLastname)?>?
                        <?php }}?>
                        <div class="pt-5">
                            <button type="submit" class="btn btn-primary rounded-pill shadow" name="send" value="send">Submit Request</button>
                            <button type="button" class="btn btn-secondary rounded-pill shadow" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php }}?>
            <input hidden type="text" id="latitude" name="latitude"
                value="<?php echo htmlentities($_SESSION["latitude"]); ?> ">
            <input hidden type="text" id="longitude" name="longitude"
                value=" <?php echo htmlentities($_SESSION["longitude"]); ?>">
        </form>
    </section>
   


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
    //trappings
    function trappings(){
        var service = document.getElementsByName("service");
        var repairbox = document.getElementById("repairbox");
        var chkbox = repairbox.getElementsByTagName("INPUT");
        var trap = document.getElementById("trap");
        var checked = 0;
        var rd = 0;

        for (var i = 0; i < chkbox.length; i++) {
            if (chkbox[i].checked) {
                checked++;
            }
        }
        
        if (checked > 0) {
            for (var i = 0, len = service.length; i < len; i++) {
                if (service[i].checked) {
                    rd++;
                }
            }
            if(rd > 0){
                // setAttribute(trap, {"data-bs-target":"#exampleModal", "data-bs-toggle":"modal"});
                trap.setAttribute("data-bs-target", "#exampleModal"); 
                trap.setAttribute("data-bs-toggle", "modal"); 
                
            }else{
                alert("You must choose what service you want.");
                return false;
            }
        } else {
            alert("You must choose what mechanical problems you have.");
            return false;
        }

    }
    // function setAttributes(el,var attrs){
    //     for(var key in attrs){
    //         trap.setAttribute(key, attrs[key]);
    //     }
    // }
    

    //another function
    $(function() {
        $('input[name="service"]').on('click', function() {
            if ($(this).val() == 'Home Service') {
                $('#textboxes').show();
            } else {
                $('#textboxes').hide();
            }
        });
    });

    function totalIt() {
        var input = document.getElementsByName("mechAmount");
        var total = 0;
        for (var i = 0; i < input.length; i++) {
            if (input[i].checked) {
                total += parseFloat(input[i].value);
            }
        }
        document.getElementsByName("Tamount")[0].value = "₱" + total.toFixed(2);
    }
    $(function() {
        $('input[name="service"]').on('click', function() {
            if ($(this).val() == 'Home Service') {
                $('#textboxes').show();
            } else {
                $('#textboxes').hide();
            }
        });
    });

    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };

    var starss = document.getElementById("starss").value
    document.getElementById("stars").innerHTML = getStars(starss);

    function getStars(starss) {

        // Round to nearest half
        starss = Math.round(starss * 2) / 2;
        let output = [];

        // Append all the filled whole stars
        for (var i = starss; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: #9132DA;"></i>&nbsp;');

        // If there is a half a star, append it
        if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: #9132DA;"></i>&nbsp;');

        // Fill the empty stars
        for (let i = (5 - starss); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: #9132DA;"></i>&nbsp;');

        return output.join('');
    }
    </script>
</body>

</html>