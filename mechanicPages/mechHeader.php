<section id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light container-fluid">
            <div class="container-fluid">
                <a class="navbar-brand" href="./mechDashboard.php"><img src="../img/navlogo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./mechProfile.php"><i class="fa-regular fa-user"></i> <?php echo htmlentities($_SESSION["Username"]); ?></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-regular fa-bell"></i> Notification</a>
                    </li>
                   <li class="nav-item dropdown">
                        <a class="nav-link fa-solid fa-caret-down" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item fa-thin fa-gear" href="#"> Settings</a></li>
                            <li><a class="dropdown-item fa-thin fa-right-from-bracket" onclick="myconfirm1()"> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </section>
    <script> 
    function myconfirm1() {
        let text = "Are sure you want to leave?.";
        if (confirm(text) == true) {
            location.replace('../login.php')
        } else {
            location.reload();
        }
    }
    </script>
   