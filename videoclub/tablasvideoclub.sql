DROP DATABASE IF EXISTS alqpeliculas;
CREATE DATABASE alqpeliculas;
USE alqpeliculas;

CREATE TABLE film (
  film_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT DEFAULT NULL,
  release_year YEAR DEFAULT NULL,
  language_id TINYINT UNSIGNED NOT NULL,
  original_language_id TINYINT UNSIGNED DEFAULT NULL,
  rental_duration TINYINT UNSIGNED NOT NULL DEFAULT 3,
  rental_rate DECIMAL(4,2) NOT NULL DEFAULT 4.99,
  length SMALLINT UNSIGNED DEFAULT NULL,
  replacement_cost DECIMAL(5,2) NOT NULL DEFAULT 19.99,
  rating ENUM('G','PG','PG-13','R','NC-17') DEFAULT 'G',
  special_features SET('Trailers','Commentaries','Deleted Scenes','Behind the Scenes') DEFAULT NULL,
  last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (film_id),
  KEY idx_title (title),
  KEY idx_fk_language_id (language_id),
  KEY idx_fk_original_language_id (original_language_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE inventory (
  inventory_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  film_id SMALLINT UNSIGNED NOT NULL,
  quantity TINYINT UNSIGNED NOT NULL,
  last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (inventory_id),
  KEY idx_fk_film_id (film_id),
  CONSTRAINT fk_inventory_film FOREIGN KEY (film_id) REFERENCES film (film_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE customer (
  customer_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  store_id TINYINT UNSIGNED NOT NULL,
  first_name VARCHAR(45) NOT NULL,
  last_name VARCHAR(45) NOT NULL,
  email VARCHAR(50) DEFAULT NULL,
  address_id SMALLINT UNSIGNED NOT NULL,
  active BOOLEAN NOT NULL DEFAULT TRUE,
  create_date DATETIME NOT NULL,
  last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (customer_id),
  KEY idx_fk_store_id (store_id),
  KEY idx_fk_address_id (address_id),
  KEY idx_last_name (last_name)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rental (
  rental_id INT NOT NULL AUTO_INCREMENT,
  rental_date DATETIME NOT NULL,
  inventory_id MEDIUMINT UNSIGNED NOT NULL,
  customer_id SMALLINT UNSIGNED NOT NULL,
  return_date DATETIME DEFAULT NULL,
  staff_id TINYINT UNSIGNED NOT NULL,
  last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (rental_id),
  UNIQUE KEY  (rental_date,inventory_id,customer_id),
  KEY idx_fk_inventory_id (inventory_id),
  KEY idx_fk_customer_id (customer_id),
  KEY idx_fk_staff_id (staff_id),
  CONSTRAINT fk_rental_inventory FOREIGN KEY (inventory_id) REFERENCES inventory (inventory_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_rental_customer FOREIGN KEY (customer_id) REFERENCES customer (customer_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO film VALUES (1,'ACADEMY DINOSAUR','A Epic Drama of a Feminist And a Mad Scientist who must Battle a Teacher in The Canadian Rockies',2006,1,NULL,6,'0.99',86,'20.99','PG','Deleted Scenes,Behind the Scenes','2006-02-15 05:03:42'),
(2,'ACE GOLDFINGER','A Astounding Epistle of a Database Administrator And a Explorer who must Find a Car in Ancient China',2006,1,NULL,3,'4.99',48,'12.99','G','Trailers,Deleted Scenes','2006-02-15 05:03:42'),
(3,'ADAPTATION HOLES','A Astounding Reflection of a Lumberjack And a Car who must Sink a Lumberjack in A Baloon Factory',2006,1,NULL,7,'2.99',50,'18.99','NC-17','Trailers,Deleted Scenes','2006-02-15 05:03:42'),
(4,'AFFAIR PREJUDICE','A Fanciful Documentary of a Frisbee And a Lumberjack who must Chase a Monkey in A Shark Tank',2006,1,NULL,5,'2.99',117,'26.99','G','Commentaries,Behind the Scenes','2006-02-15 05:03:42'),
(5,'AFRICAN EGG','A Fast-Paced Documentary of a Pastry Chef And a Dentist who must Pursue a Forensic Psychologist in The Gulf of Mexico',2006,1,NULL,6,'2.99',130,'22.99','G','Deleted Scenes','2006-02-15 05:03:42'),
(6,'AGENT TRUMAN','A Intrepid Panorama of a Robot And a Boy who must Escape a Sumo Wrestler in Ancient China',2006,1,NULL,3,'2.99',169,'17.99','PG','Deleted Scenes','2006-02-15 05:03:42'),
(7,'AIRPLANE SIERRA','A Touching Saga of a Hunter And a Butler who must Discover a Butler in A Jet Boat',2006,1,NULL,6,'4.99',62,'28.99','PG-13','Trailers,Deleted Scenes','2006-02-15 05:03:42'),
(8,'AIRPORT POLLOCK','A Epic Tale of a Moose And a Girl who must Confront a Monkey in Ancient India',2006,1,NULL,6,'4.99',54,'15.99','R','Trailers','2006-02-15 05:03:42'),
(9,'ALABAMA DEVIL','A Thoughtful Panorama of a Database Administrator And a Mad Scientist who must Outgun a Mad Scientist in A Jet Boat',2006,1,NULL,3,'2.99',114,'21.99','PG-13','Trailers,Deleted Scenes','2006-02-15 05:03:42'),
(10,'ALADDIN CALENDAR','A Action-Packed Tale of a Man And a Lumberjack who must Reach a Feminist in Ancient China',2006,1,NULL,6,'4.99',63,'24.99','NC-17','Trailers,Deleted Scenes','2006-02-15 05:03:42');
COMMIT;

INSERT INTO inventory VALUES (1,1,1,'2006-02-15 05:09:17'),
(9,2,2,'2006-02-15 05:09:17'),
(12,3,2,'2006-02-15 05:09:17'),
(16,4,1,'2006-02-15 05:09:17'),
(23,5,2,'2006-02-15 05:09:17'),
(26,6,1,'2006-02-15 05:09:17'),
(32,7,1,'2006-02-15 05:09:17'),
(37,8,2,'2006-02-15 05:09:17'),
(44,9,2,'2006-02-15 05:09:17'),
(46,10,1,'2006-02-15 05:09:17');
COMMIT;



INSERT INTO customer VALUES (1,1,'MARY','SMITH','MARY.SMITH@sakilacustomer.org',5,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(2,1,'PATRICIA','JOHNSON','PATRICIA.JOHNSON@sakilacustomer.org',6,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(3,1,'LINDA','WILLIAMS','LINDA.WILLIAMS@sakilacustomer.org',7,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(4,2,'BARBARA','JONES','BARBARA.JONES@sakilacustomer.org',8,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(5,1,'ELIZABETH','BROWN','ELIZABETH.BROWN@sakilacustomer.org',9,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(6,2,'JENNIFER','DAVIS','JENNIFER.DAVIS@sakilacustomer.org',10,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(7,1,'MARIA','MILLER','MARIA.MILLER@sakilacustomer.org',11,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(8,2,'SUSAN','WILSON','SUSAN.WILSON@sakilacustomer.org',12,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(9,2,'MARGARET','MOORE','MARGARET.MOORE@sakilacustomer.org',13,1,'2006-02-14 22:04:36','2006-02-15 04:57:20'),
(10,1,'DOROTHY','TAYLOR','DOROTHY.TAYLOR@sakilacustomer.org',14,1,'2006-02-14 22:04:36','2006-02-15 04:57:20');
COMMIT;

INSERT INTO rental VALUES (1,'2005-05-24 22:53:30',1,1,'2005-05-26 22:04:30',1,'2006-02-15 21:30:53'),
(2,'2005-05-24 22:54:33',9,1,'2005-05-28 19:40:33',1,'2006-02-15 21:30:53'),
(3,'2005-05-24 23:03:39',12,1,'2005-06-01 22:12:39',1,'2006-02-15 21:30:53'),
(4,'2005-05-24 23:04:41',16,1,'2005-06-03 01:43:41',2,'2006-02-15 21:30:53'),
(5,'2005-05-24 23:05:21',23,2,'2005-06-02 04:33:21',1,'2006-02-15 21:30:53'),
(6,'2005-05-24 23:08:07',26,2,'2005-05-27 01:32:07',1,'2006-02-15 21:30:53'),
(7,'2005-05-24 23:11:53',32,5,'2005-05-29 20:34:53',2,'2006-02-15 21:30:53'),
(8,'2005-05-24 23:31:46',37,6,'2005-05-27 23:33:46',2,'2006-02-15 21:30:53'),
(9,'2005-05-25 00:00:40',44,8,'2005-05-28 00:22:40',1,'2006-02-15 21:30:53'),
(10,'2005-05-25 00:02:21',46,1,'2005-05-31 22:44:21',2,'2006-02-15 21:30:53'),
(11,'2007-05-25 00:09:02',1,8,'2007-06-02 20:56:02',2,'2008-02-15 21:30:53'),
(12,'2009-05-25 00:19:27',1,8,'2009-05-30 05:44:27',2,'2010-02-15 21:30:53'),
(13,'2011-05-25 00:22:55',1,8,'2011-05-25 00:22:55',1,'2006-02-15 21:30:53');
COMMIT;

alter table film drop column language_id, DROP COLUMN original_language_id, DROP COLUMN last_update;

alter table customer drop column store_id, DROP COLUMN address_id, DROP COLUMN last_update;

alter table rental drop column staff_id;
alter table rental drop column last_update;

create table users
as select customer_id id, substr(first_name,1,8) username,  substr(last_name,1,8) passcode
from customer;

alter table users add constraint pk_admin primary key(id);