<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(isset($_POST['comment'])){
    $custid=$_SESSION['custID'];
    $mechid=$_POST['mechid'];
    $value=$_POST['value'];
    $specMessage=$_POST['specMessage'];
   

  
        $sql="INSERT INTO ratingandfeedback(custID,mechID,feedback,ratePercentage)VALUES(:custid, :mechid, :specMessage,:value)";
        $query=$dbh->prepare($sql);
        $query->bindParam(':custid',$custid,PDO::PARAM_STR);
        $query->bindParam(':mechid',$mechid,PDO::PARAM_STR);
        $query->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
        $query->bindParam(':value',$value,PDO::PARAM_STR);
        $query->execute();

  
    $regeditid=intval($_GET['regeditid']);
    $sql123="UPDATE request set ratePercentage=:value WHERE resID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query123=$dbh->prepare($sql123);
    $query123->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
    $query123->bindParam(':value',$value,PDO::PARAM_STR);
    $query123->execute();

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
    </style>
</head>

<body id="contbody" style="background-color: #f8f8f8" onload="rating()">
    <?php include('voHeader.php');?>
    <section id="activityLog">
        <form action="" method="POST">
            <div class="row py-3 px-sm-0 px-md-3 table-responsive justify-content-center pb-5">
                <div class="col-lg-7  py-4  ">

                    <?php
                    $regeditid=intval($_GET['regeditid']);
                    $sql="SELECT *, DATE_FORMAT(Sdate, '%M-%d-%Y at %H:%i %p') as timess from request WHERE status='complete' and resID=:regeditid";
                    $query=$dbh->prepare($sql);
                    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount()>0){
                        foreach ($results as $result){
                        
?>
                    <input type="hidden" name="mechid" value="<?php echo htmlentities($result->mechID);?>">

                    <div class="card text-dark">
                        <div class="card-header py-2 px-3 fw-bold " style="font-size: small;">

                            Transaction details
                        </div>
                        <div class="card-body row ">
                            <div class="col-lg-10">
                                <p class="card-title fw-bold" style="font-size: 14px;">Type of service:
                                    <?php echo htmlentities($result->serviceNeeded);?></p>

                            </div>
                            <div class="col-lg-2">
                                <p class="card-title fw-bold text-center text-light  bg-success py-1 rounded"
                                    style="font-size: 12px;"><i class="fa-solid fa-flag"></i>
                                    <?php echo htmlentities($result->status);?></p>

                            </div>
                            <p class="fw-bold" style="font-size: 14px;"><i class="fa-solid fa-id-badge"></i> Transaction
                                id:
                                <?php echo htmlentities($result->resID);?></p>
                                <p class=" fw-bold" style="font-size: 13px;"><i class="fa-solid fa-car-burst"></i>
                                Problem(s):
                                <?php echo htmlentities($result->serviceType);?></p>
                            <p class=" fw-bold" style="font-size: 13px;"><i class="fa-solid fa-circle-user"></i>
                                Mehcanic name:
                                <?php echo htmlentities($result->mechName);?></p>
                            <p class="card-text fw-bold text-dark rounded" style="font-size: 12px;"><i
                                    class="fa-solid fa-calendar-days"></i> Service start:
                                <?php echo htmlentities($result->timess);?>
                            </p>
                            <p class="card-text fw-bold text-dark  rounded" style="font-size: 12px;"><i
                                    class="fa-solid fa-calendar-check"></i> Service end:
                                <?php echo htmlentities($result->timess);?>
                            </p>
                            <input type="hidden" id="starss" name="total1"
                                value="<?php echo number_format($result->ratePercentage,1);?>">

                            <div class="row" >
                                <div class="col-lg-2">
                                    <p id="stars" class="card-text fw-bold text-dark  rounded" style="font-size: 12px;">
                                    <i class="fa-solid fa-star"></i> <?php echo number_format($result->ratePercentage,1);?>
                                    </p>
                                </div >
                                <?php if($result-> ratePercentage == 0){?>
                                <div class="col-lg-10 text-end">
                                    <a type="sumit" name="rate" class="text-warning fw-bold rounded "
                                        data-bs-toggle="modal" href="#exampleModalToggle2" role="button"
                                        style="font-size: 12px;"> <i class="fa-solid fa-star"></i> Rate</a>
                                </div>
                               <?php }?>
                            </div>



                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6" >
                        <div class="card my-3 text-dark">
                        <div class="card-body">
                            <p class="card-title py-1 px-0 fw-bold " style="font-size: small;">Your details</p>
                            <p class=" fw-bold" style="font-size: 13px;"><i class="fa-solid fa-user"></i> Name:  <?php echo htmlentities($result->vOwnerName);?></p>
                        </div>
                        <label class="card-title px-3 fw-bold " style="font-size: small;" for="iframe"><i class="fa-solid fa-map-location"></i> Your Location:</label>
                        <iframe class="px-3 pb-2"
                            src="https://maps.google.com/maps?q=<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed"
                            frameborder="0" width="auto" height="auto">
                        </iframe>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="card my-3 text-dark">
                    <div class="card-body row">
                    <?php
                   
                    $sql0="SELECT * from mechanic WHERE mechID";
                    $query0=$dbh->prepare($sql0);
                    $query0->execute();
                    $results=$query0->fetchALL(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount()>0){
                        foreach ($results as $result0){
                            if($result->mechID == $result0->mechID){
                        
?>
<div class="col-lg-8">
<p class="card-title py-2 px-0 fw-bold " style="font-size: small;">Mechanic details</p>
                            </div>
                            <div class="col-lg-4">
                                <a href="voDashboard.php" class="card-title fw-bold text-center text-light  bg-info p-2 rounded"
                                    style="font-size: 12px;"><i class="fa-solid fa-paper-plane"></i>
                                   Send request</a>

                            </div>
                           
                            
                            <p class="card-text fw-bold " style="font-size: small;"><i class="fa-solid fa-user"></i> Name:  <?php echo htmlentities($result0->mechFirstname);?> <?php echo htmlentities($result0->mechLastname);?></p>
                            <p class="card-text fw-bold " style="font-size: small;"><i class="fa-solid fa-star"></i> Average rating:  <?php echo number_format($result0->average,1);?></p>

                            <ul class="list-group fw-bold px-2" style="font-size: small;"> Contacts:
                            <li class="list-group-item border-0"><i class="fa-solid fa-at"></i> Email: <?php echo htmlentities($result0->mechEmail);?></li>
                            </ul>
                        </div>
                        <label class="card-title px-3 fw-bold " style="font-size: small;" for="iframe"><i class="fa-solid fa-map-location"></i> Mechanic current location:</label>
                        <iframe class="px-3 pb-2"
                            src="https://maps.google.com/maps?q=<?php echo htmlentities($result0->latitude);?>,<?php echo htmlentities($result0->longitude);?>&output=embed"
                            frameborder="0" width="auto" height="auto">
                        </iframe>
                    </div>
                    </div>
                </div>

                    
                    <?php
                   $cnt=$cnt+1;} }}}}
                    ?>
                </div>
            </div>
            <div class="modal fade text-dark" id="exampleModalToggle2" role="dialog" data-bs-backdrop="static"
                data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Rate Mechanic</h5>
                            <button type="submit" name="confirm" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body star">
                            <!-- rate -->
                            <div class="container">
                                <span id="rateMe1"></span>
                            </div>
                            <div class="star-widget">
                                <input type="radio" name="rate" id="rate-5" value="5"><label for="rate-5"
                                    class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-4" value="4"><label for="rate-4"
                                    class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-3" value="3"><label for="rate-3"
                                    class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-2" value="2"><label for="rate-2"
                                    class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-1" value="1"><label for="rate-1"
                                    class="fas fa-star"></label>
                                <form action=""></form>
                            </div>
                            <input type="hidden" name="value" id="value" value="">
                            <div class="mt-2">
                                <label for="">Leave a Feedback</label>
                                <textarea class="form-control shadow-none" id="exampleFormControlTextarea1" rows="3"
                                    name="specMessage" value="specMessage"></textarea>
                            </div>
                            <button class="btn btn-primary my-1" name="comment" type="sumbit">Comment</button>
                        </div>
                        <!-- <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
                    </div> -->
                    </div>
                </div>
            </div>   
        </form>
    </section>
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
    var starss = document.getElementById("starss").value;
    document.getElementById("stars").innerHTML = getStars(starss);

    function getStars(rating) {

        // Round to nearest half
        rating = Math.round(rating * 2) / 2;
        let output = [];

        // Append all the filled whole stars
        for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: #9132DA;"></i>&nbsp;');

        // If there is a half a star, append it
        if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: #9132DA;"></i>&nbsp;');

        // Fill the empty stars
        for (let i = (5 - rating); i >= 1; i--)
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
    <script src="js/addons/rating.js"></script>
</body>

</html>