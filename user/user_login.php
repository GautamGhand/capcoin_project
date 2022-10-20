<?php
include('controller.php');
if (isset($_POST['submit']))
{
    $obj = new User($_POST);
    $obj->login();
}
?>
<html>

<head>
    <title>USER LOGIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body class="loginbody">
    <section class="container">
        <H1 class="heading">USER LOGIN PAGE</H1>
        <section class="frm">
            <div>
            <img src="../images/coincap.png" class='logoheading' alt="not found">
            </div>
            <div>
            <form action="user_login.php" method="POST">
                <label class="text">USERNAME</label>
                <input type="email" name="UserName" class="input">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['email']))
                    {
                        echo $_SESSION['error']['email'];
                    }
                    ?>
                </div>
                <label class="text">PASSWORD</label>
                <input type="password" name="UserPassword" class="input">
                <div class="error">
                    <?php
                    if(!empty($_SESSION['error']['password']))
                    {
                        echo $_SESSION['error']['password'];
                           unset($_SESSION['error']);
                    }
                    ?>
                </div>
                <input type="submit" value="SUBMIT" name="submit" class="button">
            </form>
        </section>
        <div class="d">
        <a href="../user/user_signup.php" class="lgn">USER SIGNUP</a>
        </div>  
            </div>
                </section>
        
           
    
</body>

</html>
