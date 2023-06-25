<?php
// 첨부파일 정보 전달받기
// 글 내용 보기 페이지(예제 14-4)에서 전달받은 $_GET[“real_name”], $_GET[“file_name”], $_GET[“file_type”]은 각각 서버에 저장된 파일명, 파일명, 파일 형식을 의미
$real_name = $_GET["real_name"];
$file_name = $_GET["file_name"];
$file_type = $_GET["file_type"];
$file_path = "./data/" . $real_name;

/* 브라우저가 인터넷 익스플로러인지 판단
•     인터넷 익스플로러에서 첨부 파일을 다운로드 할 때 파일명이 한글이면 한글이 깨지는 현상이 발생할 수 있음. 이를 대비해 사용자 브라우저가 인터넷 익스플로러인지 검사 필요.
•     $_SERVER [‘HTTP_USER_AGENT’]는 사용자 브라우저 이름.
•     preg_match( ) 함수로 브라우저 이름에 MSIE나 Internet Explorer가 포함되어 있는지 검사.
•     strpos( ) 함수로 브라우저 이름에 문자열 Trident/7.0 또는 rv:11.0이 포함되어 있는지 검사. 인터넷 익스플로러는 브라우저 이름에 이러한 문자열이 포함되어 있기 때문 */
$ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false &&
        strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

//IE인경우 한글파일명이 깨지는 경우를 방지하기 위한 코드 
if ($ie) {
    /*인터넷 익스플로러인 경우 파일명의 문자셋 변경
     * 인터넷 익스플로러에서 한글이 깨지는 현상을 방지하기 위해 파일명의 문자셋을 utf-8에서 euc-kr로 변경.
     * iconv(‘utf-8’, ‘euc-kr’, $file_name)은 $file_name의 문자셋을 utf-8에서 euc-kr로 변경하라는 의미.*/
    $file_name = iconv('utf-8', 'euc-kr', $file_name);
}

if (file_exists($file_path)) {//다운로드 파일의 존재 확인 
    // file_exists($file_path)는 다운로드하려는 파일인 $file_path가 존재하는지 검사.
    $fp = fopen($file_path, "rb");// 파일열기 $file_path 파일 열기. rb는 파일을 읽고 쓸 수 있는 모드로 열라는 의미.
    Header("Content-type: application/x-msdownload"); // 파일 정보 알려주기 다운로드할 파일 정보를 Header( ) 함수로 클라이언트 브라우저에 알려줌.
    Header("Content-Length: " . filesize($file_path));
    Header("Content-Disposition: attachment; filename=" . $file_name);
    Header("Content-Transfer-Encoding: binary");
    Header("Content-Description: File Transfer");
    Header("Expires: 0");
}

/*파일 전송 및 파일 포인터 닫기
 * 파일 포인터인 $fp에 저장된 파일 데이터를 fpassthru( ) 함수로 출력 버퍼에 저장하면 파일이 다운로드 됨. 다운로드가 완료되면 fclose( ) 함수로 파일을 닫음. */
if (!fpassthru($fp))
    fclose($fp);
?>


