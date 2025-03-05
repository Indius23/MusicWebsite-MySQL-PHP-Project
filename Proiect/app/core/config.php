<?php

if($_SERVER['SERVER_NAME'] == "localhost")
{

	// for local server
	define("ROOT", "http://localhost/Proiect/public");

	define("DBDRIVER", "mysql");
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "spotifydb");


} else{
	
	//for online server
	define("ROOT", "http://www.bibliotecamuzicala.com");

	define("DBDRIVER", "mysql");
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBANAME", "spotifydb");

}
