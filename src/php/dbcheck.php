<?php
$db = new PDO("mysql:host=localhost", 'host', '');
$db->query("create database if not exists adventurer");
$db->query("use adventurer");
$db->query("create table if not exists accounts(
	firstname varchar(50),
	lastname varchar(50),
	username varchar(50) primary key,
	password varchar(75),
	email varchar(50),
	date timestamp default current_timestamp,
	access int
)");

$db->query("create table if not exists cfeatures(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	cfeature text
)");

$db->query("create table if not exists rfeatures(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	rfeature text
)");

$db->query("create table if not exists feats(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	feat text
)");

$db->query("create table if not exists inventory(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	item text
)");

$db->query("create table if not exists languages(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	language text
)");

$db->query("create table if not exists powers(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	power text,
	type varchar(50)
)");

$db->query("create table if not exists wealth(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	copper int,
	silver int,
	gold int,
	platinum int
)");

$db->query("create table if not exists characters(
	id int primary key auto_increment,
	charname varchar(75),
	username varchar(50),
	level int,
	xp int,
	age int,
	weight varchar(50),
	height varchar(50),
	class varchar(50),
	race varchar(50),
	gender varchar(50),
	deity varchar(50),
	notes text,
	strength int,
	constitution int,
	dexterity int,
	intelligence int,
	wisdom int,
	charisma int,
	armor int,
	armorclass int,
	armormisc int,
	fortclass int,
	fortmisc int,
	refclass int,
	refmisc int,
	willclass int,
	willmisc int,
	atkclass int,
	atkfeat int,
	atkmisc int,
	damfeat int,
	dammisc int,
	currenthp int,
	maxhp int,
	speed int,
	headslot varchar(100),
	neckslot varchar(100),
	chestslot varchar(100),
	armsslot varchar(100),
	handsslot varchar(100),
	finger1 varchar(100),
	finger2 varchar(100),
	waistslot varchar(100),
	legsslot varchar(100),
	feetslot varchar(100),
	acrobatics varchar(50),
	arcane varchar(50),
	athletics varchar(50),
	bluff varchar(50),
	diplomacy varchar(50),
	dungeoneering varchar(50),
	endurance varchar(50),
	heal varchar(50),
	insight varchar(50),
	intimidation varchar(50),
	nature varchar(50),
	perception varchar(50),
	religion varchar(50),
	stealth varchar(50),
	streetwise varchar(50),
	thievery varchar(50),
	history varchar(50)
)");
?>
