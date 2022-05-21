<!-- <div class="bottom-nav">
            <div class="vehicle-logo">
                <a href="userMessage.php"><img src="../img/message.png" alt=""></a>
            </div>
            <div class="home-logo">
                <a href="userDashboard.php"><img src="../img/house-black-silhouette-without-door.png" alt=""></a>
            </div>
            <div class="mech-logo">
                <a href="mechanicPage.php"><img src="../img/mechtool.png" alt=""></a>
            </div>
        </div>  -->
<section class="botsec">
    <div class="bot-nav">
        <a href="./mechActivityLog.php" class="nav-links">
            <i class="fa-solid fa-clock-rotate-left position-relative">
                <span id="hide" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
                    <?php 
                        $mechID1=$_SESSION['mechID'];
						$sql3 ="SELECT * from request where mechID=$mechID1 and status='Accepted'";
						$query3 = $dbh -> prepare($sql3);
						$query3->execute();
						$results3=$query3->fetchAll(PDO::FETCH_OBJ);
						$reqAccepted=$query3->rowCount();
                        if($reqAccepted == 0){
                            echo "<script type='text/javascript'>document.getElementById('hidess123').style.display = 'none';
                                </script>";
                        }
						?>
                    <?php echo htmlentities($reqAccepted);?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </i>
            <span>Activity Log</span>
        </a>
        <a href="./voDashboard.php" class="nav-links">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="./mechTransaction.php" class="nav-links">
            <i class="fa-solid fa-handshake-simple position-relative">
            <span id="hide1" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
            <?php 
                $mechID1=$_SESSION['mechID'];
				$sql01 ="SELECT * from request where mechID=$mechID1 and status='Complete' ";
				$query04 = $dbh -> prepare($sql01);
				$query04->execute();
				$results4=$query04->fetchAll(PDO::FETCH_OBJ);
				$reqComplete=$query04->rowCount();
                if($reqComplete == 0){
                    echo "<script type='text/javascript'>document.getElementById('hide10').style.display = 'none';</script>";
                }
			?>
            <?php echo htmlentities($reqComplete);?>
            <span class="visually-hidden">unread messages</span>
            </span>
        </i>
        <span>transaction history</span>
        </a>
    </div>
</section>