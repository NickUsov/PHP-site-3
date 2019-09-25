<?php
    class Tools
    {
        public static function connect($host='localhost:3306',$user='root', $password='', $dbname='shop_db')
        {
            $cs = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
            ];
            try
            {
                $pdo= new PDO($cs, $user, $password, $options);
                return $pdo;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
                return false;
            }
        }
    }
?>