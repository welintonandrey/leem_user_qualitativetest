<?php

class dbManager {

    private static $dir = "videos.sqlite";
    
    public static function getConnection() {
		$db = new SQLite3(self::$dir) or die("cannot open the database");
		return $db;
	}

}
?>
