<?php
// 레코드 번호와 페이지 번호 전달받기
$num = $_GET["num"];
$page = $_GET["page"];

/*첨부 파일을 삭제하기 위해 DB에 저장된 첨부 파일명을 가져옴.
 * $num을 이용하여 해당 레코드 정보를 가져와 $result에 저장.
 * mysqli_fetch_array( ) 함수로 첨부 파일명인 $row[“file_copied”]를 구하여 $copied_name에 저장.*/
$con = mysqli_connect("localhost", "user1", "12345", "music");
$sql = "select * from gongiboard where num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$copied_name = $row["file_copied"];

if ($copied_name) {//$copied_name에 값이 설정되어 있으면 첨부 파일이 존재한다는 의미. unlink( ) 함수로 서버에 저장된 첨부 파일 삭제.
    $file_path = "./data/" . $copied_name;
    unlink($file_path);
}

$sql = "delete from gongiboard where num = $num";
// DB에서 해당 레코드 삭제
mysqli_query($con, $sql);
mysqli_close($con);

echo "
	     <script>
             //페이지이동
	         location.href = 'gongiboard_list.php?page=$page';
	     </script>
	   ";
?>

