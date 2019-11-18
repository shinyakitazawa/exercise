create table names (
    category varchar(100),
    userid int(11),
    name varchar(100),
    unique (category, userid, name)
);

desc names;