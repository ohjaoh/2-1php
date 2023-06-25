<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>웹프로그래밍</title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/member.css">
        <script type="text/javascript" src="./js/member_modify.js"></script>
    </head>
    <body> 
        <header>
            <?php include "header.php"; ?>

        </header>
        <?php
        if (!$userid) {
            echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
            exit;
        }
        ?>
        <?php
        $con = mysqli_connect("localhost", "user1", "12345", "music");
        $sql = "select * from members where id='$userid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $name = $row["name"];
        $pass = $row["pass"];
        $phone_number = $row["phone_number"];
        $gender = $row["gender"];
        $address = $row["address"];
        $self_inproduce = $row["self_inproduce"];
        $represent_image = $row["represent_image"];
        $musician = $row["musician"];
        $zzim = $row["zzim"];

        mysqli_close($con);
        ?>
        <section>
            <div id="main_img_bar">
                <img src="./img/main_img.png">
            </div>
            <div id="main_content">
                <div id="join_box">
                    <form  name="member_form" method="post" action="member_modify.php?id=<?= $userid ?>">
                        <h2>회원정보확인</h2>
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <?= $userid ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div>
                            <div class="col1"> 대표이미지</div>
                            <img src="<?= $represent_image ?>" style="height: 200px; width: 200px;">
                        </div>

                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <?= $name ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <?= $pass ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">휴대전화번호</div>
                            <div class="col2">
                                0<?= $phone_number ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">성별</div>
                            <div class="col2">
                                <?php if ('남자' == $gender) echo "남자"; ?>
                                <?php if ('여자' == $gender) echo "여자"; ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">주소</div>
                            <div class="col2">
                                <?= $address ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">취미 관심분야 선택</div>
                            <div class="col2">
                                <?php
                                $hobbys = explode(",", $row['hobby']);
                                ?>
                                <input type="checkbox" name="hobby[]" value="재즈"<?php if (in_array('재즈', $hobbys)) echo " checked"; ?>>재즈
                                <input type="checkbox" name="hobby[]" value="클래식"<?php if (in_array('클래식', $hobbys)) echo " checked"; ?>>클래식
                                <input type="checkbox" name="hobby[]" value="팝"<?php if (in_array('팝', $hobbys)) echo " checked"; ?>>팝
                                <input type="checkbox" name="hobby[]" value="이디엠"<?php if (in_array('이디엠', $hobbys)) echo " checked"; ?>>이디엠
                                <input type="checkbox" name="hobby[]" value="아이돌"<?php if (in_array('아이돌', $hobbys)) echo " checked"; ?>>아이돌
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">가입인사 및 자기소개</div>
                            <div class="col2">
                                <?= $self_inproduce ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>

                        <div class="form">
                            <div class="col1">뮤지션 여부</div>
                            <div class="col2">
                                <?php if ('1' == $musician) echo "뮤지션입니다."; ?>
                                <?php if ('1' != $musician) echo "뮤지션이 아닙니다."; ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">찜목록</div>
                            <div class="col2">
                                <?= $zzim   ?>
                            </div>                 
                        </div>
                        <div class="clear"></div>


                        <div class="clear"></div>
                        <div class="bottom_line"> </div>
                    </form>
                </div> <!-- join_box -->
            </div> <!-- main_content -->
        </section> 
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>
</html>

