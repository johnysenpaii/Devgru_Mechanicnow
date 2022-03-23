<?php
session_start();
include('config.php');

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
    <link rel="stylesheet" href="css/main.min.css">
    <!-- custom css -->
   
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100 flex-column flex-md-row">
            <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark ">
                <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-items-start py-2 text-start sticky-top "
                    id="sidebar">
                    <div class="text-start p-3">
                        <a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap"><img
                                src="img/mechanicnowlogo.svg" class="logo" alt="" width="60"> Mechanic now</a>
                    </div>
                    <button type="button" class="navbar-toggler border-0 order-1" data-toggle="collapse"
                        data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-last" id="nav">
                        <ul class="navbar-nav flex-column w-100 ml-2 justify-content-start">
                            <li class="nav-item">
                                <a href="adminSide.php" class="nav-link active"><i class="bi bi-speedometer"></i>
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
                                    <li><a href="userAdmin.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-person-circle"></i> Clients</a></li>
                                    <li><a href="mechAdmin.php" class="dropdown-item pl-4 p-2"><i
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
                                                class="bi bi-person-circle"></i> Clients</a></li>
                                    <li><a href="mechfeedbacks.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-tools"></i> Mechanics</a></li>
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a href="Report.php" class="nav-link"><i class="bi bi-list-columns"></i> Reports</a>
                            </li>
                            <br>
                            <hr class="text-light w-100 p-0 m-0">
                            <li class="nav-item w-100">
                                <a onclick="myconfirm()" class="nav-link text-danger"><i class="bi bi-door-closed"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </aside>
            <main class="col flex-grow-1">
                <div class="container py-2">
                    <div class="row d-flex justify-content-">
                        <div class="col h5">Dashboard</div>
                        <div class="col-1 h5 text-center text-dark">
                        
                            <i class="bi bi-bell-fill"></i>
                          </div>
                        <hr class="text-dark">
                    </div>
                </div>

                <div class="row g-3 d-flex justify-content-center " data-aos="fade-up">
                    <div class="col-lg-2 col-md-12 col-sm-12  ">
                        <div class="card m-0 shadow border border-primary h-100 ">
                            <div class="card-body">
                                <h6 class="card-title text-muted"><i class="bi bi-person-circle"></i>
                                    Vehicle
                                    Owner</h6>
                                <?php 
											$sql3 ="SELECT custID from customer";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$userlist=$query3->rowCount();
										?>
                                <p class="card-text display-6 float-right">
                                    <?php echo htmlentities($userlist);?>
                                </p>
                            </div>
                            <a href="userAdmin.php" class="btn btn-primary bnt-lg m-1">Check</a>

                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12  ">
                        <div class="card m-0 shadow border border-primary h-100">
                            <div class="card-body">
                                <h6 class="card-title text-muted"><i class="bi bi-tools"></i> Mechanics</h6>
                                <?php 
											$sql3 ="SELECT mechID from mechanic where status ='approve' ";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$mechlist=$query3->rowCount();
										?>
                                <p class="card-text display-6 float-right">
                                    <?php echo htmlentities($mechlist);?>
                                </p>
                            </div>
                            <a href="mechAdmin.php" class="btn btn-primary bnt-lg m-1">Check</a>

                        </div>
                    </div>

                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <div class="card m-0 shadow border border-primary h-100 position-relative">
                            <span id="hide"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                <?php 
											$sql3 ="SELECT mechID from mechanic where status ='pending' ";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$newlist=$query3->rowCount();
                                            if($newlist == 0){
                                                echo "<script type='text/javascript'>document.getElementById('hide').style.display = 'none';
                                                </script>";

                                            }
										?>
                                <?php echo htmlentities($newlist);?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <div class="card-body">
                                <h6 class="card-title text-muted"><i class="bi bi-person-plus-fill"></i>
                                    Pending
                                    Mechanic</h6>
                                <p class="card-text display-6 float-right">
                                    <?php echo htmlentities($newlist);?>
                                </p>
                            </div>
                            <a href="pending.php" class="btn btn-primary bnt-lg m-1">Check</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <div class="card m-0 shadow border border-primary h-100 position-relative">
                            <span id="mhide"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php 
											$sql3 ="SELECT mechID from mechanic where status ='banned' ";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$ban1=$query3->rowCount();
                                            if($ban1 == 0){
                                                echo "<script type='text/javascript'>document.getElementById('mhide').style.display = 'none';
                                                </script>";

                                            }
										?>
                                <?php echo htmlentities($ban1);?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <div class="card-body">
                                <h6 class="card-title text-muted"><i class="bi bi-exclamation-circle-fill"></i>
                                    Banned Mechanic</h6>
                                <p class="card-text display-6 float-right"><?php echo htmlentities($ban1);?>
                                </p>
                            </div>
                            <a href="banlist.php" class="btn btn-primary bnt-lg m-1">Check</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <div class="card m-0 shadow border border-primary h-100 position-relative">
                            <span id="hide3"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php 
											$sql3 ="SELECT custID from customer where ban ='banned' ";
											$query3 = $dbh -> prepare($sql3);
											$query3->execute();
											$results3=$query3->fetchAll(PDO::FETCH_OBJ);
											$userban=$query3->rowCount();
                                            if($userban == 0){
                                                echo "<script type='text/javascript'>document.getElementById('hide3').style.display = 'none';
                                                </script>";

                                            }
										?>
                                <?php echo htmlentities($userban);?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            <div class="card-body">
                                <h6 class="card-title text-muted"><i class="bi bi-exclamation-circle-fill"></i>
                                    Banned Customer</h6>
                                <p class="card-text display-6 float-right">
                                    <?php echo htmlentities($userban);?>
                                </p>
                            </div>
                            <a href="userbanlist.php" class="btn btn-primary bnt-lg m-1">Check</a>
                        </div>
                    </div>

                </div>
                <div class="line-chart-filled"></div>
        </div>
        </main>
    </div>
    </div>
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
            location.replace("adminLogin.php")
        } else {
            location.reload();
        }
        new Chartist.Line('.line-chart-filled', {
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
        }, {
            low: 0,
            showArea: true
        });
    }
    </script>
    <script src="@@path/vendor/chartist/dist/chartist.min.js"></script>
    <script src="@@path/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <?php include('footer.php');?>
</body>

</html>