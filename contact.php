<?php
require 'dbconfig/config.php';
?>
<!doctype html>
<html>
    <head>
        <title>CRM</title>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/contact.css" />
        <style>
            body{
                background-attachment: fixed;
             /* background-position: center;*/
                background-repeat: no-repeat;
                background-size: cover;
            }
            .logo{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
            #mein{
                position: fixed;
                top: 0px;
                right: 0px;
                left: 0px;
                z-index: 2000;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <header id="header" class="alt">
				<div class="logo"><a href="index.html">
                    <img src="images/crm%20Logo.png" alt="CRM">
                    </a></div>
				<a href="#menu" id="mein">Menu</a>
        </header>
        <nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About us</a></li>
					<li><a href="signup.php">Sign Up</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contact Us</a> </li>
                    <li><a href="offers.php">Offers</a></li>
                    <li><a href="faq.php">FAQs</a></li>
				</ul>
        </nav>
    <div class="contact">
        <div class="heading">
             <h1> CONTACT US </h1>
        </div>
        <div class="left-side">
            <address>
                <h3>Address</h3>
                <p>Women's Polytechnic, AMU</p>
                <h3>Phone</h3>
                <p>9045379300</p>
                <h3>E-Mail</h3>
                <a href="mailto:himanshi.varshney56@gmail.com">himanshi.varshney56@gmail.com </a>
            </address>
            <img src="images/contact.png">
        </div>
        <div class="right-side">
             <form action="" method="post">
                 <label>Full Name</label>
                 <input type="text" name="full_name" placeholder="Full Name" required>
                 <label>Email</label>
                 <input type="text" name="email" placeholder="Email" required>
                 <label>Subject</label>
                 <input type="text" name="subject" placeholder="Subject" required>
                 <label>Message</label>
                 <textarea name="message" placeholder="Message" rows=10 style="color: black;"></textarea> 
                 <button type="submit" name="submit_btn">Send</button>
            </form>
        </div>   
    </div>
        <?php
        if(isset($_POST['submit_btn']))
        {
            $fullname = $_POST['full_name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            
            $query = "insert into contact_table (fullname, email, subject, message) values('$fullname', '$email', '$subject', '$message')" ;
            $query_run = mysqli_query($con, $query);
            if($query_run)
            {
              echo '<script type="text/javascript"> alert("Your message has been submitted successfully")</script>';  
            }
            else
            {
                echo '<script type="text/javascript"> alert("'.mysqli_error($con).'")</script>';
            }
        }
        ?>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/skel.min.js"></script> 
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>