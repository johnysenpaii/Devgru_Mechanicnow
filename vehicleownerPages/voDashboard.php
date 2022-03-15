<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body id="contbody" style="background-color: #f8f8f8">
    <?php include('./voHeader.php');?>
    <?php include('./voTopnav.php');?>
    <section id="serviceOptions" class="container-fluid container-md py-3 pb-5 mb-5">
        <div class="row gx-5 row-ari">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-8 col-md-12 col-lg-10 bg-white text-dark p-3 rounded-3 offset-sm-4 offset-md-0 offset-lg-2">
                        <h4 class="line-segment">Choose what type of service do you want</h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4 py-3">
                            <div class="col">
                                <div class="card h-100">
                                <img src="../img/car.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Car</h5>
                                    <p class="card-text">Car Repair and Services.</p>
                                    <div class="text-center"><a class="btn btn-primary px-5 rounded-pill my-2" href="./voCarmech.php" role="button">Select</a></div>
                                </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="../img/moto.svg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Motorcycle</h5>
                                        <p class="card-text">Motorcycle Repair and Services.</p>
                                        <div class="text-center"><a class="btn btn-primary px-5 rounded-pill my-2" href="#" role="button">Select</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                <img src="../img/bicycle.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bicycle</h5>
                                    <p class="card-text">Bicycle Repair and Services.</p>
                                    <div class="text-center"><a class="btn btn-primary px-5 rounded-pill my-2" href="#" role="button">Select</a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 bg-white text-dark rounded-3 cont-act">
                <div class="act-content">
                    <h5 class="py-2 pb-2 text-center">Recent Activities</h5>
                    <p></p>
                </div>
            </div>
            
        </div>
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>