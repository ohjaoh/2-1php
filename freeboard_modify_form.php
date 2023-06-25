<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍기말</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/freeboard.css">
        <script>
            function check_input() {
                if (!document.freeboard_form.subject.value)
                {
                    alert("제목을 입력하세요!");
                    document.freeboard_form.subject.focus();
                    return;
                }
                if (!document.freeboard_form.content.value)
                {
                    alert("내용을 입력하세요!");
                    document.freeboard_form.content.focus();
                    return;
                }
                document.freeboard_form.submit();
            }
        </script>
    </head>
    <body> 
        <header>
            <?php include "header.php"; ?>
        </header>  
        <section>
            <div id="main_img_bar">
                <img src="./img/main_img.png">
            </div>
            <div id="freeboard_box">
                <h3 id="freeboard_title">
                    게시판 > 글 쓰기
                </h3>
                <?php
                // 레코드 번호와 페이지번호 전달받기
                $num = $_GET["num"];
                $page = $_GET["page"];

                // DB에서 글 정보 가져오기
                $con = mysqli_connect("localhost", "user1", "12345", "music");
                $sql = "select * from freeboard where num=$num";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $name = $row["name"];
                $subject = $row["subject"];
                $content = $row["content"];
                $file_name = $row["file_name"];
                ?>
                <!-- <수정하기> 버튼을 클릭했을 때 DB에 저장된 글을 수정할 수 있도록 action 속성을 freeboard_modify.php?num=<?=$num?>&page=<?=$page?>로 지정. freeboard_modify.php 파일에서 글 수정 폼 양식의 데이터를 전달받아 DB를 업데이트한다는 의미.  -->
                <form  name="freeboard_form" method="post" action="freeboard_modify.php?num=<?= $num ?>&page=<?= $page ?>" enctype="multipart/form-data">
                    <ul id="freeboard_form">
                        <li>
                            <!--이름출력-->
                            <span class="col1">이름 : </span>
                            <span class="col2"><?= $name ?></span>
                        </li>		
                        <li>
                            <!--제목출력-->
                            <span class="col1">제목 : </span>
                            <span class="col2"><input name="subject" type="text" value="<?= $subject ?>"></span>
                        </li>	    	
                        <li id="text_area">	
                            <!--다중 입력 창에 글 내용 삽입-->
                            <span class="col1">내용 : </span>
                            <span class="col2">
                                <textarea name="content"><?= $content ?></textarea>
                            </span>
                        </li>
                        <li>
                            <span class="col1"> 첨부 파일 : </span>
                            <span class="col2"><?= $file_name ?></span>
                        </li>
                    </ul>
                    <ul class="buttons">
                        <li><button type="button" onclick="check_input()">수정하기</button></li>
                        <li><button type="button" onclick="location.href = 'freeboard_list.php'">목록</button></li>
                    </ul>
                </form>
            </div> <!-- freeboard_box -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>
