<?php
declare(strict_types=1);

class Database {
/**
  * This class is intended to be used as a parent class to initiate the
  * Database PDO object. Other functionalities such as data manipulation
  * should be done using child class methods.
**/
        protected $database_handler;
        protected $dsn;
        protected $user;
        protected $pass;
        protected function __construct($dsn,$user="",$pass=""){
            $this->dsn=$dsn;
            $this->user=$user;
            $this->pass=$pass;
        }
        protected function init_DB(){
            $this->database_handler=new PDO($this->dsn,$this->user,$this->pass);
        }
        protected function clean_PDO(){
            $this->database_handler=null;
        }
}
/*--This is the Child Class that extends the Database Class--*/
/*  Data Manipulation Methods can be added in it  */
class Acess_DB extends Database{
        public function __construct($dsn){
           $this->dsn=$dsn;
        }
/*--This function initiates Database--*/
/*  It will return 1 upon success  */
        public function set_DB(){
            parent::__construct($this->dsn);
            $this->init_DB();
            return 1;
        }
        public function query_DB($sqlQuery){
            return $this->database_handler->query($sqlQuery);
        }
}

?>
