
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
<!-- <section>
        <div class="row sticky-bottom text-dark bg-white justify-content-evenly">
            <div class="col-4">
                <i class="fa-solid fa-shop"></i>
                <p>Find Mechanic Shops</p>
            </div>
            <div class="col-4">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <p>Activity Log</p>
            </div>
            <div class="col-4">
                <i class="fa-solid fa-handshake-simple"></i>
                <p>transaction history</p>
            </div>
        </div>
</section> -->
<!-- <section id="nav-bar" class="shadow-lg"  style="border-radius: 16px 16px 0px 0px; background: #302D32; bottom: 0; position: fixed; height: 55px; ">
    <nav class="">
        <div class="container">
            <div class="row justify-content-around text-center">
                <div class="col-4 p-3"><i class="fa-solid fa-shop"></i></div>
                <div class="col-4 p-3"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <div class="col-4 p-3"><i class="fa-solid fa-handshake-simple"></i></div>
            </div>
        </div>
    </nav>
</section> -->
<section class="botsec">
    <div class="bot-nav">
        <a href="./vomapShops.php" class="nav-links">
            <i class="fa-solid fa-shop"></i>
            <span>Mechanic Shops</span>
        </a>
        <a href="./voActivityLog.php" class="nav-links">
            <i class="fa-solid fa-clock-rotate-left position-relative">
                <span id="hide" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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
            <i class="fa-solid fa-handshake-simple"></i>
            <span>transaction history</span>
        </a>
    </div>
</section>