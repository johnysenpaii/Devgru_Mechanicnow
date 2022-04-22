<section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light container-fluid">
        <div class="container-fluid">
            <a class="navbar-brand" href="./voDashboard.php"><img src="../img/navlogo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./voProfile.php"><i class="fa-regular fa-user"></i>
                            <?php echo htmlentities($_SESSION["Username"]); ?></a>
                    </li>
                    <?php 
                                            $custID1=$_SESSION['custID'];
											$sql3 ="SELECT * from request where custID=$custID1 and status='Accepted' or status='verify' or status='Complete' or status='Unaccepted'";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$reqAccepted=$query3->rowCount();
                                            if($reqAccepted == 0){
                                                echo "<script type='text/javascript'>document.getElementById('hide5').style.display = 'none';
                                                </script>";
                                            }
										?>

                    <li class="nav-item dropdown">
                        <a onclick="hidered()"  class="nav-link dropdown position-relative" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i>
                            <span id="hide5"
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                            </span>Notification
                        </a>

                        <?php
                        $sql="SELECT * from request WHERE custID=$custID1 and status='Accepted' or status='verify' or status='Complete' or status='Unaccepted' order by resID desc";
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        ?>



                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
                            <?php  
                            $cnt=1;
                        if($query->rowCount()>0){
                            foreach ($results as $result){
                                if($custID1==$custID1){ 
                                    if($result->status == 'Complete' || $result->status == 'Accepted' || $result->status == 'Unaccepted'){
                                    ?>
                                    <li class="p-1" style="font-size: small; width: 215px; height: auto;">
                                        <a href="" class="">
                                            <p><small>Your Request is <?php echo htmlentities($result->status);?></small></p>
                                        </a>
                                    </li>
                            <!-- <li class="p-0 " style="font-size: small; width: 215px; height: auto;">
                                <div class="card border-0">
                                    <div class="card-body fw-bold">
                                        <p class="card-text">Your request is <?php echo htmlentities($result->status);?></p>
                                    </div>
                                </div>
                            </li> -->
                            <?php $cnt=$cnt+1;} else if($result->status == 'verify' ){?>
                                <li class="p-0 " style="font-size: small; width: 215px; height: auto;">
                                <div class="card border-0">
                                    <div class="card-body fw-bold">
                                        <p class="card-text"></i> Please confirm!</p>
                                    </div>
                                </div>
                            </li> 
                        <?php } }}} ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa-solid fa-caret-down" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item fa-thin fa-gear" href="#"> Settings</a></li>
                            <li><a class="dropdown-item fa-thin fa-right-from-bracket" href="#" onclick="myconfirm()">
                                    Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<script>
function myconfirm() {
    let text = "Are sure you want to leave?.";
    if (confirm(text) == true) {
        location.replace('../login.php')
    } else {
        location.reload();
    }
}
function hidered(){
    document.getElementById("hide5").style.display="none";
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