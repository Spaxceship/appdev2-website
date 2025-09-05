<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body class="bg-info bg-opacity-25 min-vh-100 d-flex align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
          <div class="card shadow rounded-4">
            <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
              <h2 class="fw-bold mb-0">OTP Verification</h2>
              <p class="mb-0 small">Enter the code sent to your email</p>
            </div>
            <div class="card-body px-4 py-4">
              <form action="verifyotp.php" method="post">
                <div class="mb-4">
                  <label for="otp" class="form-label fw-semibold">One-Time Password</label>
                  <input type="text" name="otp" id="otp" maxlength="6" class="form-control form-control-lg text-center"/>
                </div>
                <div class="d-grid">
                  <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Verify OTP">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>

<?php
require_once "dbconn.php";
if (isset($_POST['submit'])) {
    $jgotp = $_POST['otp'];

    $jgotpsql = "SELECT * FROM db_dentalrecords.account_table_jg WHERE otp_jg = '".$jgotp."' ";    
    $jgresult = $conn->query($jgotpsql);

    if ($jgresult->num_rows == 1) {
        $jgupdatesql = "UPDATE db_dentalrecords.account_table_jg SET otp_jg = NULL, status_jg = 'Active' WHERE 
        otp_jg = '".$jgotp."' ";
        $conn->query($jgupdatesql);
        ?>
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            title: "Account Activated",
            showConfirmButton: false,
            timer: 1500
            }).then (() => {
                window.location.href = "login.php";
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
            position: "center",
            icon: "error",
            title: "Invalid OTP",
            showConfirmButton: false,
            timer: 1500
            });
        </script>
        <?php
    }   
}
?>