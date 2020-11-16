<?php
    include "connection.php";
    
    // sql to create table
    $sql = "CREATE TABLE Area(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                area VARCHAR(30) NOT NULL
                );
            CREATE TABLE StoreType(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                store_type VARCHAR(30) NOT NULL
                );
            CREATE TABLE CustomerInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                age INT UNSIGNED NOT NULL,
                store_type INT,
                sex INT UNSIGNED NOT NULL,
                customer_name VARCHAR(30) NOT NULL,
                FOREIGN KEY (store_type) REFERENCES StoreType (id) ON DELETE SET NULL ON UPDATE CASCADE,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE RestAreaInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                area INT,
                FOREIGN KEY (area) REFERENCES Area (id) ON DELETE CASCADE ON UPDATE CASCADE,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE StoreInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                store_name VARCHAR(30) NOT NULL,
                store_type INT, 
                FOREIGN KEY (store_type) REFERENCES StoreType (id) ON DELETE SET null ON UPDATE CASCADE,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE WholeStore(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                ra_id INT, store_id INT, area_id INT, sales INT,
                FOREIGN KEY(ra_id) REFERENCES RestAreaInfo (id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY(store_id) REFERENCES StoreInfo (id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY(area_id) REFERENCES Area (id) ON DELETE CASCADE ON UPDATE CASCADE)";

    if (mysqli_multi_query($conn, $sql)) {
        do {
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                    printf("%s\n", $row[0]); 
                }
                mysqli_free_result($result); 
            }
        }
     while (mysqli_next_result($conn));}
    
    
    // create new connection for insert
    $conn = mysqli_connect($servername, $username, $password, "myDB");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    //insert data
    $sql = "INSERT INTO Area (area) VALUES
                ('서울경기'),('부산경상'),('강원'),('충청'),('전라');
            INSERT INTO StoreType (store_type) VALUES
                ('한식'),('카페'),('분식'),
                ('중식'),('양식'),('일식'),
                ('간식'),('편의점'),('기타');
            INSERT INTO RestAreaInfo (name, area) VALUES
                ('시흥하늘휴게소',1),('구리(일산)휴게소',1),
                ('죽전(서울)휴게소',1),('선산(양평)휴게소',1),
                ('안성맞춤(평택)휴게소',1),('통도사(부산)휴게소',2),
                ('사천(부산)휴게소',2),('현풍(대구)휴게소',2),
                ('칠곡(부산)휴게소',2),('영천(대구)휴게소',2),
                ('함평나비(광주)휴게소',5),('정읍녹두장군(천안)휴게소',5),
                ('보성녹차(순천)휴게소',5),('강천산(광주)휴게소',5),
                ('청주(서울)휴게소',4),('옥산(부산)휴게소',4),
                ('공주(대전)휴게소',4),('천등산(평택)휴게소',4),
                ('예산(당진)휴게소',4),('내린천휴게소',3),
                ('홍천(양양)휴게소',3),('문막(강릉)휴게소',3),
                ('옥계(속초)휴게소',3),('평창(강릉)휴게소',3);
            INSERT INTO StoreInfo (store_name, store_type) VALUES
                ('CU',2),('우동전문점',7),('로띠번',2),('파스쿠치',1),
                ('공주밤나무',7),('자율식당',2),('롯데리아',1),('평창반상',3),
                ('공차',3),('죠이마트',7),('리던',1),('풍경마루',1),
                ('나주곰탕',8),('즉석코너',7),('만쥬리아',4),('의류매장',7),
                ('임금님밥상',3),('찹쌀닭강정',2),('미스터짬뽕라면',2),('한과',5),
                ('중화요리',2),('카페베네',2),('미스터톡톡',2),('한식전문점',1),
                ('놀부부대찌개',7),('커피딜라이트',2),('바른김밥김선생',3),('할리스커피',2),
                ('던킨도너츠',7),('코바코',3),('별미우동',1),('호두과자',1),
                ('델리쉐프',1),('탐앤탐스',1),('뽀끼뽀기',1),('효원당',7),
                ('드롭탑',7),('파리바게트',3),('스낵(라면)',8),('양식전문점',1),
                ('애플돈가스',3),('우동김밥전문점',7),('신서방왕만두',1),('열린매장',9);
            INSERT INTO WholeStore (ra_id, store_id, area_id, sales) VALUES
                (14,1,5,31300),(13,30,5,46500),(15,43,4,21200),(16,23,4,69800),
                (14,2,5,52600),(7,31,2,36400),(15,44,4,79300),(16,24,4,15900),
                (14,3,5,97200),(7,32,2,72200),(15,1,4,57500),(16,25,4,59900),
                (14,4,5,4600),(7,33,2,55300),(15,2,4,40800),(16,26,4,11900),
                (14,5,5,47800),(7,34,2,54300),(9,3,2,94700),(12,27,5,97800),
                (17,6,4,89200),(7,35,2,87800),(9,4,2,75700),(12,28,5,84300),
                (17,7,4,78100),(4,36,1,27100),(9,5,2,68000),(12,29,5,4700),
                (17,8,4,65600),(4,37,1,67300),(9,6,2,31300),(12,30,5,28200),
                (17,9,4,67600),(4,38,1,76100),(9,7,2,97000),(12,31,5,63600),
                (17,10,4,95800),(4,39,1,84100),(6,8,2,34400),(3,32,1,2800),
                (2,11,1,31800),(4,40,1,76200),(6,9,2,81600),(3,33,1,38000),
                (2,12,1,23300),(1,41,1,18100),(6,10,2,72100),(3,34,1,3200),
                (2,13,1,30000),(1,42,1,14500),(6,11,2,37200),(8,25,2,75400),
                (2,14,1,17100),(1,43,1,12200),(6,12,2,64800),(8,26,2,38800),
                (2,15,1,53800),(1,44,1,88700),(24,13,3,30600),(8,27,2,18100),
                (20,16,3,53700),(1,1,1,93800),(24,14,3,56500),(21,28,3,30400),
                (20,17,3,67700),(5,2,1,68100),(24,15,3,85900),(21,29,3,6100),
                (20,18,3,32600),(5,3,1,54500),(24,16,3,74200),(21,30,3,40600),
                (20,19,3,79500),(5,4,1,36200),(24,17,3,21600),(21,31,3,39800),
                (20,20,3,25100),(5,5,1,1500),(11,18,5,50500),(21,32,3,25300),
                (22,21,3,21300),(5,6,1,12600),(11,19,5,40400),(15,42,4,87600),
                (22,22,3,72700),(10,7,2,46800),(11,20,5,45700),(16,22,4,78800),
                (22,23,3,17900),(10,8,2,47100),(11,21,5,44400),(23,17,3,38500),
                (22,24,3,59500),(10,9,2,72100),(11,22,5,50700),(23,18,3,63700),
                (22,25,3,56700),(10,10,2,33600),(8,23,2,45700),(23,19,3,63400),
                (13,26,5,29400),(10,11,2,73000),(8,24,2,2800),(23,20,3,97000),
                (13,27,5,75300),(19,12,4,87600),(18,37,4,10300),(23,21,3,10700),
                (13,28,5,43200),(19,13,4,61000),(18,38,4,8900),(18,40,4,69600),
                (13,29,5,55300),(19,14,4,46600),(18,39,4,31200),(18,41,4,74300),
                (3,35,1,51900),(19,15,4,72300),(3,36,1,83100),(19,16,4,66100);
                 INSERT INTO CustomerInfo (age, store_type, sex, customer_name) VALUES 
                 (17,2,2,'김지수'),(46,1,2,'김진유'),(44,7,1,'강동호'),
                 (31,2,2,'김지민'),(31,1,1,'김태원'),(20,7,2,'최지수'),
                 (52,1,2,'김민지'),(25,1,1,'차은우'),(40,3,1,'김준식'),
                 (27,2,2,'김수연'),(35,2,2,'박나래'),(15,5,1,'성동일'),
                 (46,1,1,'고경표'),(20,7,2,'혜리'),(30,3,1,'류준열'),
                 (37,1,1,'고수몽'),(40,2,2,'한가인'),(62,1,2,'김태희'),
                 (48,1,1,'유재석'),(55,1,1,'나재민'),(23,7,2,'임윤선'),
                 (19,2,1,'박광일'),(31,2,2,'고란희'),(63,1,1,'곽두팔'),
                 (30,8,1,'오팔순'),(22,7,2,'임라라'),(44,1,2,'한혜진'),
                 (7,8,1,'김도완'),(10,1,2,'원유선'),(5,1,2,'김해인'),
                 (30,3,2,'권세린'),(22,9,2,'박소영'),(44,1,1,'곽철용'),
                 (37,7,1,'하정우'),(17,7,1,'김태엽'),(30,1,2,'백재희');";
//1은남자

    $res = mysqli_multi_query($conn, $sql);
    if ($res === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>