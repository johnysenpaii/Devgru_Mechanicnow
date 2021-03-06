<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
include('../config.php');
if(isset($_POST['ban'])){
    $email = $_POST['custEmail'];
    $subject= 'Now you can use your account again!';
    $message = 'Now you can use your account again!';
    //Load composer's autoloader
    require 'C:/xampp/htdocs/Devgru_Mechanicnow/Admin/PHPMailer-master/src/Exception.php';
    require 'C:/xampp/htdocs/Devgru_Mechanicnow/Admin/PHPMailer-master/src/PHPMailer.php';
    require 'C:/xampp/htdocs/Devgru_Mechanicnow/Admin/PHPMailer-master/src/SMTP.php';
    $mail = new PHPMailer(true);                            
    
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'mechanicnow22@gmail.com';     
        $mail->Password = 'Mechanic_Now22';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   
 
        //Send Email
        $mail->setFrom('mechanicnow22@gmail.com');
 
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('mechanicnow22@gmail.com');
 
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
 
        $mail->send();
 
   
    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE customer set ban='unban' where custID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();
   
    echo "<script type='text/javascript'>alert('user unbanned');</script>";
    echo "<script type='text/javascript'>location.replace('userAdmin.php');</script>";




}


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
                                <a href="adminSide.php" class="nav-link"><i class="bi bi-speedometer"></i>
                                    Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="pending.php" class="nav-link "><i class="bi bi-person-lines-fill"></i>
                                    Mechanic
                                    Approvals</a>
                            </li>
                            <li class="nav-item dropdown w-100 ">
                                <a href="#" class="nav-link dropdown-toggle active" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-check-fill"></i>
                                    Monitor</a>
                                <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                                    <li><a href="userAdmin.php" class="dropdown-item pl-4 p-2 active"><i
                                                class="bi bi-person-circle"></i> Clients</a></li>
                                    <li><a href="mechAdmin.php" class="dropdown-item pl-4 p-2"><i
                                                class="bi bi-tools"></i> Mechanics</a></li>
                                                <li><a href="banlist.php" class="dropdown-item pl-4 p-2"><i class="bi bi-exclamation-circle-fill"></i> Banned Mechanics</a></li>
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
                                <a href="Report.php" class="nav-link"><i class="bi bi-list-columns"></i> Reports</a>
                            </li>
                            <br>
                            <hr class="text-light m-1">
                            <li class="nav-item w-100">
                                <a onclick="myconfirm()" href="#" class="nav-link text-danger"><i class="bi bi-door-closed"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
            <main class="col px-0 flex-grow-1">
                <div class="container py-3">
                    <section class="my-container">
                        <div class="display-6 my-2">Unbanned Vehicle Owner</div>
                        <hr class="text-dark m-2">
                        <form method="POST">
                            <?php
						$regeditid=intval($_GET['regeditid']);
						$sql="SELECT *from customer where custID=:regeditid";
						$query = $dbh->prepare($sql);
						$query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount()>0){
    						foreach($results as $result){
						?>
                        
                            <div class="row d-flex justify-content-start px-4 ">
                                <div class="col-lg-10 col-md-12 col-sm-12 d-flex justify-content-center">
                                    <img src="../uploads/<?=$result->profile_url ?>" class="img-fluid" width="20%" height="20%" alt="...">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-2">
                                    <label for="mechFirstname" style="color: rgb(61, 138, 247);">First Name</label>
                                    <input type="text" name="mechFirstname" id="mechFirstname"
                                        value="<?php echo htmlentities($result->custFirstname);?>" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-2">
                                    <label for="lname" style="color: rgb(61, 138, 247);">Last Name</label>
                                    <input type="text" name="lname" id="lname"
                                        value="<?php echo htmlentities($result->custLastname);?>" class="form-control"
                                        required="required" autocomplete="on">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-2">
                                    <label for="mechCnumber" style="color: rgb(61, 138, 247);">Contact Number</label>
                                    <input type="number" name="mechCnumber" id="mechCnumber"
                                        value="<?php echo htmlentities($result->custCnumber);?>" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-2 ">
                                    <label for="mechEmail" style="color: rgb(61, 138, 247);">Email Address</label>
                                    <input type="text" name="custEmail" id="custEmail"
                                        value="<?php echo htmlentities($result->custEmail);?>" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-2">
                                    <label for="Address" style="color: rgb(61, 138, 247);">Address</label>
                                    <input type="text" name="Address" id="Address"
                                        value="<?php echo htmlentities($result->custAddress);?>" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-2">
                                    <label for="Documents" style="color: rgb(61, 138, 247);">Type of vehicle</label>
                                    <input type="text" name="Documents" id="Documents"
                                        value="<?php echo htmlentities($result->vehicleType);?>" class="form-control">
                                </div>
                                
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-2">
                                    <label for="Username" style="color: rgb(61, 138, 247);">Username</label>
                                    <input type="text" name="Username" id="Username"
                                        value="<?php echo htmlentities($result->Username);?>" class="form-control">
                                </div>
                                <div class="float-end">
                                    <button class="btn btn-success btn-lg" type="submit" id="ban" name="ban"
                                        value="approve"><i class="bi bi-person-check-fill"></i> Unbanned</button>
                                </div>
                            </div>
                            <?php }}?>
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
    </script>
    <?php include('footer.php');?>
</body>

</html>