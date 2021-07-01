<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php
$database = new mysqli('localhost', 'root', '', 'lab 4');

$emailLogin = $_POST['loginEmail'];
$passwordLogin = $_POST['loginPassword'];

$checkLoginEmail = mysqli_query($database, "SELECT * FROM users WHERE Email = '$emailLogin'");
if (mysqli_num_rows($checkLoginEmail) == 1) {
  $row = $checkLoginEmail->fetch_assoc();
  if (password_verify($passwordLogin, $row['Password']) == 1) {
    if ($row['StatusId'] == 0) {
      include 'registration.php';
      echo "შეამოწმეთ მეილი";
    } else {
      $_SESSION['loginUsername'] = $row['FirstName'].' '.$row['LastName'];
      include 'home.php';
    }
  } else {
    include 'registration.php';
    echo "არასწორია";
  }
} else {
  include 'registration.php';
  echo " არასწორია";
}
