CREATE TABLE `guest` 
  ( 
     `guest_id`   INT(11) NOT NULL auto_increment, 
     `username` VARCHAR(80) NOT NULL, 
     `password`  VARCHAR(80) NOT NULL, 
     PRIMARY KEY (`guest_id`) ,
      UNIQUE (`username`)
  ); 
  CREATE TABLE `reservation` 
  ( 
     `reservation_id` INT(11) NOT NULL auto_increment, 
     `date_from`      DATE NOT NULL, 
     `date_to`        DATE NOT NULL, 
     `guest_id`       INT(11) NOT NULL, 
	 `apartment_id`       INT(11) NOT NULL, 
     PRIMARY KEY (`reservation_id`), 
	 FOREIGN KEY (`apartment_id`) REFERENCES apartment (`apartment_id`) ,
     FOREIGN KEY (`guest_id`) REFERENCES guest (`guest_id`) 
  ) 
  
  CREATE TABLE `apartment` 
  ( 
     `apartment_id`      INT(11) NOT NULL auto_increment, 
     `name`              VARCHAR(40) NOT NULL
  ) 
  INSERT INTO `guest` (`username`, `password`) 
VALUES ('Peter', 'Parker'),
       ('Maja', 'Matic'),
       ('Toni', 'Tomic'),
       ('Nada', 'Novak');
	   INSERT INTO `reservation` (`date_from`, `date_to`,`guest_id`, `apartment_id`) 
VALUES ('2018-12-31' ,  '2019-01-02',1,1),
('2017-07-25' ,  '2017-07-31',2,2),
( '2017-05-03' ,  '2017-08-30',3,3),
('2017-04-07' ,  '2017-09-09',4,4);
INSERT INTO `apartment` (`name`) 
VALUES ( 'delux'),
       ('exclusive'),
       ('pink'),
       ('palace');