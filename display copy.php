<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container p-5 bg-light">
<form action="display.php" method="post">
        <div class="row g-5">
            <div class="col-auto">
            <input type="search" name="searchinput" id="" placeholder="Search" class="form-control">
            </div>
            <div class="col-auto">
            <input type="submit" name="btnsearch" value="Search" class="btn-primary btn">
            </div>
        </div>
</form>

<?php 
require_once "dbconn.php";  //start the database connection
//if (!$conn->connect_error){     //check if connected
//    echo "Connected";}
//display query
if (isset($_POST['btnsearch'])) {   //search button function
    //user input
    $jgsearchinput = $_POST['searchinput'];
    $jgselectsql = "Select * from db_dentalrecords.account_table_jg where lname_jg like '%".$jgsearchinput."%'
    OR account_id_jg like '%".$jgsearchinput."%'
    OR lname_jg like '%".$jgsearchinput."%'
    OR gender_jg like '".$jgsearchinput."%'
    OR email_jg like '%".$jgsearchinput."%'
    OR phone_num_jg like '%".$jgsearchinput."%'
    OR account_type_jg like '%".$jgsearchinput."%'
    OR addinfo_jg like '%".$jgsearchinput."%'
    OR username_jg like '%".$jgsearchinput."%'
    OR password_jg like '%".$jgsearchinput."%'"; 
} else {     //if the search button is not clicked
    $jgselectsql = "Select * from db_dentalrecords.account_table_jg";
}
$jgresult = $conn->query($jgselectsql);     //convert query string to an SQL statement & return a 2D array of records
//check table if empty  
if ($jgresult->num_rows > 0) {    //num_rows - count no. of records in table
    ?>
    <div class="container">
        <div class="row">
    <?php
        foreach ($jgresult as $index => $jgfield) {
        ?>
            <div class="col p-5 bg-dark text-white m-2">
                <div class="row">
                    <div class="col">
                        <img src="<?php echo $jgfield['images_jg']; ?>" width=400 height=200 class="mx-auto d-block" srcset="">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span><?php echo $jgfield['fname_jg']." ".$jgfield['lname_jg']; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="small"><?php echo $jgfield['address_jg']; ?></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="button" value="View" class="btn btn-success">
                    </div>
                </div>
            </div>
        <?php
        if (($index+1) % 4 == 0) {
            echo "</div><div class='row'>";
        }
        }
        echo "</div></div>";
    ?>
    <table class="table table-danger">
    <tr>
        <th>Account ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Additional Info</th>
        <th>Account Type</th>
        <th>Username</th>
        <th>Password</th>
        <th>Image</th>
        <th>Image View</th>
    </tr>
    <?php
        foreach ($jgresult as $jgfield) {
            echo "<tr>";
            echo "<td>".$jgfield['account_id_jg']."</td>";
            echo "<td>".$jgfield['fname_jg']."</td>";
            echo "<td>".$jgfield['lname_jg']."</td>";
            echo "<td>".$jgfield['gender_jg']."</td>";
            echo "<td>".$jgfield['address_jg']."</td>";
            echo "<td>".$jgfield['email_jg']."</td>";
            echo "<td>".$jgfield['phone_num_jg']."</td>";
            echo "<td>".$jgfield['addinfo_jg']."</td>";
            echo "<td>".$jgfield['account_type_jg']."</td>";
            echo "<td>".$jgfield['username_jg']."</td>";
            echo "<td>".$jgfield['password_jg']."</td>";
            echo "<td>".$jgfield['images_jg']."</td>";
            echo "<td><img src='".$jgfield['images_jg']."' width='100' height='100'></td>";
            echo "</tr>";
        }
    ?>
    </table>
<?php
    } else {    //if table is empty
        echo "No record found";
    }
?>

</div>
</body>
</html>