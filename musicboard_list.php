<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍기말</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/musicboard.css">
    </head>
    <body> 
        <header>
            <?php include "header.php"; ?>
        </header>  
        <section>
            <div id="main_img_bar">
                <img src="./img/main_img.png">
            </div>
            <div id="musicboard_box">
                <h3>
                    뮤지션게시판 > 목록보기
                </h3>
                <ul id="musicboard_list">
                    <li>
                        <span class="col1">번호</span>
                        <span class="col2">제목</span>
                        <span class="col3">글쓴이</span>
                        <span class="col4">첨부</span>
                        <span class="col5">등록일</span>
                        <span class="col6">조회</span>
                    </li>
                    <?php
                    if (isset($_GET["page"]))
                    /* GET 방식으로 페이지 번호 전달받기
                     * $_GET["page"]에 값이 설정되어있는지 isset()함수로 검사
                     * 값이 설정되어 있으면 페이지 번호인 $page에 $_GET[“page”] 저장, 설정되어 있지 않으면 1을 초깃값으로 저장. */
                        $page = $_GET["page"];
                    else
                        $page = 1;

                    $con = mysqli_connect("localhost", "user1", "12345", "music");
                    /* DB에서 전체 게시글 가져오기
                      • musicboard 테이블에서 레코드 일련번호인 num을 기준으로 내림차순한 전체 레코드를 가져와 $result에 저장.
                      • mysqli_num_rows( ) 함수를 이용하여 전체 레코드 수(게시글 수)를 $total_record에 저장.
                     */
                    $sql = "select * from musicboard  order by num desc";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result); // 전체 글 수

                    $scale = 10; //한 페이지에 표시되는 행의 개수
                    // 전체 페이지 수($total_page) 계산 
                    if ($total_record % $scale == 0) // $total_page, $start, $number는 전체 페이지 수, 시작 레코드 번호, 화면에 표시되는 글의 일련번호를 의미.
                        $total_page = floor($total_record / $scale);
                    else
                        $total_page = floor($total_record / $scale) + 1;

                    // 표시할 페이지($page)에 따라 $start 계산  
                    $start = ($page - 1) * $scale;

                    $number = $total_record - $start;

                    for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) { // DB에서 글목록을 가져오기 위한 루프설정.
                        mysqli_data_seek($result, $i);
                        // 가져올 레코드로 위치(포인터) 이동
                        $row = mysqli_fetch_array($result);
                        /* 글 목록의 항목 가져오기
                          • mysqli_fetch_array( ) 함수로 글 목록의 한 행, 즉, 레코드 하나를 가져와 $row에 저장.
                         * $row[“num”], $row[“id”], $row{“name”], $row[“subject”], $row[“regist_day”], $row[“hit”]는 레코드 일련번호, 글쓴이 아이디, 글쓴이 이름, 제목, 작성 일시, 조회 수 의미 */
                        // 하나의 레코드 가져오기
                        $num = $row["num"];
                        $id = $row["id"];
                        $name = $row["name"];
                        $subject = $row["subject"];
                        $regist_day = $row["regist_day"];
                        $hit = $row["hit"];
                        
                        /* 첨부 파일 존재 시 아이콘 표시
                         * 첨부 파일 있는 게시글에는 첨부 파일 아이콘 표시.
                         * $row[“file_name”]은 업로드 파일명을 나타냄. 
                         * 업로드 파일이 존재하면 $file_image에 HTML 코드인 <img src=‘./img/file.gif’>를 저장하고 그렇지 않으면 공백인 “ ” 저장 */

                        if ($row["file_name"])
                            $file_image = "<img src='./img/file.gif'>";
                        else
                            $file_image = " ";
                        ?>
                        <li>
                            <span class="col1"><?= $number ?></span> 
                            <!-- 글 목록의 각 항목을 화면에 출력. $number는 게시글 번호, $subject는 제목, $name은 글쓴이, $file_image는 첨부 파일 아이콘을 삽입하는 문자열, $regist_day는 작성 일시, $hit는 조회 수  -->
                            <span class="col2">
                                <a href="musicboard_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
                            <span class="col3"><?= $name ?></span>
                            <span class="col4"><?= $file_image ?></span>
                            <span class="col5"><?= $regist_day ?></span>
                            <span class="col6"><?= $hit ?></span>
                        </li>	
                        <?php
                        $number--;
                    }
                    mysqli_close($con);
                    ?>
                </ul>
                <ul id="page_num"> 	
                    <?php
                    if ($total_page >= 2 && $page >= 2) {
                        /* 페이지 번호 표시
                         * 글 목록 보기 페이지의 하단에 페이지 번호 출력. 현재 페이지 번호는 굵은 글씨체로 표시, 나머지 페이지 번호에는 해당 페이지로 이동하는 링크 설정.
                         *  2페이지 이상일 때는 ‘◀ 이전’, ‘다음 ▶’ 표시. 클릭 시 이전 페이지, 다음 페이지를 보여줌. */
                        $new_page = $page - 1;
                        echo "<li><a href='musicboard_list.php?page=$new_page'>◀ 이전</a> </li>";
                    } else
                        echo "<li>&nbsp;</li>";

                    // 게시판 목록 하단에 페이지 링크 번호 출력
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($page == $i) {     // 현재 페이지 번호 링크 안함
                            echo "<li><b> $i </b></li>";
                        } else {
                            echo "<li><a href='musicboard_list.php?page=$i'> $i </a><li>";
                        }
                    }
                    if ($total_page >= 2 && $page != $total_page) {
                        $new_page = $page + 1;
                        echo "<li> <a href='musicboard_list.php?page=$new_page'>다음 ▶</a> </li>";
                    } else
                        echo "<li>&nbsp;</li>";
                    ?>
                </ul> <!-- page -->	    	
                <ul class="buttons">
                    <li><button onclick="location.href = 'musicboard_list.php'">목록</button></li>
                    <!-- <목록>, <글쓰기> 버튼 삽입
                    <button> 태그로 <목록> 버튼 삽입. 버튼 클릭 시 글 목록 보기 페이지(musicboard_list.php)로 이동하도록 링크 설정.
                    <글쓰기> 버튼은 if문의 조건식에 있는 $userid가 값을 가질 때, 즉 로그인 상태에서만 글쓰기페이지(musicboard_form.php)로 이동하도록 설정. $userid에 값이 없으면 로그인 후 버튼을 클릭하라는 경고 창 띄움. -->
                    <li>
                        <?php
                        if ($usermusician == 1 || $userlevel == 1) {
                            ?>
                            <button onclick="location.href = 'musicboard_form.php'">글쓰기</button>
                            <?php
                        } else {
                            ?>
                            <a href="javascript:alert('일반회원은 글쓰기가 제한됩니다.')"><button>글쓰기</button></a>
                            <?php
                        }
                        ?>
                    </li>
                </ul>
            </div> <!-- musicboard_box -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>
