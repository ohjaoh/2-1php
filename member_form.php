<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍기말</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/member.css">
        <script>
            function check_input()
            {
                if (!document.member_form.id.value) {
                    alert("아이디를 입력하세요!");
                    document.member_form.id.focus();
                    return;
                }
                if (!document.member_form.name.value) {
                    alert("이름을 입력하세요!");
                    document.member_form.name.focus();
                    return;
                }

                if (!document.member_form.pass.value) {
                    alert("비밀번호를 입력하세요!");
                    document.member_form.pass.focus();
                    return;
                }

                if (!document.member_form.pass_confirm.value) {
                    alert("비밀번호확인을 입력하세요!");
                    document.member_form.pass_confirm.focus();
                    return;
                }
                if (!document.member_form.address.value) {
                    alert("주소를 입력하세요!");
                    document.member_form.address.focus();
                    return;
                }

                if (document.member_form.pass.value !=
                        document.member_form.pass_confirm.value) {
                    alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                    document.member_form.pass.focus();
                    document.member_form.pass.select();
                    return;
                }

                document.member_form.submit();
            }


            function check_id() {
                window.open("member_check_id.php?id=" + document.member_form.id.value,
                        "IDcheck",
                        "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
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
            <div id="main_content">
                <div id="join_box">
                    <form  name="member_form" method="post" action="member_insert.php" enctype="multipart/form-data">
                        <h2>회원 가입</h2>
                        <div class="form">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id">
                            </div>  
                            <div class="col3">
                                <a href="#"><img src="./img/check_id.gif" 
                                                 onclick="check_id()"></a>
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <input type="text" name="name">
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <input type="password" name="pass">
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호 확인</div>
                            <div class="col2">
                                <input type="password" name="pass_confirm">
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">핸드폰('-'제외)</div>
                            <div class="col2">
                                <input type="text" name="phone_number">
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">성별</div>
                            <div class="col2">
                                <input type="radio" name="gender" value="남자"> 남자
                                <input type="radio" name="gender" value="여자"> 여자
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">주소</div>
                            <div class="col2">
                                <input type="text" name="address">
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">취미 관심분야 선택</div>
                            <div class="col2">
                                <input type="checkbox" name="hobby[]" value="재즈">재즈
                                <input type="checkbox" name="hobby[]" value="클래식">클래식
                                <input type="checkbox" name="hobby[]" value="팝">팝
                                <input type="checkbox" name="hobby[]" value="이디엠">이디엠
                                <input type="checkbox" name="hobby[]" value="아이돌">아이돌
                            </div>
                        </div>
                        <div class="clear"></div>


                        <div class="form">
                            <div class="col1">가입인사 및 자기소개</div>
                            <div class="col2">
                                <input type="text" name="self_inproduce">
                            </div>                 
                        </div>
                        <div class="clear"></div>


                        <div class="form">
                            <div class="col1">뮤지션 여부(맞으면1, 아니면 0)</div>
                            <div class="col2">
                                <input type="text" name="musician">
                            </div>                 
                        </div>
                        <div class="clear"></div>                      

                        <div class="form">
                            <div class="col1"> 대표이미지 첨부<br>주의! 수정불가! </div>
                            <div class="col2">
                                <input type="file" name="upfile">
                            </div>                 
                        </div>
                        <div class="clear"></div>


                        <div class="clear"></div>
                        <div class="bottom_line"> </div>
                        <div class="buttons">
                            <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
                        </div>
                    </form>

                </div> <!-- join_box -->
            </div> <!-- main_content -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>