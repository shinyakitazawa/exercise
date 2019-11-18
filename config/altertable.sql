alter table users add authority int(1) not null after password;
alter table documents add userid int(11) not null after id;
alter table names add userid int(11) not null after category;
update documents set userid=1;
update names set userid=1;
update users set authority=1;
