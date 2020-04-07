create table user(
ID int auto_increment,
firstname varchar(255) not null,
lastname varchar(255) not null,
email varchar(255) not null,
password varchar(255) not null,
primary key (ID));

Insert into user(firstname,lastname,email,password)
values ("Angel","Sanabria","angelsanabria415@gmail.com","123456"),
("Bob","Smith","bobsmith@gmail.com","password");

select * from user;