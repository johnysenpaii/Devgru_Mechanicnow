<section class="botsec">
    <div class="bot-nav">
        <a href="./voDashboard.php" class="nav-links">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="./vomapShops.php" class="nav-links">
            <i class="fa-solid fa-shop"></i>
            <span>Mechanic Shops</span>
        </a>
        <a href="./voActivityLog.php" class="nav-links">
            <i class="fa-solid fa-clock-rotate-left position-relative">
                <span id="hide" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
                    <?php 
                        $custID1=$_SESSION['custID'];
						$sql3 ="SELECT * from request where custID=$custID1 and status='Accepted' || status='verify'  ";
						$query3 = $dbh -> prepare($sql3);
						$query3->execute();
						$results3=$query3->fetchAll(PDO::FETCH_OBJ);
						$reqAccepted=$query3->rowCount();
                        if($reqAccepted == 0){
                            echo "<script type='text/javascript'>document.getElementById('hide').style.display = 'none';
                                </script>";
                        }
						?>
                    <?php echo htmlentities($reqAccepted);?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </i>
            <span>Activity Log</span>
        </a>
        <a href="./voTransaction.php" class="nav-links">
            <i class="fa-solid fa-handshake-simple position-relative">
            <span id="hide1" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">
            <?php 
                $custID=$_SESSION['custID'];
				$sql3 ="SELECT * from request where custID=$custID and status='Complete' ";
				$query4 = $dbh -> prepare($sql3);
				$query4->execute();
				$results4=$query4->fetchAll(PDO::FETCH_OBJ);
				$reqComplete=$query4->rowCount();
                if($reqComplete == 0){
                    echo "<script type='text/javascript'>document.getElementById('hide1').style.display = 'none';</script>";
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