<?php 
if (isset($_SESSION['user_id']))
{
    $user_id=$_SESSION['user_id'];
}
    if(isset($_POST['buybtn']))
    {
        $obj=new buy($_POST);
        $obj->buy();
    }
    if(isset($_POST['sellbtn']))
    {
        $obj=new buy($_POST);
        $obj->sell();
    }
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <form method="POST" action="">
        <label class="txt">SELL</label>
        <input type="number" name="sell" class="inpt">
        <?php
        if(!empty($_SESSION['error']['sell']))
        {
            echo $_SESSION['error']['sell'];
        }
        ?>
        <input type="submit" name="sellbtn" value="SELL" class="btn">
        <label class="txt">BUY</label>
        <input type="number" name="buy" class="inpt">
        <?php
         if(!empty($_SESSION['error']['buy']))
         {
             echo $_SESSION['error']['buy'];
             unset($_SESSION['error']);
         }
        ?>
        <input type="submit" name="buybtn" value="BUY" class="btn">
    </form>
    </body>
</html>