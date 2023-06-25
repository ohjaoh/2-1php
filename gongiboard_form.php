<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍기말</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/gongiboard.css">
        <script>
            function check_input() {
                if (!document.gongiboard_form.subject.value)
                        /* 글쓰기 폼 양식 하단의 <완료> 버튼 클릭하면 호출되는 check_input() 함수 정의 
                         * 사용자가 입력 창에 내용을 입력했는지 검사.
                         * 이상이 없으면 <form>문의 ACTION에 설정한 gongiBOARD_INSERT.PHP로 이동. */
                        {
                            alert("제목을 입력하세요!");
                            document.gongiboard_form.subject.focus();
                            return;
                        }
                if (!document.gongiboard_form.content.value)
                {
                    alert("내용을 입력하세요!");
                    document.gongiboard_form.content.focus();
                    return;
                }
                document.gongiboard_form.submit();
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
            <div id="gongiboard_box">
                <h3 id="gongiboard_title">
                    게시판 > 글 쓰기
                </h3>
                <form  name="gongiboard_form" method="post" action="gongiboard_insert.php" enctype="multipart/form-data">
                    <!-- <form> 태그의 name 속성값인 gongiboard_form은 check_input()함수에서 사용.
                         파일 첨부 기능을 사용할 때는 enctype 속성을 multipart/form-data로 설정-->
                    <ul id="gongiboard_form">
                        <li>
                            <span class="col1">이름 : </span>
                            <span class="col2"><?= $username ?></span>
                        </li>		
                        <li>
                            <span class="col1">제목 : </span>
                            <span class="col2"><input name="subject" type="text"></span>
                            <!-- 글제목 설정 글쓰기 폼 양식에서 제목 입력 창의 name 속성을 subject로 설정
                            사용자가 입력한 제목이 POST 방식인 $_POST["subject"]로 gongiboard_insert.php에 전달됨. -->
                        </li>	    	
                        <li id="text_area">	
                            <span class="col1">내용 : </span>
                            <span class="col2">
                                <textarea name="content"></textarea>
                                <!-- 사용자가 입력한 글 내용이 $_POST["content"]로 gongiboard_insert.php에 전달 -->
                            </span>
                        </li>
                        <li>
                            <span class="col1"> 첨부 파일</span>
                            <span class="col2"><input type="file" name="upfile"></span>
                            <!-- <input> 태그의 type 속성을 file로 설정하면 업로드 파일을 선택할 수 있는 <찾아보기> 버튼 생성.
                            name 속성값인 upfile은 첨부 파일을 서버에 업로드할 때 사용됨.-->
                        </li>
                    </ul>
                    <ul class="buttons">
                        <li><button type="button" onclick="check_input()">완료</button></li>
                        <li><button type="button" onclick="location.href = 'gongiboard_list.php'">목록</button></li>
                    </ul>
                </form>
            </div> <!-- gongiboard_box -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>
