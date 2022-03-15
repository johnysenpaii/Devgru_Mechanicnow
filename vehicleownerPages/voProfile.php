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
    <section id="Profilepage container-fluid">
        <div class="row text-dark mt-4 justify-content-evenly">
            <div class="col-sm-12 col-md-5 col-lg-5 with-image bg-white rounded-3 pb-2 p-3 mr-sm-0 mr-md-1 mb-5 mb-md-0 mb-lg-0 shadow-lg text-center">
                <div class="cont-image text-center">
                    <img src="../img/vo.jpg" class="imagenajud pimage rounded-circle px-5" style="min-width: 20%; max-width: 250px;" alt="">
                </div>
                <div class="row pt-4 text-center">
                    <div class="col-12"><h4>John Jalosjos</h4></div>
                    <div class="col-12">
                        <p hidden><i>No Ratings Yet</i></p>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                    </div>
                </div>
                <p class="pt-3">johnjalosjos06@gmail.com</p>
                <p>0966*******</p>
                <p>Maribago, Lapu-Lapu, City</p>
                <div class="d-grid p-3 pt-5">
                    <button class="btn btn-primary rounded-pill shadow" type="button" class="btn btn-warning px-3" data-bs-toggle="modal" data-bs-target="#edit-modal">Edit Profile</button>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-6 bg-white p-4 ml-sm-0 ml-md-1 mt-sm-1 mt-md-0 shadow-lg rounded-3">
                <div class="row">
                    <p><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, laboriosam aperiam atque perferendis adipisci molestiae praesentium quo blanditiis ab voluptatem, sint rerum earum. Cumque, facere?"</i></p>
                </div>
                <div class="row pt-3">
                    <h5 class="pt-2">Vehicle Types:</h5>
                    <p style="text-indent:5%;">Lorem, ipsum, dolor.</p>
                    <div class="row pt-5">
                        <h6>Feedbacks:</h6>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div>
                        <div class="col-sm-12 col-md-4 pt-3"><i>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere sint quibusdam dignissimos distinctio, quidem culpa!"</i></div> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertically centered modal -->
        <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body form">
                    <form action="">
                        <div class="row line-segment seg">
                            <div class="col-sm-3 with-image"><img src="../img/vo.jpg" class="rounded-circle imagenajud float-end" alt=""></div>                 
                            <div class="col-sm-12 d-flex align-items-center pt-3">
                                <div class="row g-2">
                                    <div class="col-sm-12 col-md-6">
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="field col-md-6">
                                        <input type="submit" name="submit" class="btn btn-primary rounded-pill shadow" value="Upload">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Firstname" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Lastname" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Email" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Contact Number" aria-label="default input example">
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="Baranggay, City, Province" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Username" aria-label="default input example">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Password" aria-label="default input example">
                                    </div>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" placeholder="Confirm-Password" aria-label="default input example">
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-sm-12 d-flex align-items-center pt-3">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                       <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Car
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Motorcycle
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Bicycle
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Say something about yourself" rows="3"></textarea>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow" data-bs-dismiss="modal">Save Changes</button>
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