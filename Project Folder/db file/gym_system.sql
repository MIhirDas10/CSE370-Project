CREATE TABLE `staffs` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` int(10) NOT NULL,
   PRIMARY KEY (staff_id)    
);

INSERT INTO `staffs` (`username`, `password`, `email`, `fullname`, `address`, `designation`, `gender`, `contact`) VALUES
('bruno', '12345', 'brunoden@mail.com', 'Bruno Den', '26 Morris Street', 'Cashier', 'Male', 852028120),
('michelle', '12345', 'michelle@mail.com', 'Michelle R. Lane', '61 Stone Lane', 'Trainer', 'Female', 2147483647),
('james', '12345', 'jamesb@mail.com', 'James Brown', '12 Deer Ridge Drive', 'Trainer', 'Male', 2147483647),
('bruce', '12345', 'bruce@mail.com', 'Bruce H. Klaus', '68 Lake Floyd Circle', 'Manager', 'Male', 1458887788);

ALTER TABLE staffs ADD `image` varchar(75);

CREATE TABLE `staffRoutine` (
  `Sta_ID` INT(11) NOT NULL DEFAULT FALSE,
  `TS_8_10` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_10_12` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_12_2` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_2_4` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_4_6` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (Sta_ID),
  FOREIGN KEY (Sta_ID) REFERENCES staffs(staff_id) ON DELETE CASCADE
);

INSERT INTO `staffRoutine` (`Sta_ID`, `TS_8_10`, `TS_10_12`, `TS_12_2`, `TS_2_4`, `TS_4_6`) VALUES
(1, TRUE, TRUE, TRUE, FALSE, FALSE),
(2, FALSE, TRUE, TRUE, TRUE, FALSE),
(3, FALSE, TRUE, TRUE, TRUE, FALSE),
(4, FALSE, FALSE, TRUE, TRUE, TRUE);


CREATE TABLE `members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (member_id)
);

INSERT INTO `members` (`fullname`, `username`, `password`, `gender`, `dor`, `address`, `contact`, `email`) VALUES
('Harry Denn', 'harry', '12345', 'Male', '2019-12-25', '64 Mulberry Lane', '8545878545', 'harry.denn@gmail.com'),
('Charles Anderson', 'charles', '12345', 'Male', '2020-01-02', '99 Heron Way', '8520258520',  'charles.anderson@gmail.com'),
('Justin Schexnayder', 'justin', '12345', 'Male', '2019-01-25', '14 Blair Court', '7535752220', 'justim@gmail.com'),
('Ryan Crowl', 'ryan', '12345', 'Male', '2019-07-13', '34 Twin Oaks Drive', '1578880010', 'ryan.crowl@gmail.com'),
('Trials Changed', 'trials', '12345', 'Female', '2020-04-01', '4 Demo Lane', '741111110', 'trials@gmail.com');

ALTER TABLE members ADD `image` varchar(75);

CREATE TABLE `memberRoutine` (
  `Mem_ID` INT(11) NOT NULL DEFAULT FALSE,
  `TS_8_10` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_10_12` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_12_2` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_2_4` BOOLEAN NOT NULL DEFAULT FALSE,
  `TS_4_6` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (Mem_ID),
  FOREIGN KEY (Mem_ID) REFERENCES members(member_id) ON DELETE CASCADE
);

INSERT INTO `memberRoutine` (`Mem_ID`, `TS_8_10`, `TS_10_12`, `TS_12_2`, `TS_2_4`, `TS_4_6`) VALUES
(1, TRUE, TRUE, TRUE, FALSE, FALSE),
(2, FALSE, TRUE, TRUE, TRUE, FALSE),
(3, FALSE, TRUE, TRUE, TRUE, FALSE),
(4, FALSE, FALSE, TRUE, TRUE, TRUE),
(5, FALSE, FALSE, TRUE, TRUE, TRUE);


CREATE TABLE `progress`(
  `progress_id` int NOT NULL,  
  `ini_weight` varchar(50) NOT NULL,
  `curr_weight` varchar(50) NOT NULL,
  `ini_bodytype` varchar(50) NULL,
  `curr_bodytype` varchar(50) NOT NULL,
  `progress_date` date NOT NULL,
  PRIMARY KEY (progress_id),
  FOREIGN KEY (progress_id) REFERENCES members(member_id) ON DELETE CASCADE
);

INSERT INTO `progress` (`progress_id`, `ini_weight`, `curr_weight`, `ini_bodytype`, `curr_bodytype`, `progress_date`) VALUES
(1, 54, 62, 'Slim', 'Buffed', '2020-04-22'),
(2, 92, 85, 'Fat', 'Bulked', '2020-04-22'),
(3, 85, 72, 'Fat', 'Buffed', '2019-05-25'),
(4, 59, 63, 'Slim', 'Slim', '2020-04-23'),
(5, 50, 61, 'Slim', 'Slim', '2021-06-11');

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `amount` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` date NOT NULL
);

