<?php

session_start();
if (isset($_SESSION["username"]))
    $username = $_SESSION["username"];
else
    $username = "";

$subject = $_GET["subject"];

//echo "유저이름 : $username  공연작품이름: $subject"; // 아래 에코 주석하고 여기 풀어서 정상적으로 받아오는 것 확인완료

$con = mysqli_connect("localhost", "user1", "12345", "music");
$sql = "UPDATE members SET zzim='$subject' WHERE name='$username'";

mysqli_query($con, $sql);
mysqli_close($con);

echo "
	     <script>
	         location.href = 'gongiboard_list.php';
	     </script>
	   ";
?>