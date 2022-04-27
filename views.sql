
-- Create a view which does not provide the salary information of employees
-- This is used to keep salary information hidden from regular employees
create view employeeRedacted AS
	select 
        emp_id, name, dept_name, phone, email,  start_date
    from employee;

