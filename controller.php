<?php
include('database/database.php');
include('validation/validation.php');
class buy extends Validation
{
    public $data;
    public $db;
    function __construct($pst=null)
    {
        $this->data=$pst;
        $db=new Database();
        $this->db=$db->connect();
    }
    function buy()
    {
       
        $_SESSION['error']=$this->validateCoins($this->data,'buy');
        $user_id=$_SESSION['user_id'];
        $coinid=$_SESSION['coin']['id'];
        $ncoins=$this->data['buy'];
        $obj=new Api();
        $refresh=$obj->search($coinid);
        if(empty($_SESSION['error']) && isset($_SESSION['login']))
        {
            $data=$this->db->query("Select user_id,noofcoins,price from buy_sell where user_id='$user_id' and coinid='$coinid'");
            $data=$data->fetch();
           
            $mon=$this->db->query("select money from wallet where user_id='$user_id'");
            $mon=$mon->fetch();
            if($data)
            {
                $previousprice=$data['price'];
                $price=$refresh['data']['priceUsd']*$ncoins+$previousprice;
                $money=$mon['money']-$price;
                $ncoins=$data['noofcoins']+$ncoins;
                if($mon)
                {
                    if($mon['money']<=0 || $mon['money']<$price)
                    {
                        $_SESSION['error']['buy']="Your money wallet is insufficient";
                    }
                    else
                    {
                        $this->db->query("update wallet set money='$money' where user_id='$user_id'");
                        $this->db->query("update buy_sell set noofcoins='$ncoins',price='$price' where user_id='$user_id' and coinid='$coinid'");
                        header('location:user_details.php');
                    }
                }
                else
                {
                    $_SESSION['error']['buy']="Please add money in your wallet";
                }
            }
            else
            {
                $price=$refresh['data']['priceUsd']*$ncoins;
                if($mon)
                {
                    if($mon['money']<=0 || $mon['money']<$price)
                    {
                        $_SESSION['error']['buy']="Your money wallet is insufficient";
                    }
                    else
                    {
                        $money=$mon['money']-$price;
                        $this->db->query("update wallet set money='$money' where user_id='$user_id'");
                        $this->db->query("insert into buy_sell(user_id,coinid,noofcoins,price) values('$user_id','$coinid','$ncoins','$price')");
                        header('location:user_details.php');
                    }
                }
                else
                {
                    $_SESSION['error']['buy']="Please add money in your wallet";
                }
                
            }
        }

    }
    function sell()
    {
        $_SESSION['error']=$this->validateCoins($this->data,'sell');
        $user_id=$_SESSION['user_id'];
        $coinid=$_SESSION['coin']['id'];
        $ncoins=$this->data['sell'];
        $obj=new Api();
        $refresh=$obj->search($coinid);
        if(empty($_SESSION['error']) && isset($_SESSION['login']))
        {
            $data=$this->db->query("Select coinid,noofcoins,price from buy_sell where user_id='$user_id' and coinid='$coinid'");
            $data=$data->fetch();
            $mon=$this->db->query("select money from wallet where user_id='$user_id'");
            $mon=$mon->fetch();
            if($data)
            {
                $price=$refresh['data']['priceUsd']*$ncoins;
                $money=$mon['money']+$price;
                $ncoins=$data['noofcoins']-$ncoins;
                if($ncoins==0)
                {
                    $this->db->query("delete from buy_sell where coinid='$coinid' and user_id='$user_id'");
                    $this->db->query("update wallet set money='$money' where user_id='$user_id'");
                }
                elseif($data['noofcoins']<$this->data['sell'])
                {
                     $_SESSION['error']['sell']="You don't have coins to sell";
                } 
                else
                {
                        $this->db->query("update buy_sell set noofcoins='$ncoins',price='$price' where user_id='$user_id' and coinid='$coinid'");
                        $this->db->query("update wallet set money='$money' where user_id='$user_id'");
                        echo "Successfully selled";
                }
            }
            else
            {
                $_SESSION['error']['sell']="You don't have coins to sell";
            }
        }
    }
    function addmoney()
    {
        $user_id=$_SESSION['user_id'];
        $money=$this->data['money'];
        $data=$this->db->query("select money from wallet where user_id='$user_id'");
        $data=$data->fetch();
        if($data)
        {
            $money=$data['money']+$money;
            $this->db->query("update wallet set money='$money' where user_id='$user_id'");
            echo "<h1>MONEY ADDED SUCCESSFULLY</h1>";
        }
        else
        {
            $this->db->query("insert into wallet(user_id,money) values('$user_id','$money')");  
            echo "<h1>MONEY ADDED SUCCESSFULLY</h1>";  
        }  
    }
    function details()
    {
        $user_id=$_SESSION['user_id'];
        $data=$this->db->query("select *from buy_sell where user_id='$user_id' ");
        $data=$data->fetchAll();
        $mny=$this->db->query("select *from wallet where user_id='$user_id' ");
        $mny=$mny->fetch();
        $data['money']=$mny;
        return $data;
    }

}

?>