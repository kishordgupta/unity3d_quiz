<?php

//...........Local Settings.................	this is superfreeapps cms and web services
define('HOST', $_SERVER['SERVER_NAME']);
define("DB_HOST", ("localhost"));
define("DB_USER", ((HOST == 'localhost') ? "root" : 'silicono_trivia'));
define("DB_PASS", ((HOST == 'localhost') ? "123" : '4)vzCi5W4FSZ'));
define("DB_NAME", ((HOST == 'localhost') ? "silicono_trivia" : 'silicono_trivia'));

//..........database connection............
mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't connect with database!");
mysql_select_db(DB_NAME) or die("Database not found!");

//...........define site name & important variables.............
$SITE_NAME = "Trivia";
$SITE_URL = "http://" . $_SERVER['SERVER_NAME'] . ((HOST == 'localhost') ? "/trivia/" : "/");
$SITE_ROOT = $_SERVER['DOCUMENT_ROOT'] . ((HOST == 'localhost') ? "/trivia/" : "/");
$SITE_TITLE = "Welcome to " . $SITE_NAME;
$SITE_ADDR = $_SERVER['SERVER_NAME'];
$ADMIN_URL = $SITE_URL . "trivia_admin/";
$ADMIN_TITLE = " | " . $SITE_NAME;
$ADMIN_CAPTION = $SITE_NAME;

define("SALT_VAR", "TR#I4VI5A5A@!aT*89I1NG");
define("SITE_NAME", $SITE_NAME);

define("FROM_EMAIL", "rupen@techintegrity.in");
define("EMAIL", "hitesh@techintegrity.in");

//...............set server level settings.....................
date_default_timezone_set('UTC');
ini_set('memory_limit', '40M');
ini_set('post_max_size', '40M');
ini_set('upload_max_filesize', '40M');
$today = $date = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
error_reporting(0);