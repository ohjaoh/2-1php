<?php
session_start();
if (isset($_SESSION["userid"]))
    $userid = $_SESSION["userid"];
else
    $userid = "";

if (isset($_SESSION["username"]))
    $username = $_SESSION["username"];
else
    $username = "";

if (isset($_SESSION["userlevel"]))
    $userlevel = $_SESSION["userlevel"];
else
    $userlevel = "";

if (isset($_SESSION["usermusician"]))
    $usermusician = $_SESSION["usermusician"];
else
    $usermusician = "";

if (isset($_SESSION["userpoint"]))
    $userpoint = $_SESSION["userpoint"];
else
    $userpoint = "";
?>		
<div id="top">
    <h3>
        <a href="index.php">웹프로그래밍기말</a>
    </h3>
    <ul id="top_menu">  
        <?php
        if (!$userid) {
            ?>                
            <li><a href="member_form.php">회원 가입</a> </li>
            <li> | </li>
            <li><a href="login_form.php">로그인</a></li>
            <li> | </li>
            <li><a href="member_information.php">개인정보확인</a></li>
            <?php
        } else {
            if ($userlevel == '1') {
                $logged = $username . "(" . $userid . ")님은 관리자입니다. 보유 Point:" . $userpoint . "";
            } else if ($usermusician == '1') {
                $logged = $username . "(" . $userid . ")님은 뮤지션입니다. 보유 Point:" . $userpoint . "";
            } else {
                $logged = $username . "(" . $userid . ")님은 일반사용자입니다. 보유 Point:" . $userpoint . "";
            }
            ?>
            <li><?= $logged ?> </li>
            <li> | </li>
            <li><a href="logout.php">로그아웃</a> </li>
            <li> | </li>
            <li><a href="member_modify_form.php">정보 수정</a></li>
            <li> | </li>
            <li><a href="member_information.php">개인정보확인</a></li>
            <?php
        }
        ?>
        <?php
        if ($userlevel == 1) {
            ?>
            <li> | </li>
            <li><a href="admin.php">관리자 모드</a></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="menu_bar">
    <ul>  
        <li><a href="index.php">HOME</a></li>
        <li><a href="message_form.php">메시지</a></li>
        <li><a href="gongiboard_list.php">공지게시판</a></li>
        <li><a href="musicboard_list.php">뮤지션게시판</a></li>
        <li><a href="freeboard_list.php">자유게시판</a></li>
    </ul>
</div>