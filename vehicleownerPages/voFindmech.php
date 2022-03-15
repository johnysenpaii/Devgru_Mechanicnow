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
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section id="mechContent" class="mech-content container-fluid">
        <div class="emptyrequest" hidden>
            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
            <h6>There is no mechanic nearby..</h6>
        </div>
        <div class="row py-3 text-center table-responsive justify-content-center pb-5">
            <div class="col-lg-8 bg-white py-4 rounded-3 shadow-lg">
                <h4 class="text-dark pb-4">Available Mechanics</h4>
                <div class="row d-flex justify-content-end align-items-center">                   
                    <div class="col-9 col-md-6 searchlogo">
                        <input class="form-control rounded-pill" type="text" placeholder="Filter Search">
                    </div>
                    <div class="col-3 col-md-1 searchlogo justify-content-center align-items-center">
                        <i class="fa-solid fa-filter fa-2x" data-bs-toggle="modal" data-bs-target="#Filter-modal"></i>
                    </div>
                </div>
                <table class="table table-borderless table-curved pt-1">
                    <thead>
                    </thead>
                    <tbody>
                        <tr class="d-flex align-items-center justify-content-around mt-2">
                            <td>Mark</td>
                            <td>3km away</td>
                            <td><a href="" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#detail-modal">Details</a></td>
                        </tr>
                        <tr class="d-flex align-items-center justify-content-around mt-2">
                            <td>Mark</td>
                            <td>3km away</td>
                            <td><a href="" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#detail-modal">Details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Mechanic Info -->
        <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row line-segment seg">
                        <div class="col-sm-3 with-image"><img src="../img/avatar.jpg" class="rounded-circle imagenajud float-end" alt=""></div>
                        <div class="col-sm-9 d-flex align-items-center">
                            <div class="per-details">
                                <h4>Wailhi Buu</h4>
                                <p>Maribago</p>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-3">
                            <h6>Request Service: </h6>
                            <p>Emergency</p>
                        </div>
                        <div class="col-lg-3">
                            <h6>Vehicle Problem:</h6>
                            <p>Tire Repair, Engine Overheat</p>
                        </div>
                        <div class="col-lg-6">
                            <h6>Note:</h6>
                            <p>Putaena Tibay Bubu, Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, exercitationem.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Accept</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4">Decline</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Filter Search -->
        <div class="modal fade" id="Filter-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Filter Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Tire Mechanic</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Apply Search</button>
                </div>
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