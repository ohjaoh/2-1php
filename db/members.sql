create table members (
    num int not null auto_increment,
    id char(15) not null, # 아이디
    name char(10) not null, # 이름
    pass char(15) not null, # 비번
    phone_number int(20) not null, # 휴대전화번호 '-'은 생략
    gender char(5) not null, # 성별 
    address char(50) not null, # 주소
    hobby char(50) not null, # 취미
    self_inproduce char(101), # 가입인사
    represent_image char(200), # 대표이미지
    musician int(2) not null, # 뮤지션여부
    zzim char(250),
    level int,
    point int,
    primary key(num)
);
# 아이디, 이름, 나이, 비밀번호, 비밀번호 확인, 핸드폰, 성별(라디오 버튼), 주소, 취미 관심분야