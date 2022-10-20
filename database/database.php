<?php 

class Database
{
    public $obj;
    function connect()
    {
        $this->obj=new PDO('mysql:dbname=coincap_project;host=localhost;','root','');
        return $this->obj;
    }
}

?>