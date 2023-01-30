<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
<?php include "includes/contact_header.php"?>



<!-- wrapper-->
<div id="wrapper">
    <!-- content-->
    <div class="content">
        <!--  section  -->
        <section class="parallax-section single-par" data-scrollax-parent="true">
            <div class="bg par-elem " style="background-image: url(images/bg/1.jpg)"  data-scrollax="properties: { translateY: '30%' }"></div>
            <div class="overlay op7"></div>
            <div class="container">
                <div class="section-title center-align big-title">
                    <h2><span>Welcome to my Blog</span></h2>
                    <span class="section-separator"></span>
                    <h4>Contact Me</h4>
                </div>
            </div>
            <div id="arrow" class="header-sec-link">
                <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down bounce"></i></a>
            </div>
        </section>
        <!--  section  end-->
    </div>
</div>



<?php
if(isset($_POST['submit'])){
    $header = "infect3dlad@gmail.com";
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = "From: " . $_POST['email'];
    $message = wordwrap($_POST['message'], 70);


    mail( $header, $name, $subject, $email, $message);
}
?>


<div class="bg-contact100">
    <div  style="padding-top: 80px" class="container-contact100">
        <div class="wrap-contact100">
            <div class="contact100-pic js-tilt" data-tilt>
                <img src="ContactFrom_v12/images/img-01.png" alt="IMG">
            </div>

            <form method="post" class="contact100-form validate-form">
					<span class="contact100-form-title">
						Get in touch
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Name is required">
                    <input class="input100" type="text" name="name" placeholder="Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Subject is required">
                    <input class="input100" type="text" name="subject" placeholder="Subject">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Message is required">
                    <textarea class="input100" name="message" placeholder="Message"></textarea>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-contact100-form-btn">
                    <button name="submit" class="contact100-form-btn">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php include "includes/navigation.php"?>
<a class="to-top"><i class="fas fa-caret-up"></i></a>
<?php include "includes/footer.php"?>
<?php include "includes/contact_footer.php"?>
