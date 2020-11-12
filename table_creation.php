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
                store_type VARCHAR(6) NOT NULL,
                );
            CREATE TABLE ProductInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                product_name VARCHAR(30) NOT NULL,
                price int(6) UNSIGNED NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE CustomerInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                age INT UNSIGNED NOT NULL,
                store_type INT,
                CONSTRAINT 'store_type_id'
                    FOREIGN KEY (store_type) REFERENCES StoreType (id),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE RestAreaInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(30) NOT NULL,
                area INT,
                CONSTRAINT 'area_id'
                    FOREIGN KEY (area) REFERENCES Area (id),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );
            CREATE TABLE StoreInfo(
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                store_name VARCHAR(30) NOT NULL,
                ra_id INT,
                product_id INT,
                store_type INT,
                product_ranking INT(6) UNSIGNED NOT NULL,
                CONSTRAINT 'rest_area_id'
                    FOREIGN KEY (ra_id) REFERENCES RestAreaInfo (id),
                CONSTRAINT 'product_id'
                    FOREIGN KEY (product_id) REFERENCES ProductInfo (id),
                CONSTRAINT 'store_type_id'
                    FOREIGN KEY (store_type) REFERENCES StoreType (id),
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                );";

    $res = mysqli_multi_query($conn, $sql);
    if ($res === TRUE) {
        echo "Table created successfully";
        } else {
        echo "Error creating table: " . mysqli_error($conn);
        }
    mysqli_close($conn);
    
    // create new connection for insert
    $conn = mysqli_connect($servername, $username, $password, "myDB");
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    //insert data
    $sql = "INSERT INTO Area (id, area) VALUES
                (1,'서울경기'),(2,'부산경상'),(3,3),(4,'충청'),(5,'전라');
            INSERT INTO StoreType (id, store_type) VALUES
                (1,'한식'),(2,'카페'),(3,'분식'),
                (4,'중식'),(5,'양식'),(6,'일식'),
                (7,'간식'),(8,'편의점'),(9,'기타'),
            INSERT INTO ProductInfo (id, product_name, price) VALUES
                (1,'완제음료',1000),(2,'닭강정',3000),
                (3,'만두(8개)',3000),(4,'야채청과','0000),
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
                (52,'돼지돈가스[8000]',8000),(53,'묵은지꽁치찌개',7500),
                (54,'놀부부대찌개',9300),(55,'뚝배기불고기',8500),
                (56,'공주알밤빵(대) ',4000),(57,'공주알밤빵(선물용) 공주알밤빵(선물용)','0000),
                (58,'공주군밤 ',3500),(59,'그린 밀크티 (L) ',4400),
                (60,'ICE-얼그레이',4300),(61,'등심돈가스',6600),
                (62,'제육돌솥비빔밥 제육돌솥비빔밥',6000),(63,'아이스녹차(커피니)',4100),
                (64,'사골우거지국밥',6500),(65,'애플수제등심돈가스',7000),
                (66,'의류','0000),(67,'라면정식',4500),
                (68,'흑돼지김치제육덮밥(한)',4500),(69,'떡라면(아)',5000),
                (70,'바른김밥(바)',3600),(71,'시래기국밥(한)',6600),
                (72,'내촌한우국밥',8000),(73,'불고기버거세트',5600),
                (74,'산들비빔밥',6500),(75,'버섯제육덮밥 ',6000), 
                (76,'흑돼지돈가스',8000),(77,'소고기국밥',8300);
            INSERT INTO CustomerInfo (customer_id, age, store_id) VALUES
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
            INSERT INTO RestAreaInfo (id, ra_name, area) VALUES
                ('RA01','시흥하늘휴게소',1),
                ('RA02','구리(일산)휴게소',1),
                ('RA03','죽전(서울)휴게소',1),
                ('RA04','선산(양평)휴게소',1),
                ('RA05','안성맞춤(평택)휴게소',1),
                ('RA06','통도사(부산)휴게소',2),
                ('RA07','사천(부산)휴게소',2),
                ('RA08','현풍(대구)휴게소',2),
                ('RA09','칠곡(부산)휴게소',2),
                ('RA10','영천(대구)휴게소',2),
                ('RA11','함평나비(광주)휴게소',5),
                ('RA12','정읍녹두장군(천안)휴게소',5),
                ('RA13','보성녹차(순천)휴게소',5),
                ('RA14','강천산(광주)휴게소',5),
                ('RA15','청주(서울)휴게소',4),
                ('RA16','옥산(부산)휴게소',4),
                ('RA17','공주(대전)휴게소',4),
                ('RA18','천등산(평택)휴게소',4),
                ('RA19','예산(당진)휴게소',4),
                ('RA20','내린천휴게소',3),
                ('RA21','홍천(양양)휴게소',3),
                ('RA22','문막(강릉)휴게소',3),
                ('RA23','옥계(속초)휴게소',3),
                ('RA24','평창(강릉)휴게소',3);
            INSERT INTO storeInfo (id, store_id, product_id, store_name, ranking, store_type) VALUES
                ('RA01','S001',1,'파리바게트','1',2),
                ('RA01','S002',2,'찹쌀닭강정','2',7),
                ('RA01','S003',3,'신서방왕만두','3',3),
                ('RA01','S004',4,'CU','4',8),
                ('RA01','S005',5,'효원당','5',3),
                ('RA02','S006',6,'드롭탑','1',2),
                ('RA02','S007',7,'델리쉐프','2',7),
                ('RA02','S008',8,'델리쉐프','3',7),
                ('RA02','S009',9,'만쥬리아','4',7),
                ('RA02','S010',10,'델리쉐프','5',7),
                ('RA03','S011',11,'자율식당','1',1),
                ('RA03','S012',5,'호도과자코너','2',7),
                ('RA03','S013',12,'우동전문점','3',9),
                ('RA03','S014',13,'할리스커피','4',2),
                ('RA03','S015',14,'자율식당','5',1),
                ('RA04','S016',13,'카페드롭탑','1',2),
                ('RA04','S017',15,'한식전문점','2',1),
                ('RA04','S018',16,'한식전문점','3',1),
                ('RA04','S019',17,'미스터짬뽕라면','4',4),
                ('RA04','S020',18,'한식전문점','5',1),
                ('RA05','S021',19,'한식전문점','1',1),
                ('RA05','S022',13,'할리스','2',2),
                ('RA05','S023',20,'로띠번','3',2),
                ('RA05','S024',7,'가판','4',3),
                ('RA05','S025',22,'한식당','5',1),
                ('RA06','S026',23,'한식전문점','1',1),
                ('RA06','S027',24,'한식전문점','2',1),
                ('RA06','S028',5,'호두코너','3',7),
                ('RA06','S029',13,'커피딜라이트','4',2),
                ('RA06','S030',25,'한식전문점','5',1),
                ('RA07','S031',13,'할리스커피','1',2),
                ('RA07','S032',26,'한식전문점','2',1),
                ('RA07','S033',7,'즉석코너','3',3),
                ('RA07','S034',27,'한식전문점','4',1),
                ('RA07','S035',76,'한식전문점','5',1),
                ('RA08','S036',28,'풍경마루','1',1),
                ('RA08','S037',13,'탐앤탐스','2',2),
                ('RA08','S038',29,'풍경마루','3',1),
                ('RA08','S039',30,'풍경마루','4',1),
                ('RA08','S040',31,'코바코','5',1),
                ('RA09','S041',32,'죠이마트','1',8),
                ('RA09','S042',33,'자율식당','2',1),
                ('RA09','S043',34,'우동김밥전문점','3',3),
                ('RA09','S044',5,'호도/잡화','4',7),
                ('RA09','S045',35,'자율식당','5',1),
                ('RA10','S046',13,'탐앤탐스','1',2),
                ('RA10','S047',36,'한식전문점','2',1),
                ('RA10','S048',37,'한식전문점','3',1),
                ('RA10','S049',7,'열린매장','4',7),
                ('RA10','S050',76,'한식전문점','5',1),
                ('RA11','S051',13,'탐앤탐스','1',2),
                ('RA11','S052',38,'한식전문점','2',1),
                ('RA11','S053',39,'한식전문점','3',1),
                ('RA11','S054',7,'열린매장','4',7),
                ('RA11','S055',76,'한식전문점','5',1),
                ('RA12','S056',13,'탐앤탐스','1',2),
                ('RA12','S057',39,'한식전문점','2',1),
                ('RA12','S058',40,'한식전문점','3',1),
                ('RA12','S059',13,'탐앤탐스','4',2),
                ('RA12','S060',41,'한식전문점','5',1),
                ('RA13','S061',42,'한식전문점','1',1),
                ('RA13','S062',13,'할리스','2',2),
                ('RA13','S063',43,'한식전문점','3',1),
                ('RA13','S064',44,'미스터톡톡','4',7),
                ('RA13','S065',39,'한식전문점','5',1),
                ('RA14','S066',45,'한식전문점','1',1),
                ('RA14','S067',13,'리던','2',2),
                ('RA14','S068',46,'로띠번','3',2),
                ('RA14','S069',47,'한식전문점','4',1),
                ('RA14','S070',7,'가판','5',3),
                ('RA15','S071',48,'한식전문점','1',1),
                ('RA15','S072',49,'나주곰탕','2',1),
                ('RA15','S073',5,'호두과자','3',7),
                ('RA15','S074',50,'한식전문점','4',1),
                ('RA15','S075',51,'양식전문점','5',5),
                ('RA16','S076',52,'한식전문점','1',1),
                ('RA16','S077',76,'한식전문점','2',1),
                ('RA16','S078',53,'놀부부대찌개','3',1),
                ('RA16','S079',13,'던킨도너츠','4',7),
                ('RA16','S080',54,'한식전문점','5',1),
                ('RA17','S081',55,'공주밤나무','1',7),
                ('RA17','S082',13,'카페베네','2',2),
                ('RA17','S083',56,'공주밤나무','3',7),
                ('RA17','S084',57,'공주밤나무','4',7),
                ('RA17','S085',58,'공차','5',2),
                ('RA18','S086',59,'파스쿠치','1',2),
                ('RA18','S087',60,'양식전문점','2',5),
                ('RA18','S088',61,'한식전문점','3',1),
                ('RA18','S089',62,'파스쿠치','4',2),
                ('RA18','S090',63,'한식전문점','5',1),
                ('RA19','S091',64,'애플돈가스','1',3),
                ('RA19','S092',13,'할리스','2',2),
                ('RA19','S093',39,'한식전문점','3',1),
                ('RA19','S094',65,'의류매장01','4',100'),
                ('RA19','S095',66,'스낵(라면)','5',3),
                ('RA20','S096',67,'내린천한식','1',1),
                ('RA20','S097',68,'코바코 라면','2',3),
                ('RA20','S098',13,'탐앤탐스','3',2),
                ('RA20','S099',69,'바른김밥김선생','4',3),
                ('RA20',S100,70,'내린천한식','5',1),
                ('RA21','S101',7,'뽀끼뽀기','1',3),
                ('RA21','S102',13,'할리스','2',2),
                ('RA21','S103',13,'할리스','3',2),
                ('RA21','S104',5,'호두과자','4',7),
                ('RA21','S105',5,'호두과자','5',7),
                ('RA22','S106',71,'별미우동','1',1),
                ('RA22','S107',5,'한과','2',7),
                ('RA22','S108',7,'가판','3',7),
                ('RA22','S109',72,'롯데리아','4',5),
                ('RA22','S110',73,'별미우동','5',1),
                ('RA23','S111',13,'드롭탑','1',2),
                ('RA23','S112',13,'드롭탑','2',2),
                ('RA23','S113',74,'한식전문점','3',1),
                ('RA23','S114',7,'델리쉐프','4',7),
                ('RA23','S115',76,'코바코돈까스','5',5),
                ('RA24','S116',7,'가판','1',7),
                ('RA24','S117',76,'평창반상','2',1),
                ('RA24','S118',13,'탐앤탐스','3',2),
                ('RA24','S119',5,'호두과자','4',7),
                ('RA24','S120',13,'탐앤탐스','5',2);";
        
    $res = mysqli_multi_query($conn, $sql);
    if ($res === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error inserting database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
    ?>