<style>
<?php include '../css/style.css';
if(isset($_POST["readAll"])){
$sql1="UPDATE vonotification set notifStatus='Read' WHERE notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
$query=$dbh->prepare($sql1);
$query->execute();
}
if(isset($_POST["unreadAccept"])){
    $notification='fsljfklsafpowefsdlfms.,f';
    $notifID = $_POST['notifID'];
    $sql1="UPDATE vonotification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql1);
    $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
    $query->execute();
}
if(isset($_POST["unreadDecline"])){
    $notifID = $_POST['notifID'];
    $sql1="UPDATE vonotification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql1);
    $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
    $query->execute();
}
if(isset($_POST["unreadProgress"])){
    $notification='fsljfklsafpowefsdlfms.,f';
    $notifID = $_POST['notifID'];
    $sql1="UPDATE vonotification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql1);
    $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
    $query->execute();
}
if(isset($_POST["unreadVerify"])){
    $notifID = $_POST['notifID'];
    $sql1="UPDATE vonotification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql1);
    $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
    $query->execute();
}
if(isset($_POST["logout"])) { 
    unset($_SESSION['custID']);
    session_destroy();
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
}

?>
</style>
<section id="nav-bar">
    <form action="" method="POST">
    <nav class="navbar navbar-expand-lg navbar-light container-fluid">
        <div class="container-fluid">
            <a class="navbar-brand" href="./voDashboard.php"><img src="../img/navlogo.png" alt=""></a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown position-relative" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i>
                            <span id="hide1011"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php 
                                            
                                            $custID=$_SESSION['custID'];
											$sql901 ="SELECT * from vonotification where custID = $custID and notifStatus = 'Unread' order by notifID";
											$query901 = $dbh -> prepare($sql901);
											$query901->execute();
											$results901=$query901->fetchAll(PDO::FETCH_OBJ);
											$ban123=$query901->rowCount();
                                            if($ban123 == 0){
                                                echo '<script type="text/javascript">document.getElementById("hide1011").style.display = "none";
                                                </script>';

                                            }
										?>
                                <?php echo htmlentities($ban123);?>
                                <span class="visually-hidden">unread messages</span>
                            </span> Notification
                        </a>
                        <?php
                        $sql="SELECT *, DATE_FORMAT(timess, '%a %b/%d/%Y %H:%i %p') as timess from vonotification WHERE custID=$custID and status='Accepted' or status='verify' or status='Complete' or status='Unaccepted' or status='Decline' order by notifID desc";
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        ?>
                        <ul class="dropdown-menu p-0 notif-class overflow-auto"
                            style="font-size: small; width: 340px; max-height: 60vh; overflow-y: auto;"
                            aria-labelledby="navbarDropdownMenuLink">
                           
                            <?php 
                             $custID=$_SESSION['custID'];
                             $sql9011 ="SELECT * from vonotification where custID = $custID order by notifID";
                             $query9011 = $dbh -> prepare($sql9011);
                             $query9011->execute();
                             $results9011=$query9011->fetchAll(PDO::FETCH_OBJ);
                             $ban1234=$query9011->rowCount();
                                  if($ban1234 == 0){ ?>
                                     <li class="notif-content alert-primary row g-0 text-center sticky-top p-0">
                                <button type="submit" id="mark" class="rounded alert-primary border-0 fw-bold py-1"> <i class="fa-solid fa-face-frown-open"></i> No notification yet!!</button>
                            </li>

                            <?php  }else{ ?>
                                
                                <li class="notif-content alert-primary row g-0 text-center sticky-top p-0">
                                <button type="submit" id="mark" class="rounded alert-primary border-0 fw-bold py-1" name="readAll">Mark all as read</button>
                            </li>

                            <?php };
                            
                            $cnt=1;
                        if($query->rowCount()>0){
                            foreach ($results as $result){
                                if($result->custID==$custID){ 
                                    if($result->status == 'Accepted'){
                                        if($result->notifStatus == 'Unread'){
                                    ?>
                            <li>  
                                <button onclick="unreadAccept()" type="submit" name="unreadAccept" class="alert-success notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 text-end" style="font-size: 20px;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="col-md-10 py-1 text-start fw-bold">
                                        Your request is <?php echo htmlentities($result->status);?>
                                        <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                                <a class="text-center fw-bold" style="font-size: 12px;" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit </a>
                            </button>

                            </li>
                          
                            <?php } else{?>
                                <li>   
                                <button name="unreadAccept" class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 text-end" style="font-size: 20px;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="col-md-10 py-1 text-start fw-light">
                         
                                        Your request is <?php echo htmlentities($result->status);?>
                                </div>
                              <a class="text-center fw-bold" style="font-size: 12px;" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>

                        <?php }} else if($result->status == 'Decline' ){ if($result->notifStatus == 'Unread'){?>

                            <li>  
                                <button   type="submit" name="unreadDecline" class="alert-warning notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 py-1 p-1 text-end" style="font-size: 20px;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="col-md-10 py-1 text-start fw-bold">
                                    Sorry, your request is decline by the Mechanic. Please find another Mechanic.
                                    <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i>visit </a>
                            </button>

                            </li>
                            <?php } else{?>
                               <li>  
                                <button  class="alert-warning notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 py-1 text-end" style="font-size: 20px;">
                                    <i class="fa-solid fa-face-sad-cry"></i>
                                </div>
                                <div class="col-md-10 py-1 text-start fw-light">
                                    Sorry, your request is decline by the Mechanic. Please find another Mechanic.
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>
                            <?php }}else if($result->progressbarStatus=='10'||$result->progressbarStatus=='20'||$result->progressbarStatus=='30'||$result->progressbarStatus=='40'||$result->progressbarStatus=='50'||
                    $result->progressbarStatus=='60'||$result->progressbarStatus=='70'||$result->progressbarStatus=='80'||$result->progressbarStatus=='90'){
                        if($result->notifStatus == 'Unread'){?>
                           <li>  
                                <button   type="submit" name="unreadProgress" class="alert-info notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-bold" style="font-size: 20px;">
                                <?php echo htmlentities($result->progressbarStatus);?>%
                                </div>
                                <div class="col-md-10 text-start fw-bold">
                                This is the current progess of your request updated by your the Mechanic.
                                <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>
                          
                            <?php } else{?>
                                <li>  
                                <button  class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-light" style="font-size: 20px;">
                                <?php echo htmlentities($result->progressbarStatus);?>%
                                </div>
                                <div class="col-md-10 text-start fw-light">
                                The current progess of your request updated by your the Mechanic.
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit </a>
                            </button>

                            </li>
                            
                            <?php }}else if($result->progressbarStatus=='100' && $result->status == 'verify'){
                               if($result->notifStatus == 'Unread'){?>
                                <li>  
                                <button   type="submit" name="unreadVerify" class="alert-warning notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-bold" style="font-size: 20px;">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                                </div>
                                <div class="col-md-10 text-start fw-bold">
                                Your Mechanic sent a "Request complete" message. Please check your vehicle before accepting.
                                <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>
                        <?php } else { ?>
                            <li>  
                                <button  class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-light" style="font-size: 20px;">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                                </div>
                                <div class="col-md-10 text-start fw-light">
                                Your Mechanic sent a "Request complete" message. Please check your vehicle before accepting.
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>

                    <?php }}
                    else if($result->status == 'Home service'){
                        if($result->notifStatus == 'Unread'){
                        ?>
                        <li>  
                                <button   type="submit" name="unreadVerify" class="alert-warning notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-bold" style="font-size: 20px;">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                                </div>
                                <div class="col-md-10 text-start fw-bold">
                                Your Mechanic sent a "Request complete" message. Please check your vehicle before accepting.
                                <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>
                        <?php
                        }else{
                        ?>
                            <li>  
                                <button  class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 pl-2 text-end fw-light" style="font-size: 20px;">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                                </div>
                                <div class="col-md-10 text-start fw-light">
                                Your Mechanic sent a "Request complete" message. Please check your vehicle before accepting.
                                </div>
                                <a class="text-center" href="voActivityLog.php"><i class="fa-solid fa-eye"></i> visit</a>
                            </button>

                            </li>
                        <?php
                        }        
                    }
                    }}} ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./voChat.php"><i class="fa-regular fa-comment"></i> Messages</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa-solid fa-caret-down" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><button type="submit" class="dropdown-item" name="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> 
                                    Logout</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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