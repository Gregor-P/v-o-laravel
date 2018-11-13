/*
Created		25/10/2018
Modified		25/10/2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table users (
	id Int NOT NULL AUTO_INCREMENT,
	image_id Int,
	username Varchar(64) NOT NULL,
	password Varchar(40) NOT NULL,
	email Varchar(128) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table posts (
	id Int NOT NULL AUTO_INCREMENT,
	user_id Int NOT NULL,
	title Varchar(128) NOT NULL,
	content Varchar(2048) NOT NULL,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table images (
	id Int NOT NULL AUTO_INCREMENT,
	filename Varchar(255) NOT NULL,
	src Varchar(512) NOT NULL,
	timestamp Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


Alter table posts add Foreign Key (user_id) references users (id) on delete  restrict on update  restrict;
Alter table users add Foreign Key (image_id) references images (id) on delete  restrict on update  restrict;


