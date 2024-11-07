-- Drop table if exists
DROP TABLE IF EXISTS `tblnotice`;

-- Create tables
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert data into tables
INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2022-01-01 10:30:57');

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section') VALUES

(2, 'CSE', 2, 'A');


INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`) VALUES
(32, 7, 1, 5, 56, );

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`) VALUES
(1, 'Sarita', '23210', 'Sarita10@gmail.com', 'Female', '1995-03-03', 1);

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`) VALUES
(32, 1, 1, 1),


INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`) VALUES
(12, 'Chemistry Laboratory', 'CY8161');
