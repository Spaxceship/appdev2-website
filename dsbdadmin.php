<?php
session_start();
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$role = $_SESSION['role'];
require_once "dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dental Clinic Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease-in-out;
    }
    .card-img-top {
      height: 150px;
      object-fit: cover;
    }
    .hover-bg:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
  </style>
</head>
<body class="bg-info bg-opacity-25">

  <div class="d-flex">

    <div class="bg-primary text-white p-4 min-vh-100" style="width: 250px;">
      <h4 class="text-center">Dental System</h4>
      <ul class="nav flex-column">
        <?php if ($role === 'Admin'): ?>
          <li class="nav-item mb-2"><a href="dsbadmin.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Dashboard</a></li>          
          <li class="nav-item mb-2"><a href="tblusers.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Users</a></li>
          <li class="nav-item mb-2"><a href="tbllogs.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Logs</a></li>
          <li class="nav-item mb-2"><a href="tblpatient.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Patients</a></li>
          <li class="nav-item mb-2"><a href="tbldentist.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Dentists</a></li>
          <li class="nav-item mb-2"><a href="tblappointment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Appointments</a></li>
          <li class="nav-item mb-2"><a href="tbltreatment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Treatments</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <div class="container-fluid p-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php if ($role === 'Admin'): ?>

          <div class="col">
          <div class="card shadow-lg">
            <img src="assets/user-icon.png" class="card-img-top" alt="Users" />
            <div class="card-body text-center">
              <h5 class="card-title">Users</h5>
              <p class="card-text">Manage system users.</p>
              <a href="tblusers.php" class="btn btn-primary">Go to Users</a>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-lg">
            <img src="assets/log-icon.png" class="card-img-top" alt="Logs" />
            <div class="card-body text-center">
              <h5 class="card-title">Logs</h5>
              <p class="card-text">View activity logs.</p>
              <a href="tbllogs.php" class="btn btn-primary">Go to Logs</a>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div class="col">
          <div class="card shadow-lg">
            <img src="assets/patient-icon.png" class="card-img-top" alt="Patients" />
            <div class="card-body text-center">
              <h5 class="card-title">Patients</h5>
              <p class="card-text">Manage patient records.</p>
              <a href="tblpatient.php" class="btn btn-primary">Go to Patients</a>
            </div>
          </div>
        </div>

        <?php if ($role === 'Admin'): ?>
        <div class="col">
          <div class="card shadow-lg">
            <img src="assets/dentist-icon.png" class="card-img-top" alt="Dentists" />
            <div class="card-body text-center">
              <h5 class="card-title">Dentists</h5>
              <p class="card-text">Manage dentist details.</p>
              <a href="tbldentist.php" class="btn btn-primary">Go to Dentists</a>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div class="col">
          <div class="card shadow-lg">
            <img src="assets/appointment-icon.png" class="card-img-top" alt="Appointments" />
            <div class="card-body text-center">
              <h5 class="card-title">Appointments</h5>
              <p class="card-text">Schedule and view appointments.</p>
              <a href="tblappointment.php" class="btn btn-primary">Go to Appointments</a>
            </div>
          </div>
        </div>

        <?php if ($role === 'Admin' || $role === 'Dentist'): ?>
        <div class="col">
          <div class="card shadow-lg">
            <img src="assets/treatment-icon.png" class="card-img-top" alt="Treatments" />
            <div class="card-body text-center">
              <h5 class="card-title">Treatments</h5>
              <p class="card-text">Manage treatments records.</p>
              <a href="tbltreatment.php" class="btn btn-primary">Go to Treatments</a>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
