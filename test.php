<?php
session_start();
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$role = $_SESSION['role'];

require_once "dbconn.php";
require_once "sidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dental Clinic Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  .hover-bg:hover {
    background-color: #0b5ed7;
    padding-left: 10px;
    transition: 0.3s;
  }
</style>

</head>
<body class="bg-info bg-opacity-25 min-vh-100">

<div class="d-flex">
  <!-- Sidebar -->
  <!-- <div class="bg-primary text-white p-4 min-vh-100">
    <h4 class="text-center"><strong>Dental System</strong></h4>
    <div class="ms-auto text-white text-start mb-4">
        <strong>Hello Admin <//?php echo $username = $_SESSION['username'];?></strong><br>
        <small><//?php echo $fullname = $_SESSION['fullname']; ?></small>
    </div>

    <ul class="nav flex-column">
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tblusers.php" class="nav-link text-white">Dashboard</a>
      </li>  
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tblusers.php" class="nav-link text-white">Users</a>
      </li>
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tbllogs.php" class="nav-link text-white">Logs</a>
      </li>
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tblpatient.php" class="nav-link text-white">Patients</a>
      </li>
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tbldentist.php" class="nav-link text-white">Dentists</a>
      </li>
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tblappointment.php" class="nav-link text-white">Appointments</a>
      </li>
      <li class="nav-item mb-2 rounded hover-bg">
        <a href="tbltreatment.php" class="nav-link text-white">Treatments</a>
      </li>
    </ul>
  </div> -->


  <!-- Main Content -->
  <div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <form action="display.php" method="post" class="d-flex gap-2">
        <input type="search" name="searchinput" class="form-control" placeholder="Search">
        <input type="submit" name="btnsearch" value="Search" class="btn btn-outline-primary">
      </form>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecord">+ Add New Record</button>
    </div>

    <!-- PHP Add Record Logic -->
    <?php
    if (isset($_POST['addRecord'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];

        $insertsql = "INSERT INTO tb_users (full_name, email, username, password, role) 
                      VALUES ('$fullname','$email','$username','$password','$role')";

        $result = $conn->query($insertsql);
        if ($result === TRUE) {
            echo "<div class='alert alert-success'>New record added successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
    ?>

    <!-- Add Record Modal -->
    <div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" method="POST">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="addRecordLabel">Add New Record</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-md-6">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" id="fullname" name="fullname" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                  <option value="" disabled selected>Select Role</option>
                  <option value="Admin">Admin</option>
                  <option value="Dentist">Dentist</option>
                  <option value="Employee">Employee</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="addRecord" class="btn btn-success">Add New Record</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white p-3 rounded shadow">
      <?php
      if (isset($_POST['btnsearch'])) {
          $search = $_POST['searchinput'];
          $sql = "SELECT * FROM tb_users  
                  WHERE full_name LIKE '%$search%' 
                  OR email LIKE '%$search%'
                  OR username LIKE '%$search%'
                  OR password LIKE '%$search%'
                  OR role LIKE '%$search%'
                  ORDER BY user_id ASC";
      } else {
          $sql = "SELECT * FROM tb_users ORDER BY user_id ASC";
      }

      $result = $conn->query($sql);

      if ($result->num_rows > 0): ?>
        <table class="table table-striped table-hover">
          <thead class="table-primary">
            <tr>
              <th>Account ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Password</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['full_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['password'] ?></td>
                <td><?= $row['role'] ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="text-muted">No records found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