INSERT INTO `equipment` (`id`, `name`, `amount`, `quantity`, `vendor`, `description`, `address`, `contact`, `date`) VALUES
(3, 'Treadmill', 909, 4, 'DnS', 'Edited Description', '7 Cedarstone Drive', '8521479633', '2019-03-07'),
(4, 'Vertical Press Machine', 949, 3, 'SS Industries', 'For Biceps And Triceps, Upper Back, Chest', '7 Cedarstone Drive', '1245558980', '2020-03-19'),
(5, 'Dumbell - Adjustable', 102, 26, 'Uptown Suppliers', 'Material: Steel, Rubber Plastic, Concrete', '7 Cedarstone Drive', '9875552100', '2020-03-29'),
(6, 'Multi Bench Press Machine', 219, 2, 'DnS Suppliers', '6 In 1 Multi Bench With Incline, Flat, Decline Ben', '7 Cedarstone Drive', '7410001010', '2020-04-05');

ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);
  

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` int(10) NOT NULL,
  PRIMARY KEY (admin_id)
);

INSERT INTO `admin` (`username`, `password`, `email`, `fullname`, `address`, `designation`, `gender`, `contact`) VALUES
('brown', '12345', 'brown@mail.com', 'Brown H. Klaus', '70 Lake Floyd Circle', 'Admin', 'Male', 1458888888);

ALTER TABLE admin ADD `image` varchar(75);

CREATE TABLE `announcements`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT 1,
  `message` varchar(100) NOT NULL,
  `date` date NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
);

INSERT INTO `announcements` (`message`, `date`) VALUES
('This is to announce that our GYM will remain close for 51 days due to COVID-19.', '2020-03-30'),
('Opening of GYM Halls and Clubs are not fixed yet. Stay tuned for more updates!!', '2020-04-03'),
('Renovation Going On...', '2020-04-04'),
('This is a demo announcement from admin', '2022-06-03');

CREATE TABLE `attendance` (  
  `member_id` int NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL,
  `present` tinyint(4) NOT NULL
);

ALTER TABLE `attendance`
  ADD PRIMARY KEY (`member_id`);
  
CREATE TABLE `todo`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_status` varchar(50) NOT NULL,
  `task_desc` varchar(30) NOT NULL,
  `member_id` int NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE CASCADE
);

INSERT INTO `todo` (`task_status`, `task_desc`, `member_id`) VALUES
('In Progress', 'Test Completed', 1),
('Pending', 'Mastering Crunches', 2),
('In Progress', 'Standing Workouts For Flat Abs', 3),
('In Progress', 'Triceps Buildup - 3 set', 4),
('Pending', 'Decline dumbbell bench press', 5);

CREATE TABLE `subscription`(
  `sub_id` int NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 1,
  `services` varchar(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `paid_date` date NOT NULL,
  `p_year` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (sub_id),
  FOREIGN KEY (sub_id) REFERENCES members(member_id) ON DELETE CASCADE,
  FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
);

INSERT INTO `subscription` (`sub_id`, `services`, `amount`, `paid_date`, `p_year`, `plan`) VALUES

(1, 'Fitness', 165, '2022-06-02', 2021, '3'),
(2, 'Fitness', 55, '2020-04-01', 2020, '3'),
(3, 'Cardio', 35, '2020-03-31', 2020, '3'),
(4, 'Fitness', 55, '2020-04-02', 2020, '12'),
(5, 'Fitness', 50, '2021-06-12', 2021, '2');

CREATE TABLE `member_attendance`(
  `member_id` int NOT NULL,  
  `count` int NOT NULL DEFAULT 0,
  PRIMARY KEY (member_id),
  FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE CASCADE
 
);

INSERT INTO `member_attendance` (`member_id`) VALUES
(1),
(2),
(3),
(4),
(5);

CREATE TABLE `staff_attendance`(
  `staff_id` int NOT NULL,
  `admin_id` int NOT NULL DEFAULT 1,
  `count` int NOT NULL DEFAULT 0,
  PRIMARY KEY (staff_id),
  FOREIGN KEY (staff_id) REFERENCES staffs(staff_id) ON DELETE CASCADE,
  FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
);

INSERT INTO `staff_attendance` (`staff_id`) VALUES
(1),
(2),
(3),
(4);