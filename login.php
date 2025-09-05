<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>

<body class="bg-info bg-opacity-25">
    <div class="container mt-5">
      <div class="card mx-auto shadow rounded-4" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center py-4">
          <h2 class="fw-bold mb-0">Dental Clinic Registration</h2>
        </div>
        <div class="card-body px-5">
          <form action="login.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required />
            </div>
            <div class="d-grid">
              <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>


<?php
require_once "dbconn.php";

if (isset($_POST['submit'])){

    session_start(); //start the session
    $jgusername = $_POST["username"];
    $jgpassword = md5($_POST["password"]);

    //declaration = value
    $_SESSION['username'] = $jgusername; //store username in session variable

    $jglogin_sql = "SELECT * FROM db_dentalrecords.account_table_jg WHERE (username_jg ='".$jgusername."' OR 
    email_jg = '".$jgusername."') AND password_jg = '".$jgpassword."' AND status_jg = 'Active'";
    $jgresult = $conn->query($jglogin_sql);

    // Check if the query was successful
    if ($jgresult->num_rows == 1) {
        $jgfield = $jgresult->fetch_assoc();
        //user role
        $jguser_type = $jgfield['account_type_jg'];
        $jgfname = $jgfield['fname_jg'];
        $jglname = $jgfield['lname_jg'];
        $jgid = $jgfield['account_id_jg'];

        //store action in logs table
        $_SESSION['account_id_jg'] = $jgid; //store user id in session variable
        $jglogin_sql = "INSERT INTO tbl_logs (user_id,action,datetime) VALUES ('".$jgid."','Logged In',NOW())";
        $conn->query($jglogin_sql);

        $_SESSION['fullname'] = $jgfname." ".$jglname; //store fullname in session variable

        //condition to redirect user to the correct page based on their role
        if ($jguser_type == "Admin") {
            header("Location: dsbdadmin.php");
        } elseif ($jguser_type == "Employee") {
            header("Location: dsbdemployee.php");
        } else {
            header("Location: dsbddentist.php");
        }

    } else {
        ?>
        <script>
            Swal.fire({
            position: "center",
            icon: "error",
            title: "Invalid username or password",
            showConfirmButton: false,
            timer: 1500
            });
        </script>
        <?php
    }
}
?>