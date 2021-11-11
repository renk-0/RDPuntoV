create table Sales(
	id bigint not null auto_increment,
	primary key(id),
	product int default null,
	foreign key(product) references Products(id) on delete set null,
	quantity int not null default 1
);

create table Basket(
	id bigint not null auto_increment,
	primary key(id),
	product int not null,
	foreign key(product) references Products(id) on delete cascade,
	quantity int not null default 1,
	uid int not null,
	foreign key(uid) references Users(id) on delete cascade
);

delimiter $$

create trigger _sale_insert before insert
on Sales for each row
begin
	declare _stock bigint;
	select 0 into _stock;
	select stock into _stock from Products 
	where id = new.product;
	if new.quantity > _stock then
		signal sqlstate '02000' set MESSAGE_TEXT = "Fuera de stock";
	end if;
end$$

create trigger _sale_made before insert
on Sales for each row
begin
	update Products set stock = stock - new.quantity where id = new.product;
end$$

create trigger _basket_insert before insert
on Basket for each row
begin
	declare _stock bigint;
	select 0 into _stock;
	select stock into _stock from Products 
	where id = new.product;
	if new.quantity > _stock then
		signal sqlstate '02000' set MESSAGE_TEXT = "Fuera de stock";
	end if;
end$$

delimiter ;
