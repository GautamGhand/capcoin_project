<link rel="stylesheet" type="text/css" href="style.css">
<?php 
session_start();
if(!isset($_SESSION['login']))
{
    header('location:user/user_login.php');
}
include('controller.php');
$obj=new buy();
$data=$obj->details();
if(isset($data['money']['money']))
{
echo "<span class='totalmoney'>Wallet Balance = $".number_format($data['money']['money'],2)."</span>";
}
echo "<table cellspacing=0 class='user_table'>";
echo "<th>COIN</th>";
echo "<th>NO OF COINS</th>";
echo "<th>MONEY</th>";
if($data)
{
    
foreach($data as $k=>$v)
{
    if($k=='money')
    {
        break;
    }
    echo "<tr>";
    echo "<td>".$v['coinid']."</td>";
    echo "<td>".$v['noofcoins']."</td>";
    echo "<td>$".$v['price']."</td>";
    echo "</tr>";
}
echo "</table>";
}
?>
<html>
    <head>
        <title>USER DETAILS</title>
    </head>
    <body>
        <a href="index.php" class='addmoney'>BACK</a>
    </body>
</html>