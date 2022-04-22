<!-- <?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'mechanicnowdb');
    $sql1="SELECT * FROM `chat` GROUP BY `custID`";
    $output="";
    $query_run = mysqli_query($connection, $sql1);
    
    if(mysqli_num_rows($sql1) > 0){
        while($row = mysqli_fetch_assoc($sql1)){
            $output .= '<div class="row py-2 px-2">
                            <div class="col-3 col-lg-2 text-start">
                                <img src="../img/avatar.jpg" alt="" style="height: 3em; width: 3em;" class="rounded-circle">
                            </div>
                            <input type="hidden" name="custID" value="'. $row['custID'] .'">
                                <div class="col-9 col-lg-10 text-start">
                                    <h6>'. $row['custName'] .'</h6>
                                    <p class="fs-6"><small>This is test message</small></p>
                                </div>
                        </div>';
        }
    }else{
        $output .= "There's no mechanic added in contact yet.";
    }
    echo $output;
?> -->

<!-- <?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'mechanicnowdb');
    $custID = $_POST['custID'];

    $sql1="SELECT * from customer WHERE custID='$custID'";
    $query_run = mysqli_query($connection, $sql1);
    while($row = mysqli_fetch_array($query_run)){
    
        if(isset($row['custID'])){
            $custID = mysqli_real_escape_string($connection, $_POST['custID']);
            $output = "";

            $sql2="SELECT * from customer WHERE custID='$custID'";
            $query2 = mysqli_query($connection, $sql2);
            if(mysqli_num_rows($query2) > 0){
                while($row = mysqli_fetch_assoc($query2)){
                    if($row['custID'] === $custID){ 
                        $output .= '<h5>'. $row['custFirstname'] .' '. $row['custLastname'] .'</h5>';
                    }else{
                        $output .= '<h5>select from chat list</h5>'
                    }
                }
                $id = $row['custID'];
                $custName = $row['custFirstname'].' '.$row["custLastname"];
            }
            echo $output;
        }
    }
?> -->

<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'mechanicnowdb');
    $custID = $_POST['custID'];
    // $output = "";
    $sql1="SELECT * from customer WHERE custID='$custID'";
    $query_run = mysqli_query($connection, $sql1);
    while($row = mysqli_fetch_array($query_run)){
        // if($row['custID'] === $custID){
        //     $output .= '<h5>'. $row['custFirstname'] .' '. $row['custLastname'] .'</h5>';    
        //     $id = $row['custID'];
        //     $custName = $row['custFirstname'].' '.$row["custLastname"];
        // }else{
        //     $output .= '<h5>select from chat list</h5>';
        // }
        if(isset($row['custID'])){
            $custID = mysqli_real_escape_string($connection, $_POST['custID']);
            $output = "";

            $sql2="SELECT * from customer WHERE custID='$custID'";
            $query2 = mysqli_query($connection, $sql2);
            if(mysqli_num_rows($query2) > 0){
                while($row = mysqli_fetch_assoc($query2)){
                    if($row['custID'] === $custID){ 
                        $output .= '<h5>'. $row['custFirstname'] .' '. $row['custLastname'] .'</h5>';
                    }else{
                        $output .= '<h5>select from chat list</h5>'
                    }
                }
                $id = $row['custID'];
                $custName = $row['custFirstname'].' '.$row["custLastname"];
            }
            echo $output;
        }
    }
    //echo $output;
?>
