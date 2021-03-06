<?php
session_start();
include('../config.php');
$regeditid=intval($_GET['regeditid']);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
        integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
    <!-- custom css -->
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100 flex-column flex-md-row">
            <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark ">
                <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-items-start py-2 text-start sticky-top "
                    id="sidebar">
                    <div class="text-start p-1">
                        <a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap"><img
                                src="../img/mechanicnowlogo.svg" class="logo" alt="" width="60"> Mechanic now</a>
                    </div>
                    <button type="button" class="navbar-toggler border-0 order-1" data-toggle="collapse"
                        data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-last" id="nav">
                        <ul class="navbar-nav flex-column w-100 ml-2 justify-content-start">
                            <li class="nav-item">
                                <a href="adminSide.php" class="nav-link"><i class="bi bi-speedometer"></i>
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
                                <a href="#" class="nav-link dropdown-toggle active" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-expanded="false"><i class="bi bi-star-fill"></i>
                                    Feedbacks</a>
                                    <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                                    <li><a href="feedbacks.php" class="dropdown-item pl-4 p-2 active"><i
                                                class="bi bi-tools"></i> Mechanics</a></li>
                                   
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a href="Report.php" class="nav-link"><i class="bi bi-list-columns"></i> Reports</a>
                            </li>
                            <br>
                            <hr class="text-light m-1">
                            <li class="nav-item w-100">
                                <a onclick="myconfirm()" hre="#" class="nav-link text-danger"><i class="bi bi-door-closed"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <main class="col-10 px-0 flex-grow-1 text-dark">
                <div class="container py-3">
                <section class="my-container">
                        <div class="display-6 my-2">Feedbacks and Ratings</div>
                        <hr class="text-dark m-2">
                        <form method="POST">
                            <?php
                                    $sql21 = "SELECT mechID,AVG(ratePercentage) as total from ratingandfeedback where mechID = $regeditid";
                                    $query1=$dbh->prepare($sql21);
                                    $query1->execute();
                                    $results1=$query1->fetchALL(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query1->rowCount()>0) {
                                        foreach ($results1 as $result1)
                                {?>
                                <h5 class="py-2">Average Ratings: <?php echo number_format($result1->total,1);?> <span class="bi bi-star-fill"></h5>
                            <?php }}?>
                            <div class="scroll-feedbacks col-12 col-md-12">
                                <?php
                                    $sql2 = "SELECT * from ratingandfeedback where mechID =  '$regeditid' order by mechID DESC";
                                    $query=$dbh->prepare($sql2);
                                    $query->execute();
                                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount()>0) {
                                        foreach ($results as $result)
                                {?>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="py-1">
                                            <div class="card">
                                                <h5 class="card-header d-flex justify-content-between"> <?php echo htmlentities($result->mechName);?> <span class="fw-bold" style="font-size: 17px;"> <?php echo htmlentities($result->ratePercentage);?>.0 <i class="bi bi-star-fill"> </i>rating</span>  </h5>
                                                <div class="card-body">
                                                <p class="card-text" style="font-size: 15px; font-weight:bolder;">feedback:</p>
                                                    <p class="card-text"><?php echo htmlentities($result->feedback);?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }}else{?>
                                    <div class="emptyrequest mt-1 pt-4" >
                                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                            <h6>Theres no feedbacks or ratings.</h6>
                                        </div>
                                <?php }

                                
                                ?>
                            </div>
                          
                        </form>
                    </section>
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
            location.replace('../login.php')
        } else {
            location.reload();
        }
    }

    //for circular progress bar
    let progressBar = document.getElementById("circular-progress");
    let valueContainer = document.querySelector(".value-container");
    let dynamicValue = document.getElementById("output").value;

    let progressValue = 0;
    let progressEndValue = progressValue;
    let speed = 10;

    let progress = setInterval(() => {
        valueContainer.textContent = `${progressValue}%`;
        progressBar.style.background = `conic-gradient(
            #9132da ${progressValue * 3.6}deg, 
            #b68bd6 ${progressValue * 3.6}deg
        )`;
        if (progressValue == dynamicValue) {
            clearInterval(progress);
        }
        progressValue++;
    }, speed);
    </script>
    <?php include('footer.php');?>
</body>

</html>