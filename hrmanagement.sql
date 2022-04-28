-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 25, 2022 at 04:14 PM
-- Server version: 10.5.4-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmanagement`
--
CREATE DATABASE IF NOT EXISTS `hrmanagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hrmanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--
CREATE TABLE IF NOT EXISTS `department` (
  `dept_name` varchar(20) NOT NULL,
  `budget` numeric(12,2) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int(12) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `salary` numeric(9,2) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`emp_id`),
  FOREIGN KEY (`dept_name`) references department(`dept_name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` int(6) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `name`, `phone`, `email`) VALUES
(567891, 'Javis', 23434234, 'qefej9'),
(567898, 'Thana', 23434234, 'qefej10*'),
(567890, 'Zuoc', 23434234, 'qefej9*');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--


-- --------------------------------------------------------

--
-- Table structure for table `emp_team`
--

-- Adding Auto Increment constraints for manager_id and emp_d
--
ALTER TABLE `employee` -- emp_id autoincremented by 17 with every new tuple
  MODIFY `emp_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- manager_id autoincremented by 17 with every new tuple
ALTER TABLE `manager`
  MODIFY `manager_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
-- Constraints for dumped tables
--



CREATE TABLE IF NOT EXISTS `team` (
  `team_name` varchar(30) NOT NULL,
  `manager_id` int(6) DEFAULT NULL,
  `total_members` int(6) DEFAULT NULL,
  PRIMARY KEY (`team_name`),
  foreign key (`manager_id`) references manager(`manager_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

DROP TABLE IF EXISTS `emp_team`;
CREATE TABLE IF NOT EXISTS `emp_team` (
  `emp_id` int(12) DEFAULT NULL,
  `team_name` varchar(30) DEFAULT NULL,
  foreign key (`emp_id`) references employee(`emp_id`) ON DELETE CASCADE,
  foreign key (`team_name`) references team(`team_name`) ON DELETE CASCADE,
  PRIMARY KEY (`emp_id`, `team_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- Create index on dept_name attribute of employee relation such that 
-- all employees within a given department can be found without having
-- to search through the entire file
CREATE INDEX Idx1 ON employee(dept_name);

-- triggers
delimiter //
CREATE TRIGGER emp_rmv BEFORE DELETE ON employee
 FOR EACH ROW begin
    delete from emp_team where emp_team.emp_id = old.emp_id;
  end//
delimiter ;

delimiter //
CREATE TRIGGER emp_team_del BEFORE DELETE ON emp_team
 FOR EACH ROW begin
    update team set team.total_members = team.total_members - 1 where team.team_name = old.team_name;
  end//
delimiter ;

CREATE TRIGGER team_mem_ins BEFORE INSERT ON emp_team
 FOR EACH ROW update team set team.total_members = team.total_members + 1 where team.team_name = new.team_name


delimiter //
CREATE TRIGGER team_rmv BEFORE DELETE ON team
 FOR EACH ROW BEGIN 
DELETE from emp_team where emp_team.team_name = old.team_name;
  end//
delimiter ;

-- Create a view which does not provide the salary information of employees
-- This is used to keep salary information hidden from regular employees
create view employeeRedacted AS
	select 
        emp_id, name, dept_name, phone, email,  start_date
    from employee;


--Calculate the number of employees withn each department
DELIMITER //

create function countEmployeesInDept(department_name varchar(20))
	returns integer
			begin
	declare employeeCount integer;
		select count(*) into employeeCount
		from employee
		where employee.dept_name = department_name;
	return employeeCount;
	END //

DELIMITER ;


-- Calculate the number of teams a given manager manages
DELIMITER //

create function countTeamsManaged(manager_id int(6))
	returns integer
			begin
	declare teamTotal integer;
		select count(*) into teamTotal
		from manager
		where manager.manager_id = manager_id;
	return teamTotal;
	END //

DELIMITER ;

-- Calculate the Average Salary of a given department
DELIMITER //

create function find_dept_avg_salary(department_name varchar(20))
	returns numeric(12,2)
			begin
	declare dept_avg_salary numeric(12,2);
		select avg(salary) into dept_avg_salary
		from employee, department
		where employee.dept_name = department.dept_name;
	return dept_avg_salary;
	END //
DELIMITER ;


insert into manager (manager_id, name, phone, email) values ('00000', 'madonna', '1234567890', 'trueBlue@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00001', 'michael jackson', '2345678901', 'thriller@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00002', 'elton john', '345678901234', 'blueMoves@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00003', 'davic bowe', '4567890123', 'heroes@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00004', 'bryan adams', '5678901234', 'reckless@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00005', 'whitney houston', '6789012345', 'whitney@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00006', 'prince', '7890123456', 'purpleRain@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00007', 'paul mccartney', '8901234567', 'abbeyRoad@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00008', 'phil collins', '9012345678', 'tarzanSong@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00009', 'lionel richie', '0123456789', 'tuskegee@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00010', 'janet jackson', '0987654321', 'control@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00011', 'celine dion', '9876543210', 'titanicSong@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00012', 'stevie nicks', '8765432109', 'bellaDonna@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00013', 'rick astley', '7654321098', 'rickRolled@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00014', 'john lennon', '6543210987', 'imagine@gmail.com');
insert into manager (manager_id, name, phone, email) values ('00015', 'bob dylan', '5432109876', 'blondeOnBlonde@gmail.com');

insert into department (dept_name, budget, phone, building) values ('software engineering', '1000000', '0987654321', 'math and science');
insert into department (dept_name, budget, phone, building) values ('physics', '3000000', '9876543210', 'williams');
insert into department (dept_name, budget, phone, building) values ('music', '900000', '8765432109', 'glauser');
insert into department (dept_name, budget, phone, building) values ('visual arts', '750000', '7654321098', 'center for visual arts');
insert into department (dept_name, budget, phone, building) values ('medical', '5000000', '6543210987', 'cunningham');
insert into department (dept_name, budget, phone, building) values ('chemistry', '15000000', '5432109876', 'isb');

insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99999', 'john cena', 'software engineering', '1234567890', 'cena@gmail.com', '92000', '10/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99998', 'bjarne stroustrup', 'software engineering', '2345678901', 'c++@gmail.com', '100000', '5/20/1989');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99997', 'snoop dog', 'music', '3456789012', 'snoop@gmail.com', '100000', '9/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99996', 'einstine', 'physics', '4567890123', 'john@gmail.com', '94000', '8/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99995', 'randy marsh', 'music', '5678901234', 'lorde@gmail.com', '72000', '7/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99994', 'rick grimes', 'medical', '6789012345', 'rick@gmail.com', '99000', '6/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99993', 'glenn rhee', 'medical', '7890123456', 'glem@gmail.com', '98000', '5/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99992', 'walter white', 'chemistry', '8901234567', 'heisenburg@gmail.com', '90000', '4/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99991', 'micheal scott', 'visual arts', '9012345678', 'dunder@gmail.com', '60000', '3/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99990', 'barney stinson', 'visual arts', '0123456789', 'barney@gmail.com', '54000', '2/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99989', 'saul goodman', 'chemistry', '0987654321', 'itsAllGoodMan@gmail.com', '9000', '1/21/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99988', 'spock', 'physics', '9876543210', 'spock@gmail.com', '94000', '5/20/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99987', 'dexter morgan', 'medical', '876543210', 'dexter@gmail.com', '90000', '6/19/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99986', 'racheal green', 'visual arts', '765432109', 'green@gmail.com', '97000', '7/18/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99985', 'thomas magnum', 'software engineering', '6543210987', 'magnumPI@gmail.com', '90000', '8/17/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99983', 'tom cat', 'music', '4321098765', 'jerry@gmail.com', '72000', '10/15/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99982', 'fred flinstone', 'chemistry', '3210987654', 'yabbaDabbaDoo@gmail.com', '67000', '10/14/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99981', 'dewey wilkerson', 'medical', '2109876543', 'dewey@gmail.com', '120000', '11/13/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99980', 'tina belcher', 'music', '1098765432', 'jimmyjr@gmail.com', '330000', '12/12/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99979', 'jack bauer', 'medical', '1357924680', 'bauer@gmail.com', '99000', '1/11/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99978', 'fiona gallagher', 'visual arts', '2468013579', 'fiona@gmail.com', '87000', '2/10/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99977', 'rick sanchez', 'physics', '3579124680', 'genius@gmail.com', '500000', '3/9/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99976', 'hannible lecter', 'medical', '4680213579', 'hannible@gmail.com', '123000', '4/8/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99975', 'wyane letterkenny', 'software engineering', '579124680', 'wayne@gmail.com', '96000', '5/7/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99974', 'samuri jack', 'visual arts', '6802413579', 'jack@gmail.com', '24000', '6/6/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99973', 'tyrion lannister', 'chemistry', '7913524680', 'whoElseButBran@gmail.com', '78000', '7/5/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99972', 'charlie day', 'music', '8024613579', 'ratBat@gmail.com', '87000', '8/4/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99971', 'meredith grey', 'medical', '9135724680', 'fakeMedicine@gmail.com', '92000', '9/3/1999');
insert into employee (emp_id, name, dept_name, phone, email, salary, start_date) values ('99970', 'dwight schrute', 'physics', '0246813579', 'schruteFarms@gmail.com', '92000', '10/2/1999');



insert into team (team_name, manager_id, total_members) values ('the A team', '00001', '10');
insert into team (team_name, manager_id, total_members) values ('the breakfast club', '00015', '5');
insert into team (team_name, manager_id, total_members) values ('blue mountain state goats', '00013', '5');
insert into team (team_name, manager_id, total_members) values ('average joes gym', '00007', '5');
insert into team (team_name, manager_id, total_members) values ('the standlot', '00002', '4');


insert into emp_team (emp_id, team_name) values ('99999', 'the A team');
insert into emp_team (emp_id, team_name) values ('99998', 'the A team');
insert into emp_team (emp_id, team_name) values ('99997', 'the A team');
insert into emp_team (emp_id, team_name) values ('99996', 'the A team');
insert into emp_team (emp_id, team_name) values ('99995', 'the A team');
insert into emp_team (emp_id, team_name) values ('99994', 'the A team');
insert into emp_team (emp_id, team_name) values ('99993', 'the A team');
insert into emp_team (emp_id, team_name) values ('99992', 'the A team');
insert into emp_team (emp_id, team_name) values ('99991', 'the A team');
insert into emp_team (emp_id, team_name) values ('99990', 'the A team');

insert into emp_team (emp_id, team_name) values ('99989', 'the breakfast club');
insert into emp_team (emp_id, team_name) values ('99988', 'the breakfast club');
insert into emp_team (emp_id, team_name) values ('99987', 'the breakfast club');
insert into emp_team (emp_id, team_name) values ('99986', 'the breakfast club');
insert into emp_team (emp_id, team_name) values ('99985', 'the breakfast club');

insert into emp_team (emp_id, team_name) values ('99970', 'blue mountain state goats');
insert into emp_team (emp_id, team_name) values ('99983', 'blue mountain state goats');
insert into emp_team (emp_id, team_name) values ('99982', 'blue mountain state goats');
insert into emp_team (emp_id, team_name) values ('99981', 'blue mountain state goats');
insert into emp_team (emp_id, team_name) values ('99980', 'blue mountain state goats');

insert into emp_team (emp_id, team_name) values ('99979', 'average joes gym');
insert into emp_team (emp_id, team_name) values ('99978', 'average joes gym');
insert into emp_team (emp_id, team_name) values ('99977', 'average joes gym');
insert into emp_team (emp_id, team_name) values ('99976', 'average joes gym');
insert into emp_team (emp_id, team_name) values ('99975', 'average joes gym');

insert into emp_team (emp_id, team_name) values ('99974', 'the standlot');
insert into emp_team (emp_id, team_name) values ('99973', 'the standlot');
insert into emp_team (emp_id, team_name) values ('99972', 'the standlot');
insert into emp_team (emp_id, team_name) values ('99971', 'the standlot');
