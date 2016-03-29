<?php

		error_reporting(0); 
		$host = 'localhost';
        $database = 'datadiggers2';
        $username = 'root';
        $password = 'azimroot';

        /**
         * START OF CONNECTION CREATION AND DATABASE SELECTION
         */

        //connect to database using mysql_* (the old deprecated way)
        $link = mysqli_connect($host, $username, $password, $database);
        if(!$link) {
            die('Error: ' . mysql_error());
        }

        //connect to database using PDO (the new way)
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage() . '<br />';
            die();
        }
