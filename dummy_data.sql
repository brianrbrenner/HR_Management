-- //////////////////////////// --
-- this is the dummy data page
-- use with caution 
--

-- dummy data for manager

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

-- dummy data for department
insert into department (dept_name, budget, phone, building) values ('software engineering', '1000000', '0987654321', 'math and science');
insert into department (dept_name, budget, phone, building) values ('physics', '3000000', '9876543210', 'williams');
insert into department (dept_name, budget, phone, building) values ('music', '900000', '8765432109', 'glauser');
insert into department (dept_name, budget, phone, building) values ('visual arts', '750000', '7654321098', 'center for visual arts');
insert into department (dept_name, budget, phone, building) values ('medical', '5000000', '6543210987', 'cunningham');
insert into department (dept_name, budget, phone, building) values ('chemistry', '15000000', '5432109876', 'isb');


-- dummy data for employee
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

--/////////////////////////--
-- read me carefully
-- this is the dummy dummy data for teams
-- if you want data with more offical titles please reference line 110

insert into team (team_name, manager_id, total_members) values ('the A team', '00001', '10');
insert into team (team_name, manager_id, total_members) values ('the breakfast club', '00015', '5');
insert into team (team_name, manager_id, total_members) values ('blue mountain state goats', '00013', '5');
insert into team (team_name, manager_id, total_members) values ('average joes gym', '00007', '5');
insert into team (team_name, manager_id, total_members) values ('the standlot', '00002', '4');

--//////////////////////////////////////--
-- read me carefully
-- this is the dummy dummy data for emp_team
-- if you use offical titles please reference line 121

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

/*
--///////////////////////////////////////--
-- more offical sounding data
-- dummy data for teams

insert into team (team_name, manager_id, total_members) values ('alpha', '00001', '10');
insert into team (team_name, manager_id, total_members) values ('beta', '00015', '5');
insert into team (team_name, manager_id, total_members) values ('gamma', '00013', '5');
insert into team (team_name, manager_id, total_members) values ('theta', '00007', '5');
insert into team (team_name, manager_id, total_members) values ('phi', '00002', '4');

-- dummy data for emp_team

insert into emp_team (emp_id, team_name) values ('99999', 'alpha');
insert into emp_team (emp_id, team_name) values ('99998', 'alpha');
insert into emp_team (emp_id, team_name) values ('99997', 'alpha');
insert into emp_team (emp_id, team_name) values ('99996', 'alpha');
insert into emp_team (emp_id, team_name) values ('99995', 'alpha');
insert into emp_team (emp_id, team_name) values ('99994', 'alpha');
insert into emp_team (emp_id, team_name) values ('99993', 'alpha');
insert into emp_team (emp_id, team_name) values ('99992', 'alpha');
insert into emp_team (emp_id, team_name) values ('99991', 'alpha');
insert into emp_team (emp_id, team_name) values ('99990', 'alpha');

insert into emp_team (emp_id, team_name) values ('99989', 'beta');
insert into emp_team (emp_id, team_name) values ('99988', 'beta');
insert into emp_team (emp_id, team_name) values ('99987', 'beta');
insert into emp_team (emp_id, team_name) values ('99986', 'beta');
insert into emp_team (emp_id, team_name) values ('99985', 'beta');

insert into emp_team (emp_id, team_name) values ('99970', 'gamma');
insert into emp_team (emp_id, team_name) values ('99983', 'gamma');
insert into emp_team (emp_id, team_name) values ('99982', 'gamma');
insert into emp_team (emp_id, team_name) values ('99981', 'gamma');
insert into emp_team (emp_id, team_name) values ('99980', 'gamma');

insert into emp_team (emp_id, team_name) values ('99979', 'theta');
insert into emp_team (emp_id, team_name) values ('99978', 'theta');
insert into emp_team (emp_id, team_name) values ('99977', 'theta');
insert into emp_team (emp_id, team_name) values ('99976', 'theta');
insert into emp_team (emp_id, team_name) values ('99975', 'theta');

insert into emp_team (emp_id, team_name) values ('99974', 'phi');
insert into emp_team (emp_id, team_name) values ('99973', 'phi');
insert into emp_team (emp_id, team_name) values ('99972', 'phi');
insert into emp_team (emp_id, team_name) values ('99971', 'phi');
*/