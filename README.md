# php-db-abstraction
This is a specific code for PHP.  It abstracts the PHP interaction with database. It is an Object Oriented Approach. I have created this code to help you create a base. The main Database class can be extended for data manipulation.

# How to use?
The main Database class can be extended and arguments can be passed to parent constructor. The Database class's constructor requires one argument that is <b>DSN</b>. This DSN variable contains the host and database name. Other optional arguments are <b>username</b> and <b>password</b>. The Database class has a protected method called <b>init_DB</b> that uses a PDO(PHP Database Object) class object. It provides a data-access abstraction layer. 
Here is th Database Class:

        class Database {
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
     

You may also have noticed the clean_PDO method. It defines what it does. It is used to clean the PDO object once you are finished with accessing the database. 
Here is an extended class that I have created just to help you understand the usage of it:

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
        /*--This function executes a query using the PDO interface--*/
                public function query_DB($sqlQuery){
                    return $this->database_handler->query($sqlQuery);
                }
        }


And how would you use it:

        $dsn = __YOUR_DB_CREDENTIALS__;
        $connect = new Acess_DB($dsn);
        $sqlQuery=__SQL_QUERY__;
        try{
            print $connect->set_DB();
            $connect->query_DB($sqlQuery);
        }
        catch(PDOException $e){
            print $e->getMessage();
        }


I am using the exception handling to catch any error. PDO throws a PDOException object upon any error occurred. This is really useful for error handling. Your Database Credentials should be passed in that form <b> 'mysql:host=localhost;dbname=test', $user, $pass </b> if you are using <b>MySQL</b> and your DB has username and password. For more, you can check out PHP PDO, a data-access abstraction layer documentation. This class is fully extendable meaning you can add the most specific features you need.
