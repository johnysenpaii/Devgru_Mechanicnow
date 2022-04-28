<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
if(isset($_POST["comment"])){
    $custID=$_SESSION['custID'];
    $mechID=$_POST['mechID'];
    $value=$_POST['value'];
    $specMessage=$_POST['specMessage'];

    $sql="INSERT INTO ratingandfeedback(custID,mechID,feedback,ratePercentage)VALUES(:custID, :mechID, :specMessage,:value)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
    $query->bindParam(':value',$value,PDO::PARAM_STR);
    $query->execute();

    $resID=$_POST['resID'];
    $sql12="UPDATE request set ratePercentage=:value WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query12=$dbh->prepare($sql12);
    $query12->bindParam(':resID',$resID,PDO::PARAM_STR);
    $query12->bindParam(':value',$value,PDO::PARAM_STR);
    $query12->execute();
    
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
    <?php include('./voTopnav.php');?>

    <section id="activityLog">
        <form action="" method="POST">
            <div class="row py-3 px-sm-0 px-md-3 table-responsive justify-content-center pb-5">
                <div class="col-lg-7  py-4  ">

                    <?php
                    $sql="SELECT *, DATE_FORMAT(Sdate, '%M-%d-%Y at %H:%i %p') as timess from request WHERE status='complete' order by resID DESC";
                    $query=$dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach ($results as $result){
                            if($result->custID == $custID1){
                                
                ?>

                    <div class="card text-dark mb-3 p-2">
                        <div class="row g-1">
                            <div class="col-md-1 bg-light border border-1 rounded text-center fw-bold py-3">
                                <p style="font-size: 20px;"><?php echo number_format($result->ratePercentage,1);?></p>
                                <p class="fw-bold disabled text-muted" style="font-size: 13px;"><span
                                        class="text-warning"><i class="fa-solid fa-star"></i></span> ratings</p>

                            </div>

                            <div class=" col-md-10 p-0">
                                <div class="card-body " onclick="hideone() ">
                                    <input type="text" hidden name="mechID"
                                        value="<?php echo htmlentities($result->mechID);?>">
                                    <h5 class="card-title fw-bold">Request:
                                        <?php echo htmlentities($result->serviceNeeded);?></h5>
                                    <p class="card-text fw-bold disabled text-muted" style="font-size: 13px;">  <i class="fa-solid fa-id-badge"></i> Transaction id: <?php echo htmlentities($result->resID);?> | <i
                                            class="fa-solid fa-calendar-days"></i> Start date:
                                        <?php echo htmlentities($result->timess);?> | <i
                                            class="fa-solid fa-toolbox"></i> Mechanic name:
                                        <?php echo htmlentities($result->mechName);?> | <a href="voViewDetails.php?regeditid=<?php echo htmlentities($result->resID);?>" class="text-info"><i
                                                class="fa-solid fa-eye"></i> View more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <?php }} }else {
                    ?>
                    <div class="emptyrequest mt-5 pt-5">
                        <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                        <h6>No transaction history at the moment. . .</h6>
                    </div>
                    <?php
                    }
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