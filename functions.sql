
--Calculate the number of employees withn each department
DELIMITER //

create function countEmployeesInDept(department_name varchar(30))
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
