<?php
session_start();
if(!$_SESSION['loggedin']){
    header("location: login.php");
}
include 'parts/dbconnect.php';
$mail=$_SESSION['mail'];
$sql="SELECT * FROM `wn_userdata` WHERE mail='$mail'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['fname'];
$fname=$name;
$lname=$row['lname'];
$mail=$row['mail'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title=$_POST['title'];
    $note=$_POST['note'];
    $ar=explode("@",$mail);
    $smail=$ar[0];
    $sql="INSERT INTO `$smail` (`title`, `note`, `time`)
    VALUES ('$title', '$note', current_timestamp())";
    $result=mysqli_query($conn,$sql);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="theme.css">

    <title>WebNote | <?php echo $name?></title>
</head>

<body>
    <?php include 'parts/navbar.php'?>

    <h1 align="center">Hey <?php echo $name?>!!</h1>
    <div class="container">
        <hr>
        <?php include 'parts/_note.php'?>
        <hr>
    </div>
    <div class="container">
        <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#addNoteModal">
            Add New Note
        </button>
        <hr>
    </div>
    <div class="container">
        <button type="button" class="btn btn-outline-danger"
            onclick="document.location='parts/_logout.php'">Logout</button>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalText" id="profileModalLabel">
                        <img src="imgs/profile.png" height="30px" width="30px" alt=""> <?php echo $fname?>'s Profile
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container modalText">
                    <h5>Name:- <?php echo $fname." ".$lname?></h5><br>
                    <h5>Mail:- <?php echo $mail?></h5>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#passModal">Change Password</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Pass Modal -->
    <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="passModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalText" id="passModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <?php include 'parts/_pass.php'?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add note Modal -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modalText" id="addNoteModalLabel">Add New Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include 'parts/addnote.php'?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>