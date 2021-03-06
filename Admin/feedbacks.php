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
                        <div class="display-6 my-2">Mechanics</div>
                        <hr class="text-dark m-2">
                        <form method="POST">
                            <?php
                                            
                                            $search_keyword = '';
                                            if(!empty($_POST['search']['keyword'])) {
                                                $search_keyword = $_POST['search']['keyword'];
                                            }
											$sql = "SELECT * from mechanic WHERE status='approve' and username LIKE :keyword order by mechID ";
											$query=$dbh->prepare($sql);
                                            $query->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
											$query->execute();
											$results=$query->fetchALL(PDO::FETCH_OBJ);
											$cnt=1;?>
                            <div class="col-lg-4 col-md-4">
                                <div class="input-group my-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" id="keyword" name="search[keyword]" value="<?php echo $search_keyword; ?>" placeholder="Search"aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" data-aos="fade-up"  data-aos-duration="500">
                                <div class="card">
                                    <h5 class="card-header">Mechanic List</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <div class="scroll-feedbacks sf-1">
                                                <table class="table tb-1">
                                                    <thead class="bg-light">
                                                        <tr class="border-0" style="font-size: 12px">
                                                            <th class="border-0 Phead">First Name</th>
                                                            <th class="border-0 Phead">Last Name</th>
                                                            <th class="border-0 Phead">Email</th>
                                                            <th class="border-0 Phead">Contact Number</th>
                                                            <th class="border-0 Phead">Username</th>
                                                            <th class="border-0 Phead">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                         if($query->rowCount()>0){
                                                         foreach ($results as $result) {
                                                       ?>
                                                        <tr style="font-size: 12px">
                                                            <td><?php echo htmlentities($result->mechFirstname);?></td>
                                                            <td><?php echo htmlentities($result->mechLastname);?></td>
                                                            <td><?php echo htmlentities($result->mechEmail);?></td>
                                                            <td><?php echo htmlentities($result->mechCnumber);?></td>
                                                            <td><?php echo htmlentities($result->Username);?></td>
                                                            <td><a class="btn btn-secondary" href="ratings-section.php?regeditid=<?php echo htmlentities($result->mechID)?>"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Take Action"><i class="bi bi-folder-check" style="font-size: 12px;"></i></a>
                                                            </td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                    <?php }}?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- <div class="container py-3">
                <section class="my-container">
                        <div class="display-6 my-2">Feedbacks and Ratings</div>
                        <hr class="text-dark m-2">
                        <form method="GET">
                            <div class="input-group-search">
                                <input type="text" name="searchs" size="50" placeholder="Please search full name" class="search-input">
                                <button type="submit" name="sea" class="s-btn">Search</button>
                            </div>
                        </form> -->

                        <!-- <form method="POST">
                            <div class="scroll-feedbacks">
                                <?php
                                    $searchcont = $_GET['searchs'] ?? null;
                                    $sql2 = "SELECT * from ratingandfeedback where mechName like '%{$searchcont}%'";
                                    if(isset($_GET['sea'])){
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
                                            <h6>Theres no feedbacks or ratings related by <?php echo $_GET['searchs']?>.</h6>
                                        </div>
                                <?php }

                                }else if(isset($_GET['searchs']) == ""){
                                    $sql = "SELECT * from ratingandfeedback";
                                    $query=$dbh->prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount()>0) {
                                        foreach ($results as $result){
                                    ?>
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
                                     <?php }}}else{?>
                                         <div class="emptyrequest mt-1 pt-4" >
                                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                                            <h6>No mechanic nearby. . .</h6>
                                        </div>
                                    <?php }?>
                            </div>  
                        </form> -->
                    <!-- </section>
                </div> -->
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
    </script>
    <?php include('footer.php');?>
</body>

</html>