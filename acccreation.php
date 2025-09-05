<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dental Clinic Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-info bg-opacity-25">
  <div class="container mt-5">
    <div class="card mx-auto shadow rounded-4" style="max-width: 700px;">
      <div class="card-header bg-primary text-white text-center py-4">
        <h2 class="fw-bold mb-0">Dental Clinic Employee Registration</h2>
      </div>
      <div class="card-body px-5">
        <form action="acccreation.php" method="post">

          <div class="row mb-3">
            <div class="col">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" id="fullname" name="fullname" class="form-control" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <div class="mb-4">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
              <option value="" disabled selected>Select Role</option>
              <option value="Admin">Admin</option>
              <option value="Dentist">Dentist</option>
              <option value="Employee">Employee</option>
            </select>
          </div>

          <div class="d-grid">
            <input type="submit" name="sub" class="btn btn-primary btn-lg" value="Save Details">
          </div>

          <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php">Login here</a></p>

        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
require_once "dbconn.php";

if(isset($_POST['sub'])){
  
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    
    $insertsql = "Insert into tb_users (full_name, email, username, password, role) 
                values ('$fullname','$email','$username','$password','$role')";
    
    $result = $conn->query($insertsql);
    if ($result == TRUE) {
    ?>   
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            title: "Account succesfully created",
            showConfirmButton: false,
            timer: 1500
            }).then (() => {
                window.location.href = "login.php";
            });
        </script> 
    <?php
    } else {
        echo $conn->error;
    }
}
?>