<?php
// 글 수정 페이지(gongiboard_modify_form.php)로부터 레코드 번호, 페이지 번호, 수정된 글 제목과 내용을 $_GET[“num”], $_GET[“page”], $_POST[“subject”], $_POST[“content”]로 전달받음.
$num = $_GET["num"];
$page = $_GET["page"];

$subject = $_POST["subject"];
$content = $_POST["content"];

$con = mysqli_connect("localhost", "user1", "12345", "music");
$sql = "update gongiboard set subject='$subject', content='$content' ";
// 수정된 글 제목($subject)과 내용($content)으로 gongiboard 테이블의 해당 필드 업데이트
$sql .= " where num=$num";
mysqli_query($con, $sql);

mysqli_close($con);

echo "
	      <script>
	          location.href = 'gongiboard_list.php?page=$page';
                      //글 목록 보기 페이지인 gongiboard_list.php 파일로 이동. 페이지 번호를 GET 방식으로 전달하여 글 목록보기 페이지에서 수정된 글 제목을 볼 수 있음
	      </script>
	  ";
?>


