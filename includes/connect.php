<?php
        //Constantes d'environnement
        define("DBHOST","localhost");
        define("DBUSER","root");
        define("DBPASS","");
        define("DBNAME","handimov");

        //DSN de connexion
        $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

        //on se connecte à la DB : la connexion lève une exception
        try{
            //on instancie PDO
            $db = new PDO($dsn,DBUSER,DBPASS);
            
            //on s'assure d'envoyer les données en UTF8
            $db->exec("SET NAMES utf8");

            //On definit le mode de "fetch" par defaut
            $db->setAttribute
            (PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            die("ERREUR:".$e->getMessage());
        }