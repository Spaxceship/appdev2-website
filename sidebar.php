  <div class="bg-primary text-white p-4 min-vh-100" style="width: 250px;">
    <h4 class="text-center">Dental System</h4>
    <ul class="nav flex-column">
    <?php
    $role = $_SESSION['role']; 

    if ($role === 'Admin') {
    ?>
        <li class="nav-item mb-2"><a href="tblusers.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Users</a></li>
        <li class="nav-item mb-2"><a href="tbllogs.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Logs</a></li>
        <li class="nav-item mb-2"><a href="tblpatient.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Patients</a></li>
        <li class="nav-item mb-2"><a href="tbldentist.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Dentists</a></li>
        <li class="nav-item mb-2"><a href="tblappointment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Appointments</a></li>
        <li class="nav-item mb-2"><a href="tbltreatment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Treatments</a></li>
    <?php
    } elseif ($role === 'Dentist') {
    ?>
        <li class="nav-item mb-2"><a href="tblpatient.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Patients</a></li>
        <li class="nav-item mb-2"><a href="tblappointment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Appointments</a></li>
        <li class="nav-item mb-2"><a href="tbltreatment.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Treatments</a></li>
    <?php
    } elseif ($role === 'Employee') {
    ?>
        <li class="nav-item mb-2"><a href="tblpatient.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Patients</a></li>
        <li class="nav-item mb-2"><a href="appointments.php" class="nav-link text-white px-2 py-1 rounded hover-bg">Appointments</a></li>
    <?php
    }
    ?>
    </ul>
  </div>
</div>
