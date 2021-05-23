create schema sumin_project;

use sumin_project;

create table user
(
    id          int primary key auto_increment,
    user_id     varchar(50) not null unique ,
    user_name   varchar(50) not null,
    password    varchar(50) not null,
    admin_level int default 0
);

insert into user
set user_id   = 'admin',
    password  = md5('admin'),
    user_name = 'admin';

