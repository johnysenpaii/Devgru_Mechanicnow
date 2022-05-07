<style>
<?php include '../css/style.css';

if(isset($_POST["readAll"])) {
    $sql12="UPDATE notification set notifStatus='Read' WHERE notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query12=$dbh->prepare($sql12);
    $query12->execute();
}

if(isset($_POST["unreadRequest"])) {
    $notification='New request!';
    $notifID=$_POST['notifID'];
    $sql123="UPDATE notification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query123=$dbh->prepare($sql123);
    $query123->bindParam(':notifID', $notifID, PDO::PARAM_STR);
    $query123->execute();


}

if(isset($_POST["unreadComplete"])) {
    $notification1='Request complete!';
    $notifID=$_POST['notifID'];
    $sql1234="UPDATE notification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query1234=$dbh->prepare($sql1234);
    $query1234->bindParam(':notifID', $notifID, PDO::PARAM_STR);
    $query1234->execute();

}


?>
</style>
<section id="nav-bar">
    <form method="POST">
        <nav class="navbar navbar-expand-lg navbar-light container-fluid">
            <div class="container-fluid">
                <a class="navbar-brand" href="./mechDashboard.php"><img src="../img/navlogo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>

                        <?php if($_SESSION["status"] == 'pending'){?>
                        <li class="nav-item">
                            <div class="alert alert-danger p-2 fw-bold my-0" style="font-size: 12px;" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i> Please wait for the Admin to approve your
                                account and check your email for updates.
                            </div>
                        </li>
                        <?php } else if($_SESSION["status"] == 'ban'){?>
                        <li class="nav-item">
                            <div class="alert alert-warning p-2 my-0 fw-bold" style="font-size: 12px;" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i> Your account has <strong>BANNED</strong>
                                becuase of unnecessary actions.
                            </div>
                        </li>
                        <?php }?>


                        <?php if($_SESSION["statActiveNotActive"] == 'Active'){?>

                        <li class="nav-item ">
                            <a class="nav-link position-relative" href="./mechProfile.php"><i class="fa-regular fa-user"></i>
                                <?php echo htmlentities($_SESSION["mechFirstname"]); ?>
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span>
                            </a>
                        </li>
                        <?php }else if($_SESSION["statActiveNotActive"] == 'Not active'){?>
                            <li class="nav-item ">
                            <a class="nav-link position-relative" href="./mechProfile.php"><i class="fa-regular fa-user"></i>
                                <?php echo htmlentities($_SESSION["mechFirstname"]); ?>
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span>
                            </a>
                        </li>

                        <?php }?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown position-relative" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-bell"></i>
                                <span id="hide101" style="display: block;"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php 
                                            
                                            $mechID=$_SESSION['mechID'];
											$sql90 ="SELECT * from notification where mechID = $mechID and notifStatus = 'Unread' order by notifID   ";
											$query90 = $dbh -> prepare($sql90);
											$query90->execute();
											$results90=$query90->fetchAll(PDO::FETCH_OBJ);
											$ban12=$query90->rowCount();
                                            if($ban12 == 0){
                                                echo "<script type='text/javascript'>document.getElementById('hide101').style.display = 'none';
                                                </script>";

                                            }
										?>

                                    <?php echo htmlentities($ban12);?>
                                    <span class="visually-hidden">unread messages</span>
                                </span> Notification
                            </a>

                            <?php
                        $sql101="SELECT *, DATE_FORMAT(time, '%a %b/%d/%Y %H:%i %p') as timess from notification WHERE mechID order by notifID desc";
                        $query101=$dbh->prepare($sql101);
                        $query101->execute();
                        $results=$query101->fetchALL(PDO::FETCH_OBJ);
                        ?>
                            <ul class="dropdown-menu p-0 notif-class"
                                style="font-size: small; width: 340px; max-height: 60vh; overflow-y: auto;"
                                aria-labelledby="navbarDropdownMenuLink">
                                <?php 
                               $mechID=$_SESSION['mechID'];
                             $sql90112 ="SELECT * from notification where  mechID = $mechID order by notifID";
                             $query90112 = $dbh -> prepare($sql90112);
                             $query90112->execute();
                             $results90112=$query90112->fetchAll(PDO::FETCH_OBJ);
                             $ban12342=$query90112->rowCount();
                                  if($ban12342 == 0){ ?>
                                <li class="notif-content alert-primary row g-0 text-center sticky-top p-0">
                                    <button type="submit" id="mark" class="rounded alert-primary border-0 fw-bold py-1">
                                        <i class="fa-solid fa-face-frown-open"></i> No notification yet!!</button>
                                </li>

                                <?php  }else{ ?>

                                <li class="notif-content alert-primary row g-0 text-center sticky-top p-0">
                                    <button type="submit" id="mark" class="rounded alert-primary border-0 fw-bold py-1"
                                        name="readAll">Mark all as read</button>
                                </li>

                                <?php }; 
                         
                        if($query101->rowCount()>0){
                            foreach ($results as $result){
                                if($result -> mechID == $mechID){                                   
                                     if($result->status == 'Unaccepted'){
                                        if($result->notifStatus == 'Unread'){

                                    ?>

                                <li>
                                    <button type="submit" name="unreadRequest"
                                        class="alert-success notif-content row text-center border-0 w-100 mx-0">
                                        <p class="text-end text-small fw-light" style="font-size: smaller;">
                                            <?php echo htmlentities($result->timess)?></p>
                                        <div class="col-md-2 p-1 text-end" style="font-size: 30px;">
                                            <i class="fa-solid fa-face-smile-beam"></i>
                                        </div>
                                        <div class="col-md-10 py-3 text-start fw-bold">
                                            Hey! <?php echo htmlentities($_SESSION['mechFirstname']);?> you have a new
                                            request.
                                            <input type="hidden" name="notifID"
                                                value="<?php echo  htmlentities($result->notifID);?>">
                                        </div>
                                        <a class="text-center" href="mechDashboard.php"><i class="fa-solid fa-eye"></i>
                                            visit</a>
                                    </button>

                                </li>

                                <?php } else{ ?>


                                <li>
                                    <button type="submit" name="unreadRequest"
                                        class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                        <p class="text-end text-small fw-light" style="font-size: smaller;">
                                            <?php echo htmlentities($result->timess)?></p>
                                        <div class="col-md-2 p-1 text-end" style="font-size: 30px;">
                                            <i class="fa-solid fa-face-smile-beam"></i>
                                        </div>
                                        <div class="col-md-10 py-3 text-start fw-light">
                                            Hey! <?php echo htmlentities($_SESSION['mechFirstname']);?> you have a new
                                            request.
                                            <input type="hidden" name="notifID"
                                                value="<?php echo  htmlentities($result->notifID);?>">
                                            <a class="text-center" href="mechDashboard.php"><i
                                                    class="fa-solid fa-eye"></i> visit</a>
                                    </button>

                                </li>
                                <?php }
                            }  else if($result->status == 'Complete' ){ if($result->notifStatus == 'Unread'){?>

                                <li>
                                    <button type="submit" name="unreadComplete"
                                        class="alert-success notif-content row text-center border-0 w-100 mx-0">
                                        <p class="text-end text-small fw-light" style="font-size: smaller;">
                                            <?php echo htmlentities($result->timess)?></p>
                                        <div class="col-md-2 p-1 py-3 text-end" style="font-size: 30px;">
                                            </i> <i class="fa-solid fa-face-smile-beam"></i>
                                        </div>
                                        <div class="col-md-10 py-3 text-start fw-bold">
                                            Good job!! You completed your request today.
                                            request.
                                            <input type="hidden" name="notifID"
                                                value="<?php echo  htmlentities($result->notifID);?>">
                                        </div>
                                        <a class="text-center" href="mechTransaction.php"><i
                                                class="fa-solid fa-eye"></i> visit</a>
                                    </button>

                                </li>



                                <?php } else {?>
                                <li>
                                    <button type="submit" name="unreadComplete"
                                        class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                        <p class="text-end text-small fw-light" style="font-size: smaller;">
                                            <?php echo htmlentities($result->timess)?></p>
                                        <div class="col-md-2 p-1 py-3 text-end" style="font-size: 30px;">
                                            </i> <i class="fa-solid fa-face-smile-beam"></i>
                                        </div>
                                        <div class="col-md-10 py-3 text-start fw-light">
                                            Good job!! You completed your request today.
                                            request.
                                            <input type="hidden" name="notifID"
                                                value="<?php echo  htmlentities($result->notifID);?>">
                                        </div>
                                        <a class="text-center" href="mechTransaction.php"><i
                                                class="fa-solid fa-eye"></i> visit</a>
                                    </button>

                                </li>

                                <?php }}}}} ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./mechChat.php"><i class="fa-regular fa-comment"></i> Messages</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link fa-solid fa-caret-down" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item fa-thin fa-gear" href="#"> Settings</a></li>
                                <li><a class="dropdown-item fa-thin fa-right-from-bracket"
                                        onclick="myconfirm()">
                                        Logout</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </form>
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
</script>