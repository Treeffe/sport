create database if not exists sport character set utf8 collate utf8_unicode_ci;
use sport;

grant all privileges on sport.* to 'sport_user'@'localhost' identified by 'secret';