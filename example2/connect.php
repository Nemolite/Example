<?php

namespace individual\database;

use PDO;
use individual\tools; // debug



class connect {

    private  $dbconnect;

    public function __construct()
    {
        $this->setConnect();
    }

    /**
     * @return $this
     */

     public function setConnect()
     {
         $ini_array = parse_ini_file("config.ini");

         $dsn = 'mysql:dbname='.$ini_array[dbname].';host='.$ini_array[host];

         $user = $ini_array[username];
         $password = $ini_array[userpass];

         $this->dbconnect  = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

         return $this;

     }


    /**
     * @return array
     */
    public function query($sql,$value=[]){

        $line = $this->dbconnect->prepare($sql);

        $line->execute($value);

        $result = $line->fetchAll(PDO::FETCH_ASSOC);

        if($result=== false){
            return [];
        }

        return $result;

    }

    public function execute($sql, $values = [])
    {
        $sth = $this->dbconnect->prepare($sql);
        return $sth->execute($values);
    }

}

