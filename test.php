<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "myDB";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, "myDB");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    // sql to create table
    $sql = "CREATE TABLE Area(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                area VARCHAR(30) NOT NULL
                );
            CREATE TABLE StoreType(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                store_type VARCHAR(30) NOT NULL
                );
            CREATE TABLE ProductInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                product_name VARCHAR(30) NOT NULL,
                price int(6) UNSIGNED NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE CustomerInfo(
                customer_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                age INT UNSIGNED NOT NULL,
                store_type INT,
                FOREIGN KEY (store_type) REFERENCES StoreType (id),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE RestAreaInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                area INT,
                FOREIGN KEY (area) REFERENCES Area (id),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE StoreInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                store_name VARCHAR(30) NOT NULL,
                ra_id INT,
                FOREIGN KEY (ra_id) REFERENCES RestAreaInfo (id),
                product_id INT,
                FOREIGN KEY (product_id) REFERENCES ProductInfo (id),
                store_type INT, 
                FOREIGN KEY (store_type) REFERENCES StoreType (id),
                ranking INT NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );";

    if (mysqli_multi_query($conn, $sql)) {
        do {
            /* store first result set */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                    printf("%s\n", $row[0]); // Or whatever...
                }
                mysqli_free_result($result); // Free in order to store the next
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
            INSERT INTO ProductInfo (id, product_name, price) VALUES
                (1,'완제음료',1000),(2,'닭강정',3000),
                (3,'만두(8개)',3000),(4,'야채청과',10000),
                (5,'호도과자',4000),(6,'레몬티/드롭탑',4000),
                (7,'소떡소떡',3500),(8,'빅수제어묵',3500),
                (9,'만쥬리아',3500),(10,'옛날핫도그',3500),
                (11,'단배추바지락된장국',7500),(12,'가락속풀이생라면',5000),
                (13,'아메리카노',4100),(14,'공기밥(자율) ',1000),
                (16,'뚝배기불고기 ',8000),(17,'해물순두부',7500),
                (18,'순두부짬뽕',7000),(19,'사태김치찌개',7000),
                (20,'안성국밥',8000),(21,'로띠번',2000),
                (22,'소떡소떡',3500),(23,'수제돈가스우동정식',8000),
                (24,'명품낙지덮밥',8000),(25,'1등급한우국밥',9000),
                (26,'흑돼지김치찌개',7000),(27,'옛날제육덮밥',8000),
                (28,'산채비빔밥',6000),(29,'진영단감왕갈비찜',8000),
                (30,'충청도식돼지짜글이비빔밥',7500),(31,'돈육김치찌개',8000),
                (32,'춘천막국수+현풍돈가스',7000),(33,'에쎄엣지필드 ',4500),
                (34,'공기밥(자율) ',1000),(35,'가락속풀이생라면',4500),
                (36,'사골육개장 ',7000),(37,'제육덮밥정식',7000),
                (38,'코바코 수제등심돈가스',5600),(39,'돈가스',7000),
                (40,'순두부찌개',6600),(41,'제육덮밥',8500),
                (42,'비빔밥',8000),(43,'보성꼬막비빔밥',8000),
                (44,'김치찌개',7500),(45,'순희치즈핫도그',3000),
                (46,'차돌박이된장찌게',6800),(47,'로띠번',2000),
                (48,'순창고추장돌솥비빔밥',8800),(49,'장터국밥',6000),
                (50,'제육정식',7000),(51,'김치찌개',6000),
                (52,'돼지돈가스',8000),(53,'묵은지꽁치찌개',7500),
                (54,'놀부부대찌개',9300),(55,'뚝배기불고기',8500),
                (56,'공주알밤빵(대)',4000),(57,'공주알밤빵(선물용)',10000),
                (58,'공주군밤',3500),(59,'그린 밀크티 (L)',4400),
                (60,'ICE-얼그레이',4300),(61,'등심돈가스',6600),
                (62,'제육돌솥비빔밥',6000),(63,'아이스녹차(커피니)',4100),
                (64,'사골우거지국밥',6500),(65,'애플수제등심돈가스',7000),
                (66,'의류',10000),(67,'라면정식',4500),
                (68,'흑돼지김치제육덮밥(한)',4500),(69,'떡라면',5000),
                (70,'바른김밥(바)',3600),(71,'시래기국밥',6600),
                (72,'내촌한우국밥',8000),(73,'불고기버거세트',5600),
                (74,'산들비빔밥',6500),(75,'버섯제육덮밥 ',6000), 
                (76,'흑돼지돈가스',8000),(77,'소고기국밥',8300);
            INSERT INTO CustomerInfo (customer_id, age, store_type) VALUES
                (101,17,2),(102,46,1),(103,44,7),
                (104,31,2),(105,31,1),(106,20,7),
                (107,52,1),(108,25,1),(109,40,3),
                (110,27,2),(111,35,2),(112,15,5),
                (113,46,1),(114,20,7),(115,30,3),
                (116,37,1),(117,40,2),(118,62,1),
                (119,48,1),(120,55,1),(121,23,7),
                (122,19,2),(123,31,2),(124,63,1),
                (125,30,8),(126,22,7),(127,44,1),
                (128,37,7),(129,17,7),(130,30,1);
            INSERT INTO RestAreaInfo (name, area) VALUES
                ('시흥하늘휴게소',1),
                ('구리(일산)휴게소',1),
                ('죽전(서울)휴게소',1),
                ('선산(양평)휴게소',1),
                ('안성맞춤(평택)휴게소',1),
                ('통도사(부산)휴게소',2),
                ('사천(부산)휴게소',2),
                ('현풍(대구)휴게소',2),
                ('칠곡(부산)휴게소',2),
                ('영천(대구)휴게소',2),
                ('함평나비(광주)휴게소',5),
                ('정읍녹두장군(천안)휴게소',5),
                ('보성녹차(순천)휴게소',5),
                ('강천산(광주)휴게소',5),
                ('청주(서울)휴게소',4),
                ('옥산(부산)휴게소',4),
                ('공주(대전)휴게소',4),
                ('천등산(평택)휴게소',4),
                ('예산(당진)휴게소',4),
                ('내린천휴게소',3),
                ('홍천(양양)휴게소',3),
                ('문막(강릉)휴게소',3),
                ('옥계(속초)휴게소',3),
                ('평창(강릉)휴게소',3);
            INSERT INTO StoreInfo (store_name, ra_id, product_id, store_type, ranking) VALUES
                ('파리바게트',1,1,2,1),
                ('찹쌀닭강정',1,2,7,2),
                ('신서방왕만두',1,3,3,3),
                ('CU',1,4,8,4),
                ('효원당',1,5,3,5),
                ('드롭탑',2,6,2,1),
                ('델리쉐프',2,7,7,2),
                ('델리쉐프',2,8,7,3),
                ('만쥬리아',2,9,7,4),
                ('델리쉐프',2,10,7,5),
                ('자율식당',3,11,1,1),
                ('호도과자코너',3,5,7,2),
                ('우동전문점',3,12,6,3),
                ('할리스커피',3,13,2,4),
                ('자율식당',3,14,1,5),
                ('카페드롭탑',4,13,2,1),
                ('한식전문점',4,15,1,2),
                ('한식전문점',4,16,1,3),
                ('미스터짬뽕라면',4,17,4,4),
                ('한식전문점',4,18,1,5),
                ('한식전문점',5,19,1,1),
                ('할리스',5,13,2,2),
                ('로띠번',5,20,2,3),
                ('가판',5,7,3,4),
                ('한식당',5,22,1,5),
                ('한식전문점',6,23,1,1),
                ('한식전문점',6,24,1,2),
                ('호두코너',6,5,7,3),
                ('커피딜라이트',6,13,2,4),
                ('한식전문점',6,25,1,5),
                ('할리스커피',7,13,2,1),
                ('한식전문점',7,26,1,2),
                ('즉석코너',7,7,3,3),
                ('한식전문점',7,27,1,4),
                ('한식전문점',7,76,1,5),
                ('풍경마루',8,28,1,1),
                ('탐앤탐스',8,13,2,2),
                ('풍경마루',8,29,1,3),
                ('풍경마루',8,30,1,4),
                ('코바코',8,31,1,5),
                ('죠이마트',9,32,8,1),
                ('자율식당',9,33,1,2),
                ('우동김밥전문점',9,34,3,3),
                ('호도/잡화',9,5,7,4),
                ('자율식당',9,35,1,5),
                ('탐앤탐스',10,13,2,1),
                ('한식전문점',10,36,1,2),
                ('한식전문점',10,37,1,3),
                ('열린매장',10,7,7,4),
                ('한식전문점',10,76,1,5),
                ('탐앤탐스',11,13,2,1),
                ('한식전문점',11,38,1,2),
                ('한식전문점',11,39,1,3),
                ('열린매장',11,7,7,4),
                ('한식전문점',11,76,1,5),
                ('탐앤탐스',12,13,2,1),
                ('한식전문점',12,39,1,2),
                ('한식전문점',12,40,1,3),
                ('탐앤탐스',12,13,2,4),
                ('한식전문점',12,41,1,5),
                ('한식전문점',13,42,1,1),
                ('할리스',13,13,2,2),
                ('한식전문점',13,43,1,3),
                ('미스터톡톡',13,44,7,4),
                ('한식전문점',13,39,1,5),
                ('한식전문점',14,45,1,1),
                ('리던',14,13,2,2),
                ('로띠번',14,46,2,3),
                ('한식전문점',14,47,1,4),
                ('가판',14,7,3,5),
                ('한식전문점',15,48,1,1),
                ('나주곰탕',15,49,1,2),
                ('호두과자',15,5,7,3),
                ('한식전문점',15,50,1,4),
                ('양식전문점',15,51,5,5),
                ('한식전문점',16,52,1,1),
                ('한식전문점',16,76,1,2),
                ('놀부부대찌개',16,53,1,3),
                ('던킨도너츠',16,13,7,4),
                ('한식전문점',16,54,1,5),
                ('공주밤나무',17,55,7,1),
                ('카페베네',17,13,2,2),
                ('공주밤나무',17,56,7,3),
                ('공주밤나무',17,57,7,4),
                ('공차',17,58,2,5),
                ('파스쿠치',18,59,2,1),
                ('양식전문점',18,60,5,2),
                ('한식전문점',18,61,1,3),
                ('파스쿠치',18,62,2,4),
                ('한식전문점',18,63,1,5),
                ('애플돈가스',19,64,3,1),
                ('할리스',19,13,2,2),
                ('한식전문점',19,39,1,3),
                ('의류매장01',19,65,9,4),
                ('스낵(라면)',19,66,3,5),
                ('내린천한식',20,67,1,1),
                ('코바코 라면',20,68,3,2),
                ('탐앤탐스',20,13,2,3),
                ('바른김밥김선생',20,69,3,4),
                ('내린천한식',20,70,1,5),
                ('뽀끼뽀기',21,7,3,1),
                ('할리스',21,13,2,2),
                ('할리스',21,13,2,3),
                ('호두과자',21,5,7,4),
                ('호두과자',21,5,7,5),
                ('별미우동',22,71,1,1),
                ('한과',22,5,7,2),
                ('가판',22,7,7,3),
                ('롯데리아',22,72,5,4),
                ('별미우동',22,73,1,5),
                ('드롭탑',23,13,2,1),
                ('드롭탑',23,13,2,2),
                ('한식전문점',23,74,1,3),
                ('델리쉐프',23,7,7,4),
                ('코바코돈까스',23,76,5,5),
                ('가판',24,7,7,1),
                ('평창반상',24,76,1,2),
                ('탐앤탐스',24,13,2,3),
                ('호두과자',24,5,7,4),
                ('탐앤탐스',24,13,2,5);";
        
    $res = mysqli_multi_query($conn, $sql);
    if ($res === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>