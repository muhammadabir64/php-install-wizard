<?php 
  $db_host = "";
  $db_user = "";
  $db_pass = "";
  $db_name = "";
if (isset($_POST["install"])) {
  $db_host = htmlentities($_POST["db_host"]);
  $db_user = htmlentities($_POST["db_user"]);
  $db_pass = htmlentities($_POST["db_pass"]);
  $db_name = htmlentities($_POST["db_name"]);

$db_con = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!mysqli_connect_error()) {
  copy("conf.php", "config.php");
  $file = "config.php";
  file_put_contents($file, str_replace("db_host", $db_host, file_get_contents($file)));
  file_put_contents($file, str_replace("db_user", $db_user, file_get_contents($file)));
  file_put_contents($file, str_replace("db_pass", $db_pass, file_get_contents($file)));
  file_put_contents($file, str_replace("db_name", $db_name, file_get_contents($file)));

require "config.php";

  $sql = "CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  mysqli_query($con, $sql);

  $sql = "ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);";
  mysqli_query($con, $sql);

  $sql = "ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;";
  mysqli_query($con, $sql);

  $sql = "INSERT INTO `user` (`id`, `fname`, `lname`, `email`) VALUES
(1, 'Muhammad', 'ABIR', 'abir@gmail.com'),
(2, 'Rumon', 'Rahman', 'rumon@outlook.com'),
(3, 'Emon', 'Chowdhury', 'emon@hotmail.com'),
(4, 'Jayed', 'Hasem', 'jhasem@gmail.com'),
(5, 'Umah', 'Ahmed', 'umar@yahoo.com');";
  mysqli_query($con, $sql);

  header("Location: index");
}else{
  $msg = "";
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Install Wizard</title>
  </head>
<style>
#db_form{
  width: 25rem;
  margin: 0 auto;
  margin-top: 85px;
}
table{
  margin: 0 auto;
  width: 25px !important;
  margin-top: 125px;
}    
</style>
  <body>

<div class="container">
<?php 

if (isset($_GET["step"]) && $_GET["step"] == 2) {
?>
<div id="db_form" class="text-center">

  <form method="POST">
  <div class="form-group">
    <input type="text" name="db_host" value="<?php echo $db_host; ?>" class="form-control" id="host" placeholder="Database Host">
  </div>
  <div class="form-group">
    <input type="text" name="db_user" value="<?php echo $db_user; ?>" class="form-control" id="user" placeholder="Database Username">
  </div>
  <div class="form-group">
    <input type="text" name="db_pass" value="<?php echo $db_pass; ?>" class="form-control" id="pass" placeholder="Database Password">
  </div>
  <div class="form-group">
    <input type="text" name="db_name" value="<?php echo $db_name; ?>" class="form-control" id="name" placeholder="Database Name">
  </div>
  <button type="submit" class="btn btn-success" name="install">Install Database</button>
</form>
<br>
<?php 
if(mysqli_connect_error()){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. mysqli_connect_error() .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
</div>
<?php  
}else{ ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Configuration</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>PHP</td>
      <td>
        <?php 

          $error = 0;

          if(phpversion()>5){
            echo "<span class='text-success'>". phpversion() ."</span>";
          }else{
            echo "<span class='text-danger'>". phpversion() ."</span>";
            $error = 1;
          }
         ?>
      </td>
    </tr>
    <tr>
      <td>Curl</td>
      <td>
        <?php 

        if (function_exists("curl_version")) {
          echo "<span class='text-success'>Enabled</span>";
        }else{
          echo "<span class='text-danger'>Disabled</span>";
          $error = 2;
        }
         ?>
      </td>
    </tr>
    <tr class="text-right">
      <td>
        <?php 
            if ($error == 0) {
              echo "<a href='?step=2' class='btn btn-outline-info'>Next</a>";
            }else{
              echo "<button type='button' class='btn btn-outline-info' disabled>Next</button>";
            }
         ?>
      </td>
    </tr>
  </tbody>
</table>
<?php } ?>
</div>

<!--javascript cdn-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  </body>
</html>