create table documents (
    id int not null auto_increment primary key,
    id int(11) not null,
    category varchar(255),
    filename varchar(255) unique, 
    path varchar(255),
    created datetime,
    modified datetime
);

desc documents;