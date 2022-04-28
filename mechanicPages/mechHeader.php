<style>
<?php include '../css/style.css';
if(isset($_POST["readAll"])){
    $sql1="UPDATE notification set notifStatus='Read' WHERE notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql1);
    $query->execute();
    }
    if(isset($_POST["unreadRequest"])){
        $notifID = $_POST['notifID'];
        $sql1="UPDATE notification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql1);
        $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
        $query->execute();
    }
    if(isset($_POST["unreadComplete"])){
        $notifID = $_POST['notifID'];
        $sql1="UPDATE notification set notifStatus='Read' WHERE notifID=:notifID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query=$dbh->prepare($sql1);
        $query->bindParam(':notifID',$notifID,PDO::PARAM_STR);
        $query->execute();
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
                        <li class="nav-item">
                            <a class="nav-link" href="./mechProfile.php"><i class="fa-regular fa-user"></i>
                                <?php echo htmlentities($_SESSION["mechFirstname"]); ?></a>
                        </li>


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
                        $sql101="SELECT *, DATE_FORMAT(time, '%b/%d/%Y %H:%i %p') as timess from notification WHERE mechID = $mechID  order by notifID desc";
                        $query101=$dbh->prepare($sql101);
                        $query101->execute();
                        $results=$query101->fetchALL(PDO::FETCH_OBJ);
                        ?>
                            <ul class="dropdown-menu p-0 notif-class"
                                style="font-size: small; width: 340px; max-height: 60vh; overflow-y: auto;"
                                aria-labelledby="navbarDropdownMenuLink">
                                <li class="notif-content alert-primary row g-0 text-center sticky-top p-0">
                                <button type="submit" class="rounded alert-primary border-0 fw-bold py-1" name="readAll">Mark all as read</button>
                            </li>
                                <?php  
                         
                        if($query101->rowCount()>0){
                            foreach ($results as $result){
                                if($result -> mechID == $mechID){                                   
                                     if($result->status == 'Unaccepted'){
                                        if($result->notifStatus == 'Unread'){

                                    ?>
                           
                                <li>  
                                <button  type="submit" name="unreadRequest" class="alert-success notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 text-end" style="font-size: 30px;">
                                <i class="fa-solid fa-face-smile-beam"></i>
                                </div>
                                <div class="col-md-10 py-3 text-start fw-bold">
                                Hey! <?php echo htmlentities($_SESSION['mechFirstname']);?> you have a new
                                            request.
                                        <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                            </button>

                            </li>
                            
                            <?php } else{ ?>
                                

                                <li>  
                                <button  type="submit" name="" class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 text-end" style="font-size: 30px;">
                                <i class="fa-solid fa-face-smile-beam"></i>
                                </div>
                                <div class="col-md-10 py-3 text-start fw-light">
                                Hey! <?php echo htmlentities($_SESSION['mechFirstname']);?> you have a new
                                            request.
                                        <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                            </button>

                            </li>
                                <?php }
                            }  else if($result->status == 'Complete' ){ if($result->notifStatus == 'Unread'){?>
                                    
                                    <li>  
                                <button  type="submit" name="unreadComplete" class="alert-success notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 py-3 text-end" style="font-size: 30px;">
                                </i> <i class="fa-solid fa-face-smile-beam"></i>
                                </div>
                                <div class="col-md-10 py-3 text-start fw-bold">
                                Good job!! You completed your request today.
                                            request.
                                        <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
                            </button>

                            </li>
                            
                               

                                <?php } else {?>
                                    <li>  
                                <button  type="submit" name="" class="alert-primary notif-content row text-center border-0 w-100 mx-0">
                                <p class="text-end text-small fw-light" style="font-size: smaller;"><?php echo htmlentities($result->timess)?></p>
                                <div class="col-md-2 p-1 py-3 text-end" style="font-size: 30px;">
                                </i> <i class="fa-solid fa-face-smile-beam"></i>
                                </div>
                                <div class="col-md-10 py-3 text-start fw-light">
                                Good job!! You completed your request today.
                                            request.
                                        <input type="hidden" name="notifID" value="<?php echo  htmlentities($result->notifID);?>">
                                </div>
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
                                <li><a class="dropdown-item fa-thin fa-right-from-bracket" href="#"
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

