<?php
session_start();
include('../config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
    <!-- custom css -->
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100 flex-column flex-md-row">
            <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark ">
                <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-items-start py-2 text-start sticky-top "
                    id="sidebar">
                    <div class="text-start p-3">
                        <a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap"><img
                                src="img/mechanicnowlogo.svg" class="logo" alt="" width="50"> Mechanic now</a>
                    </div>
                    <button type="button" class="navbar-toggler border-0 order-1" data-toggle="collapse"
                        data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-last" id="nav">
                        <ul class="navbar-nav flex-column w-100 ml-2 justify-content-start">
                            <li class="nav-item">
                                <a href="adminSide.php" class="nav-link "><i class="bi bi-speedometer"></i>
                                    Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="pending.php" class="nav-link"><i class="bi bi-person-lines-fill"></i> Mechanic
                                    Approvals</a>
                            </li>
                            <li class="nav-item dropdown w-100">
                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-check-fill"></i>
                                    Monitor</a>
                                <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                                    <li><a href="userAdmin.php" class="dropdown-item pl-4 p-2 "><i
                                                class="bi bi-person-circle"></i> Clients</a></li>
                                    <li><a href="mechAdmin.php" class="dropdown-item pl-4 p-2 "><i
                                                class="bi bi-tools"></i> Mechanics</a></li>
                                    <li><a href="banlist.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-exclamation-circle-fill"></i> Banned Mechanics</a></li>
                                    <li><a href="userbanlist.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-exclamation-circle-fill"></i> Banned Clients</a></li>

                                </ul>
                            </li>
                            <li class="nav-item dropdown w-100">
                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-expanded="false"><i class="bi bi-star-fill"></i>
                                    Feedbacks</a>
                                <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                                <li><a href="feedbacks.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-tools"></i> Mechanics</a></li>
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a href="Report.php" class="nav-link active"><i class="bi bi-list-columns"></i>
                                    Reports</a>
                            </li>
                            <br>
                            <hr class="text-light m-1">
                            <li class="nav-item w-100">
                                <a onclick="myconfirm()" href="#" class="nav-link text-danger"><i
                                        class="bi bi-door-closed"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <main class="col px-0 flex-grow-1">
                <div class="container py-3">
                    <section class="my-container">
                        <div class="display-4 my-2">Reports</div>
                        <hr class="text-dark m-2">
                        <div class="row g-3 d-flex justify-content-center ">
                            <div class="col-lg-10 col-md-12 col-sm-12 " data-aos="zoom-in"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                <div class="card p-0 overflow-auto" style="height: 500px;">
                                    <ol class="list-group border-bottom-0">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-start bg-info">
                                            <div class="fw-bold">Transaction completed</div>
                                            <?php 
											$sql3 ="SELECT resID from request where status='Complete'";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$totalComplete=$query3->rowCount();
										?>
                                            <a href="pdfFile.php" class="fw-bold"> <i class="bi bi-file-earmark-pdf-fill"></i>
                                                <?php echo htmlentities($totalComplete);?></a>
                                        </li>
                                    </ol>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Reservation ID</th>
                                                    <th scope="col">Mechanic name</th>
                                                    <th scope="col">Vehicle owner</th>
                                                    <th scope="col">Service needed</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                            $sql="SELECT *from request where status='Complete' ";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount()>0){
                                                foreach($results as $result){
                                            ?>

                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlentities($result->resID);?></td>
                                                    <td><?php echo htmlentities($result->mechName);?></td>
                                                    <td><?php echo htmlentities($result->vOwnerName);?></td>
                                                    <td><?php echo htmlentities($result->serviceNeeded);?></td>
                                                    <td><?php echo htmlentities($result->Sdate);?></td>
                                                    <td><?php echo htmlentities($result->Edate);?></td>
                                                </tr>
                                            </tbody>
                                            <?php $cnt=$cnt+1;}}?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 " data-aos="zoom-in"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                <div class="card p-0 overflow-auto" style="height: 500px;">
                                    <ol class="list-group border-bottom-0">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-start bg-info">
                                            <div class="fw-bold">Decline or cancelled</div>
                                            <?php 
											$sql312 ="SELECT resID from request where status='Decline' || status='cancelled'";
											$query312 = $dbh -> prepare($sql312);
											$query312->execute();
											$results312=$query312->fetchAll(PDO::FETCH_OBJ);
											$totalDC=$query312->rowCount();
										?>
                                            <a href="cancelledpdf.php" class="fw-bold"> <i class="bi bi-file-earmark-pdf-fill"></i>
                                                <?php echo htmlentities($totalDC);?></a>
                                        </li>
                                    </ol>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Service needed</th>
                                                    <th scope="col">Type of service</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                            $sql43="SELECT *from request where status";
                                            $query43 = $dbh->prepare($sql43);
                                            $query->execute();
                                            $results=$query43->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query43->rowCount()>0){
                                                foreach($results as $result43){
                                                    if($result43-> status="cancelled"){
                                            ?>

                                            <tbody>
                                                <tr class="alert alert-danger">
                                                
                                                    <td><?php echo htmlentities($result43->vOwnerName);?></td>
                                                    <td><?php echo htmlentities($result43->serviceNeeded);?></td>
                                                    <td><?php echo htmlentities($result43->serviceType);?></td>
                                                    <td><?php echo htmlentities($result43->status);?></td>
                                                </tr>
                                            </tbody>
                                            <?php } else if($result43-> status="Decline"){?>
                                                <tbody>
                                                <tr class="alert alert-warning">
                                                    <td><?php echo htmlentities($result43->mechName);?></td>
                                                    <td><?php echo htmlentities($result43->serviceNeeded);?></td>
                                                    <td><?php echo htmlentities($result43->serviceType);?></td>
                                                    <td><?php echo htmlentities($result43->status);?></td>
                                                </tr>
                                            </tbody>

                                        <?php }}} $cnt=$cnt+1;?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 " data-aos="fade-right"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                <div class="card p-0 overflow-auto" style="height: 500px;">
                                    <ol class="list-group border-bottom-0">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-start bg-info">
                                            <div class="fw-bold">Mechanic registered with ratings</div>
                                            <?php 
											$sql3 ="SELECT mechID from mechanic  where status='approve'";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$totalmech=$query3->rowCount();
										?>
                                            <a href="Mechanicpdf.php" class="fw-bold"> <i class="bi bi-file-earmark-pdf-fill"></i>
                                                <?php echo htmlentities($totalmech);?></a>
                                        </li>
                                    </ol>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Profile image</th>
                                                    <th scope="col">Firstname</th>
                                                    <th scope="col">Lastname</th>
                                                    <th scope="col">Email address</th>
                                                    <th scope="col">Contact number</th>
                                                    <th scope="col">Ratings</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                            $sql="SELECT *from mechanic where status='approve'";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount()>0){
                                                foreach($results as $result1){
                                            ?>

                                            <tbody>
                                                <tr>
                                                    <td><img src="../uploads/<?=$result1->profile_url ?>"
                                                            onerror="this.src='../img/mech.jpg';"
                                                            class="img-fluid rounded-pill w-50 h-50"></td>
                                                    <td><?php echo htmlentities($result1->mechFirstname);?></td>
                                                    <td><?php echo htmlentities($result1->mechLastname);?></td>
                                                    <td><?php echo htmlentities($result1->mechEmail);?></td>
                                                    <td><?php echo htmlentities($result1->mechCnumber);?></td>
                                                    <td><?php echo htmlentities($result1->average);?></td>
                                                </tr>
                                            </tbody>
                                            <?php $cnt=$cnt+1;}}?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 " data-aos="fade-left"
                                data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                <div class="card p-0 overflow-auto" style="height: 500px;">
                                    <ol class="list-group border-bottom-0">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-start bg-info">
                                            <div class="fw-bold">Vehicle owner registered</div>
                                            <?php 
											$sql31 ="SELECT custID from customer";
											$query31 = $dbh -> prepare($sql31);
											$query31->execute();
											$results31=$query31->fetchAll(PDO::FETCH_OBJ);
											$totalcust=$query31->rowCount();
										?>
                                            <a href="customerpdf.php" class="fw-bold"> <i class="bi bi-file-earmark-pdf-fill"></i>  <?php echo htmlentities($totalcust);?></a>
                                        </li>
                                    </ol>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">Profile image</th>
                                                    <th scope="col">Firstname</th>
                                                    <th scope="col">Lastname</th>
                                                    <th scope="col">Email address</th>
                                                    <th scope="col">Contact number</th>
                                                </tr>
                                            </thead>
                                            <?php  
                                            $sql="SELECT *from customer";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount()>0){
                                                foreach($results as $result12){
                                            ?>
                                            <tbody>
                                                <tr>
                                                <td><img src="../uploads/<?=$result12->profile_url ?>"
                                                            onerror="this.src='../img/mech.jpg';"
                                                            class="img-fluid rounded-pill w-50 h-50"></td>
                                                    <td><?php echo htmlentities($result12->custFirstname);?></td>
                                                    <td><?php echo htmlentities($result12->custLastname);?></td>
                                                    <td><?php echo htmlentities($result12->custEmail);?></td>
                                                    <td><?php echo htmlentities($result12->custCnumber);?></td>
                                                </tr>
                                            </tbody>
                                            <?php $cnt=$cnt+1;}}?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

        </div>
    </div>
    </main>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"
        integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous">
    </script>
    <!-- custom js -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 3000,
        once: true,
    });
    </script>
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
    <?php include('footer.php');?>
</body>

</html>