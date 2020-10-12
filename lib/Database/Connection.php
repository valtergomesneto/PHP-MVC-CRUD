<?php

	abstract class Connection
	{
		
		private static $conn;

		public static function getConn()
		{
			if (self::$conn ==null){
				self::$conn = new PDO('mysql: host=192.168.100.138; dbname=serie-criando-sites;', 'root', '');
			}
			

			return self::$conn;
		}
	}