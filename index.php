<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="img/mechanicnowlogo.svg">
</head>
<body>
    <!-- navbar -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light container-fluid">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="img/navlogo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="#">How it works</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About us</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./login.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link nav-cursor" data-bs-toggle="modal" data-bs-target="#reg-modal">Sign up</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </section>
    <!-- banner section -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="banner-text">Mechanic Now</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas impedit vero asperiores numquam dolorem consequuntur dolorum aperiam, porro enim dolor excepturi quasi aliquid! Aperiam, veniam?</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="img/mnrevisedlogo864-nooutline.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <img src="img/bottompng.png" class="bottom-img" alt="">
    </section>
    <!-- Vertically centered modal -->
    <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Choose Account type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2 justify-content-around">
                    <a href="./vehicleownerPages/vehicleOwnerSignup.php" class="col-sm-5 text-center ms1">
                        <i class="fa-solid fa-car"></i>
                        <p>Vehicle Owner</p>
                    </a>
                    <a href="./mechanicPages/mechanicSignup.php" class="col-sm-5 text-center">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <p>Mechanic</p>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <p>Do you have an account? <a href="login.php">Login</a></p>
            </div>
            </div>
        </div>
    </div>
    <!-- services section -->
    <section id="services">
        <div class="container">
            <div class="center">
                <h3>Services</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>

    </section>

    <!-- footer section -->
    <section id="footer">
        <!-- <img src="img/bottompng.png" class="bottomm-img2" alt=""> -->

    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>