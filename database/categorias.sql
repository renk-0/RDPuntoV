create table Categories(
	id int not null auto_increment,
	primary key (id),
	name varchar(20) not null,
	description text not null,
	color varchar(6) not null
);

insert into Categories(name, description, color)
values ("Sin categoria", "Un producto sin categoria", "#FFFFFF");
