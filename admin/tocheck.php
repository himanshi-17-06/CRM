<!DOCTYPE html>
<?php
session_start();
if(isset($_POST['submit']))
{
   $captcha = $_SESSION['captcha'];
    if($_POST['captcha']== $captcha)
    {
        echo 'matched';
    }
    else
    {
        echo 'mismatched';
    }
}
?>
<html>
    <head>
        <title>CRM</title>
    </head>
    <body>
        <form action="" method="post">
            <p><input type="text" name="captcha"></p>
            <p><img src="image.php" /></p>
            <p><button type="submit" name="submit" >Submit</button></p>
        </form>
    </body>
</html>