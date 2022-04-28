
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
	return dep_avg_salary;
	END //
DELIMITER ;
