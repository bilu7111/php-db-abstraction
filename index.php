<?php
    declare(strict_types=1);
    $dsn = __YOUR_DB_CREDENTIALS__;
    $connect = new Acess_DB($dsn);
    $query=__QUERY__;
    try{
    print $connect->set_DB();
    $connect->query_DB($query);
  }
  catch(PDOException $e){
      print $e->getMessage();
  }
?>
