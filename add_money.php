<html>

<head>
    <title>ADD MONEY</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <section class="container">
        <section class="frm">
            <form action="" method="POST">
                <label class="text">ADD MONEY</label>
                <input type="number" name="money" class="input">
                <input type="submit" name="submit" value="ADD MONEY" class="button">
            </form>
        </section>
    </section>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:user/user_login.php');
}
include('controller.php');
if (isset($_POST['submit'])) {
    $obj = new buy($_POST);
    $obj->addmoney();
}
?>