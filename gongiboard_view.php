<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍기말</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/gongiboard.css">
    </head>
    <body> 
        <header>
            <?php include "header.php"; ?>
        </header>  
        <section>
            <div id="main_img_bar">
                <img src="./img/main_img.png">
            </div>
            <div id="gongiboard_box">
                <h3 class="title">
                    공지게시판 > 내용보기
                </h3>
                <?php
                //글 목록 보기 페이지(board_list.php)로부터 레코드 일련번호와 페이지 번호를 각각 $_GET[“num”], $_GET[“page”]로 전달받음
                $num = $_GET["num"];
                $page = $_GET["page"];

                $con = mysqli_connect("localhost", "user1", "12345", "music"); // 레코드 번호 $num을 가진 레코드를 검색하여 $result에 저장
                $sql = "select * from gongiboard where num=$num";
                $result = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($result); // $result에서 데이터 가져오기
                $id = $row["id"];
                $name = $row["name"];
                $regist_day = $row["regist_day"];
                $subject = $row["subject"];
                $content = $row["content"];
                $file_name = $row["file_name"];
                $file_type = $row["file_type"];
                $file_copied = $row["file_copied"];
                $hit = $row["hit"];

                $content = str_replace(" ", "&nbsp;", $content); // 공백(“ ”)을 웹 페이지에 표시하기 위해 str_replace( ) 함수로 HTML 특수 기호인 &nbsp;로 변경. 같은 방식으로 줄 바꿈 코드인 \n은 HTML의 줄 바꿈 태그인 <br>로 변경
                $content = str_replace("\n", "<br>", $content);

                // 조회 수 값 증가와 DB 업데이트
                // 조회 수를 나타내는 $hit 값을 1 증가시키고 MySQL의 update 명령을 이용하여 board 테이블의 hit 필드를 업데이트.
                $new_hit = $hit + 1;
                $sql = "update gongiboard set hit=$new_hit where num=$num";
                mysqli_query($con, $sql);
                ?>		
                <ul id="view_content">
                    <li>
                        <!-- 제목, 글쓴이 이름, 작성 일시 출력
                        게시글 제목($subject), 글쓴이 이름($name), 작성 일시($regist_day) 출력. -->
                        <span class="col1"><b>제목 :</b> <?= $subject ?></span>
                        <span class="col2"><?= $name ?> | <?= $regist_day ?></span>
                    </li>
                    <li>
                        <?php
                        if ($file_name) {
                            /* 첨부 파일 정보 출력
                             * $file_name에 값이 설정되어 있으면 첨부 파일 존재. 게시글 제목 아래에 파일명($file_name)과 파일크기($file_ size) 표시, 파일을 다운로드할 수 있게 <저장> 버튼에 board_download.php 링크. */
                            $real_name = $file_copied;
                            $file_path = "./data/" . $real_name;
                            $file_size = filesize($file_path);

                            echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                        }
                        ?>
                        <?= $content ?>
                        <!-- 글내용출력 -->
                    </li>		
                </ul>
                <!-- 버튼 삽입
                화면 하단에 <목록>, <수정>, <삭제>, <글쓰기> 버튼 삽입하고 해당 파일로 이동할 수 있는 링크설정. -->
                <ul class="buttons">
                    <li><button onclick="location.href = 'gongiboard_list.php?page=<?= $page ?>'">목록</button></li>
                    <?php
                    if ($userlevel == 1) {
                        ?>
                        <li><button onclick="location.href = 'gongiboard_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button></li>
                        <li><button onclick="location.href = 'gongiboard_delete.php?num=<?= $num ?>&page=<?= $page ?>'">삭제</button></li>
                        <?php
                    } else {
                        ?>
                        <a href="javascript:alert('관리자는 찜하기가 제한됩니다.')"></a>
                        <!--                        <a href="javascript:alert('관리자가 아니면 제한됩니다.')"><button>수정</button></a>
                                                <a href="javascript:alert('관리자가 아니면 제한됩니다.')"><button>삭제</button></a>-->
                        <?php
                    }
                    if ($userlevel != 1) {
                        ?>
                        <form name="member_form" method="post" action="zzim.php?subject=<?= $subject ?>" >    
                            <button onclick="location.href = 'zzim.php?num=<?= $num ?>'">찜하기(찜은 하나만 가능합니다!)</button>
                        </form>
                        <?php
                    }
                    ?>

                </ul>
            </div> <!-- board_box -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>
