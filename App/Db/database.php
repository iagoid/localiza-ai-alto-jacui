<?php
    namespace App\Db;

    use \PDO;

    class Database
    {
        const HOST = 'localhost';
        const NAME = 'localiza_ai';
        const USER = 'root';
        const PASSWORD = '';

        private $table;
        private $connection;

        function __construct($table = null)
        {
            $this->table = $table;
            $this->setConnection();
        }

        private function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME.'', self::USER, self::PASSWORD);
                $this->connection->setAtribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOexception $e){
                die('ERROR: '.$e->setMessage());
            }
        }
    }
?>