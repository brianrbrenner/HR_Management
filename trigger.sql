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