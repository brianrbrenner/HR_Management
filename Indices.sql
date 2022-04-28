-- Create index on dept_name attribute of employee relation such that 
-- all employees within a given department can be found without having
-- to search through the entire file
CREATE INDEX Idx1 ON employee(dept_name);