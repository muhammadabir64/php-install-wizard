<?php 
if(!file_exists("config.php")){
	header("Location: install");
	die();
}
?>
<?php 
require "header.php";
require "config.php";
?>

<div class="container">

<h1 class="m-5">Welcome!</h1>

  <table class="table table-hover table-bordered">
   <thead class="bg-dark text-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
<?php 
$sql = "SELECT * FROM `user`;";
$query = mysqli_query($con, $sql) or die(mysqli_error());
while ($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
      <td class="text-info"><?php echo $row["id"]; ?></td>
      <td><?php echo $row["fname"]; ?></td>
      <td><?php echo $row["lname"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
    </tr>
<?php } ?>
  </tbody>
</table>

</div>

<?php 
require "footer.php";
?>