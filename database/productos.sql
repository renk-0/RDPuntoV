create table Products(
	id int not null auto_increment,
	primary key(id),
	name varchar(30) not null,
	description text not null,
	price decimal(14, 4) not null,
	image varchar(32) not null,
	category int default 1,
	foreign key(category) references Categories(id) on delete set null,
	stock bigint not null
);
