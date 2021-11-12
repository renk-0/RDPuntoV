create table Users(
	id int not null auto_increment,
	primary key (id),
	name varchar(20) not null unique,
	password varchar(60) not null,
	email varchar(255) not null,
	role enum('ADMIN') not null default 'ADMIN'
);

insert into Users(name, password, email)
values ("root", "$2a$12$2BtFUFZQqcCuy4nhuw7LVuxWCI6XXOwq2rjxuPkusOBhEbdvyaLC6",
		"Mauricio.291202@gmail.com");
