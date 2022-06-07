<?php
	class DatabasePg {
		private static $dbName 					= 'postgres' ;
		private static $dbHost 					= 'localhost' ;
		private static $dbPort 					= '5432' ;
		private static $dbUsername 			= 'postgres';
		private static $dbUserPassword	= '12345678';

		private static $cont  = null;

		public function __construct() {
			exit('Init function is not allowed');
		}

		public static function connect(){
		   // One connection through whole application
	    	if ( null == self::$cont ) {
		    	try {
		        	self::$cont =  new PDO(
							"pgsql:host=".self::$dbHost.";port=".self::$dbPort.";dbname=".self::$dbName,
							self::$dbUsername, self::$dbUserPassword);
		        }
		        catch(PDOException $e) {
		        	die($e->getMessage());
		        }
	       	}
	       	return self::$cont;
		}

		public static function disconnect() {
			self::$cont = null;
		}
	}
?>
