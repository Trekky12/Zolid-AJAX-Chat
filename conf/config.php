<?php
class Config
{
  function Config()
  {
    // Database
    $this->DB_TYPE = 'mysql';
    $this->DB_PORT = '3306'; 
    $this->DB_CHARSET = 'utf8';
    $this->DB_HOST = 'localhost';
    
    $this->DB_USER = '';
    $this->DB_PASSWORD = '';
    $this->DB_DATABASE = '';
    
     
  }
}  
?>
