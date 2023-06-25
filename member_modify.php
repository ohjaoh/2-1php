<?php

$id = $_GET["id"];

$name = $_POST["name"];
$pass = $_POST["pass"];
$phone_number = $_POST["phone_number"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$self_inproduce = $_POST["self_inproduce"];
$musician = $_POST["musician"];

$hobby = implode(',', $_POST['hobby']);

$upload_dir = './data/';
/* 업로드 폴더 설정
 * 업로드 파일을 저장할 폴더인 $upload_dir 값을 ./data로 설정. */

/* 업로드 파일 정보 가져오기
 * board_form의 첨부파일부분의 name 속성을 upfile로 설정하여 업로드 파일의 정보가 배열변수로 전달됨.
 * Test.zio파일을 업로드 한다면 $_FILES["upfile"]["name"]에는 파일명인 test.zip 저장.
 * $_FILES["upfile"]["tmp_name"]에는 파일명(test.zip)대신 실제 서버에 저장되는 임시 파일명 저장.
 * $_FILES["upfile"]["type"]에는 test.zip 파일의 형식 저장. size에는 크기 error에는 업로드시 발생하는 오류정보저장
 */
$upfile_name = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
$upfile_type = $_FILES["upfile"]["type"];
$upfile_size = $_FILES["upfile"]["size"];
$upfile_error = $_FILES["upfile"]["error"];

if ($upfile_name && !$upfile_error) {
    $file = explode(".", $upfile_name);
    /* 파일명과 확장자 분리
     * 업로드파일이름을 .으로 구분하여 잘라내고 이름과 종류로 따로 저장 */
    $file_name = $file[0];
    $file_ext = $file[1];

    $new_file_name = date("Y_m_d_H_i_s");
    /* date()함수로 실업로드파일명을 구하고 확장자와 붙여서 $copied_file_name 에 저장
     * $uploaded_file 에는 저장할 폴더인 ./data를 포함. */
    $new_file_name = $new_file_name;
    $copied_file_name = $new_file_name . "." . $file_ext;
    $uploaded_file = $upload_dir . $copied_file_name;

    if ($upfile_size > 1000000) {
        /* 업로드파일의 크기가 1000000바이트(약 1Mb)를 초과하면 경고메시지출력하고 이전의 폼 양식 페이지로 돌아감 */
        echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
        exit;
    }

    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file))
    /* 업로드파일을 ./data 폴더에 저장
     * move_uploaded_file() 함수로 서버에 임시 저장된 $upplie_tmp_nema을 $uploaded_file의 값인 경로/파일명 형태로 저장 업로드 파일명이 중복되는 것을 피할 수 있음
     * if문 조건문으로 move_uploaded_file()함수를 수행할 때 오류가 있으면 '파일을 지정한 디렉터리에 복사하는 데 실패했습니다.'라는 메시지경고 창을 띄우고 이전 폼 페이지로 돌아감.  */ {
        echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
        exit;
    }
} else {
    $upfile_name = "";
    $upfile_type = "";
    $copied_file_name = "";
}
$represent_image = $_POST["represent_image"];
$represent_image = $uploaded_file;

$con = mysqli_connect("localhost", "user1", "12345", "music");

$sql = "UPDATE members SET name='$name', pass='$pass', phone_number='$phone_number', gender='$gender',  represent_image='$represent_image', address='$address', hobby='$hobby', self_inproduce='$self_inproduce', musician='$musician' where id='$id'";


mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
mysqli_close($con);

echo "
	<script>
	    location.href = 'index.php';
	</script>
        ";
?>


