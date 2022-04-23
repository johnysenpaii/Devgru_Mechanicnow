<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
$latitude=$_SESSION['latitude'];
$longitude=$_SESSION['longitude'];


if(isset($_POST['send'])){  
    $host="localhost";
    $username="root"; 
    $word="";
    $db_name="mechanicnowdb"; 
    $tbl_name="request"; 
    $con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  

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
    // $currentlocation=$_POST['currentlocation'];
    $chk=""; 
    $spec="";
    $mechN="";
    $vON="";
    $mID="";
    $Specl="";
    $serv="";
    $date1="";
    $time1="";
    $date4="";

    // $currentL="";
    foreach($mechRepair as $chk1){  
        $chk .= $chk1.", ";
    } 
    $spec .= $specMessage;  
    $mechN .= $mechName;
    $vON .= $voName;
    $mID .= $mechID;
    $Specl .= $Specialization;
    $serv .= $service;
    $date1 .= $date;
    $time1 .= $time;


    $in_ch=mysqli_query($con,"INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, serviceNeeded, mechID, custID, latitude, longitude, date, time) values ('$mechN', '$vON' , '$spec', '$chk', '$Specl', '$serv', '$mID', '$custID1', '$latitude', '$longitude', '$date1', '$time1')");//,'$latitude','$longitude','$currentL',
    if($in_ch==1)  
    {  
        echo'<script>alert("Request Sent Successfully, Wait for Mechanic to Confirm!")</script>';  
        echo"<script>location.replace('voDashboard.php');</script>";    
    }  
    else  
    {  
        echo'<script>alert("Failed to Send Request")</script>';  
    } 

            $role = $_POST['role']; 
            $custID = $_SESSION['custID']; 
            $custName = $_POST['custName'];
           

            $sql2 = "INSERT INTO chat(custID, mechID, custName, mechName, message, role) VALUES(:custID, :mechID, :custName, :mechName, :specMessage, :role)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
            $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
            $query2->bindParam(':custName',$custName,PDO::PARAM_STR);
            $query2->bindParam(':mechName',$mechName,PDO::PARAM_STR);
            $query2->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
            $query2->bindParam(':role',$role,PDO::PARAM_STR);
            $query2->execute();
            
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

<body id="contbody" style="background-color: #f8f8f8; margin-top: 10px;" onload="GetAddress();">

    <section class="mechRequest" class="container-fluid">
        <form method="POST">
            <?php
                $regeditid=intval($_GET['regeditid']);
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
            <div class="row py-3 px-sm-0 px-md-3 text-center table-responsive justify-content-center pb-5">
                <div class="col-md-8 bg-white p-4 rounded-3 shadow-lg">
                    <div class="row text-dark">
                        <h3 class="pb-4">Request Form</h3>
                        <div class="col-sm-12 col-md-6 pb-5 justify-content-center">
                            <h5 class="text-start">
                                <center><strong>Mechanic Information</center></strong>
                            </h5>
                            <div class="with-image"><img src="../img/vo.jpg"
                                    class="rounded-circle imagenajud float-center mt-2" alt=""></div>
                            <div class="row py-2">
                                <input readonly type="text" class="border-0 text-center" name="mechName"
                                    value="<?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?>">
                                <td><input type="hidden" id="starss"
                                        value="<?php echo htmlentities($result->average);?>"> </td>
                                <td><span type="text" id="stars" onload="getStars()" name="total"></span></span> </td>
                                <h6 class="border-0 text-center mt-2"><i>Mechanic Type</i></h6>
                                <input readonly type="text" class="border-0 text-center" name="vehicleType"
                                    value="<?php echo htmlentities($result->vehicleType);?>">
                                <h6 class="border-0 text-center"><i>Specialization</i></h6>
                                <input readonly type="text" class="border-0 text-center" name="Specialization"
                                    value="<?php echo htmlentities($result->Specialization);?>">
                                <input hidden type="text" name="voName"
                                    value="<?php echo htmlentities($_SESSION["custFirstname"]); ?> <?php echo htmlentities($_SESSION["custLastname"]); ?>">
                                <input hidden type="text" name="mechID"
                                    value="<?php echo htmlentities($result->mechID);?>">
                                <input id="address" name='latitude'
                                    value="<?php echo htmlentities($_SESSION["latitude"]); ?>" hidden>
                                <input id="address" name='longitude'
                                    value="<?php echo htmlentities($_SESSION["longitude"]); ?>" hidden>
                                <input type="hidden" name="role" value="sender">
                                <iframe class="pt-4"
                                    src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed"
                                    frameborder="0" width="400" height="250">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3 text-start">
                            <p>If you want a long term service, select Home Service. Select Emergency service if you are
                                on-road.</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="Home Service" name="service"
                                    id="exampleRadios1">
                                <label class="form-check-label" for="exampleRadios1">
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
                            <h6><i>Please select and/or specify mechanical problem below.</i></h6>
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
                    <div class="row pt-1">
                        <div class="col-md-6 d-grid pb-1"><button class="btn btn-primary rounded-pill" name="send"
                                value="send">Request</button></div>
                        <div class="col-md-6 d-grid pb-1"> <button class="btn btn-secondary rounded-pill"
                                type="button"><a href="./voCarmech.php">Back</a></button></div>
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
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script>
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
</body>

</html>