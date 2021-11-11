create table Transactions(
	id int not null auto_increment,
	primary key(id),
	t_date datetime not null,
	description varchar(255) not null,
	details text not null,
	uid int default null,
	foreign key(uid) references Users(id) on delete set null
);
