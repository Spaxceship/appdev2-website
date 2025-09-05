<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <form action="home.php" method="post" enctype="multipart/form-data">
    <div class="container p-5 w-50 border border-primary rounded mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-1 text-primary">
                Register
            </h1>
        </div>
    </div>
    <div class="row ">
        <div class="col">
            <img alt="" id="preview_img" width=200 height=200  class="img-thumbnail mx-auto d-block">
        </div>
    </div>
    <div class="row my-3">
        <div class="col">
            <input type="file" name="upload_img" id="" class="form-control w-25 mx-auto d-block" onchange="previewFile(event)">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-outline">
                <input type="text" id="firstname" name="first" class="form-control is-valid" >
                <label class="form-label" id="firstname-label" for="firstname">First name</label>
            </div>
        </div>
        <div class="col">
            <div class="form-outline">
                <input type="text" id="lastname" name="last" class="form-control " />
                <label class="form-label" for="lastname">Last name</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
        
        <div class="btn-group mx-5 text-center" id="btn-group-3" >
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio1" value="Female" />
                <label class="form-check-label" for="inlineRadio1">Female</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio2" value="Male" />
                <label class="form-check-label" for="inlineRadio2">Male</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio3" value="Others"/>
                <label class="form-check-label" for="inlineRadio3">Others</label>
            </div>
        </div>
        <div class="row d-block">
            <div class="col">
                <span class="form-label ">Gender</span>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col text">
        <input type="text" id="form6Example4"  name="add" class="form-control" />
        <label class="form-label" for="form6Example4">Address</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <input type="text" id="email"  name="email" class="form-control" />
        <label class="form-label" for="email">Email</label>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <input type="text" id="form6Example6" name="contact" class="form-control" />
        <label class="form-label" for="form6Example6">Phone</label>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <textarea class="form-control" name="addinfo" id="form6Example7" rows="4"></textarea>
        <label class="form-label" for="form6Example7">Additional information</label>
        </div>
    </div>


    <div class="row">
        <div class="col">
        <input type="text" id="form6Example6" name="username" class="form-control" />
        <label class="form-label" for="form6Example6">Username</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <input type="password" id="form6Example6" name="password" class="form-control" />
        <label class="form-label" for="form6Example6">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <select name="role" class="form-control" id="">
            <option> Admin</option>
            <option> Employee</option>
        </select>
        <label class="form-label" for="form6Example6">Role</label>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">   
            <input type="submit"  name="sub" class="btn btn-primary btn-block w-100" value="Save Details" id=sub>
        </div>
    </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewFile(event) {
        var display_img = document.getElementById("preview_img");
        display_img.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
</body>
</html>

<?php
//database connection
require_once "dbconn.php";
include "verifyemail.php";
// if ($conn->connect_error) {
//     die("Connection Unsuccesful");
// } else {
//     echo "Connected Succesfully";
// }

if(isset($_POST['sub'])){
    $jgfirst = $_POST['first'];
    $jglast = $_POST['last'];
    $jggen = $_POST['Gender'];
    $jgadd = $_POST['add'];
    $jgemail = $_POST['email'];
    $jgcontact = $_POST['contact'];
    $jgaddinfo = $_POST['addinfo'];
    $jgusername = $_POST['username'];
    $jgpassword = md5($_POST['password']);
    $jgrole = $_POST['role'];
    $jgimagepath = "jg_images/".basename($_FILES['upload_img']['name']);
    move_uploaded_file($_FILES['upload_img']['tmp_name'], $jgimagepath);

    $jgfullname = $jgfirst." ".$jglast;
    $jgotp = rand(000000,999999);
    $jgstatus = "Pending";

    $insertsql = "INSERT INTO account_table_jg (fname_jg, lname_jg, gender_jg, address_jg, email_jg, 
                phone_num_jg, addinfo_jg, account_type_jg, username_jg, password_jg, images_jg, otp_jg, status_jg) 
                VALUES ('$jgfirst','$jglast','$jggen','$jgadd','$jgemail',$jgcontact,'$jgaddinfo','$jgrole',
                '$jgusername','$jgpassword','$jgimagepath',$jgotp,'$jgstatus')";
    
    $result = $conn->query($insertsql);
    //debug insert
    if ($result == TRUE) {
        send_verification($jgfullname, $jgemail, $jgotp);

    ?>   
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            title: "Account succesfully created",
            showConfirmButton: false,
            timer: 1500
            }).then (() => {
                window.location.href = "verifyotp.php";
            });
        </script> 
    <?php
    } else {
        echo $conn->error;
    }
}
?>