<section id="nav-top" class="d-none d-md-block top-navigation container-fluid">
    <div class="row">
        <!-- d-flex justify-content-evenly -->
        <div class="d-flex justify-content-center pt-3">
            <a href="voDashboard.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn position-relative shadow-sm">Home</a>
            <a href="vomapShops.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn position-relative shadow-sm">Find Mechanic Shops</a>
            <a href="voActivityLog.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn position-relative shadow-sm">
                <span id="hide" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                    <?php 
                        $custID1=$_SESSION['custID'];
						$sql3 ="SELECT * from request where custID=$custID1 and status='Accepted' || status='verify'";
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
                Activity Log</a>
            <a href="voTransaction.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn position-relative shadow-sm">
                <span id="hide1" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                    <?php 
                        $custID=$_SESSION['custID'];
						$sql3 ="SELECT * from request where custID=$custID and status='Complete' and historyStatus = 'Unread'";
						$query4 = $dbh -> prepare($sql3);
						$query4->execute();
						$results4=$query4->fetchAll(PDO::FETCH_OBJ);
						$reqComplete=$query4->rowCount();
                        if($reqComplete == 0){
                            echo "<script type='text/javascript'>document.getElementById('hide1').style.display = 'none';</script>";
                        }
						?>
                    <?php echo htmlentities($reqComplete);?>
                <span class="visually-hidden"> unread messages</span></span> Transaction History</a>
        </div>
    </div>
</section>