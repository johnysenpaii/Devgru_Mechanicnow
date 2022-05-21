 <section id="nav-top" class="d-none d-md-block top-navigation container-fluid">
        <div class="row">
            <div class="d-flex justify-content-center pt-3">
                <a href="mechActivityLog.php" class="position-relative py-1 px-5 mx-1 bg-white text-dark rounded-pill btn">
                <span id="hidess123" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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
                Activity Log</a>
                <a href="mechTransaction.php" class="py-1 px-5 mx-1 bg-white text-dark rounded-pill btn position-relative">
                <span id="hide10" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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
                    <span class="visually-hidden"> unread messages</span></span>
                Transaction History</a>
            </div>
        </div>
    </section>