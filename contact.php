<?php
include_once 'curd-model.php';
$object = new Customers();
$contactData = $object->getAppContactInfo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starling bags-NI | Contact Us</title>
    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">
    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />
    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />
     <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<style>
    .swal2-modal {
        background-color: #e8f0f0 !important;
        color: #000 !important;

    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="contact_page">
        <h1>Contact us</h1>

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 ctc_form">

                        <form action="" class="myform" onsubmit="validateform()" novalidate>
                            <h3 class="mb-3"> Get in Touch</h3>

                            <div class="form-quote_input">
                                <input type="text" placeholder=" " name="ctc_person_name" id="customerName" required>
                                <label for="customerName">Name *</label>
                                <small>Please enter your name.</small>
                            </div>

                            <div class="form-quote_input mt-3">
                                <input type="email" placeholder=" " name="ctc_person_email" id="customerEmail" required>
                                <label for="customerEmail">Email *</label>
                                <small>Please enter your email address.</small>
                            </div>



                            <div class="form-quote_input mt-3">
                                <input type="tel" placeholder=" " minlength="10" maxlength="11" name="ctc_person_phno" id="customerPhoneNumber" required>
                                <label for="customerPhoneNumber">Phone number *</label>
                                <small>Please enter your phone number.</small>
                            </div>

                            <div class="form-quote_input mt-3">
                                <textarea name="ctc_person_msg" placeholder=" " id="customerMessage"></textarea>
                                <label for="customerMessage">Message</label>
                            </div>

                            <div class="ctc_smt mt-3">
                                <button type="submit" id="submit"><span class="pe-1">Send a message</span>
                                    <?php include("./loaderAnimation.php") ?></button>
                            </div>

                            <input type="hidden" name="action" value="insert" />
                        </form>


                    </div>

                    <div class="col-lg-6 ctc_rgt">
                        <div class="ctc_img">
                            <img src="assets\images\ctc img.jpg" alt="contact_me">
                        </div>

                        <div class="add_info">
                            <?php
                            if (!empty($contactData['address'])) {
                                echo '
                                <div class="cmny_loc">
                                   <div>
                                        <img src="assets\images\location_icon.png" alt="">
                                        <span>'.$contactData['address'].'</span>
                                    </div>
                                </div>';
                            }


                            if (!empty($contactData['phone_number'])) {
                                echo '
                                <div class="cmny_phone">
                                <a href="tel:'.$contactData['phone_number'].'">
                                    <img src="assets\images\phone_icon.png" alt="">
                                    <span>'.$contactData['phone_number'].'</span>
                                </a>

                            </div>';
                            }

                            if (!empty($contactData['email_id'])) {
                                echo '
                                <div class="cmny_email">
                                    <a href="mailto:'.$contactData['email_id'].'">
                                        <img src="assets\images\mail_icon.png" alt="">
                                        <span>'.$contactData['email_id'].'</span>
                                    </a>
    
                                </div>';
                            }
                            ?>
                        </div>



                    </div>

                </div>
                <?php
                        if (!empty($contactData['facebook_link'])||!empty($contactData['twitter_link'])||!empty($contactData['instagram_link'])) {
                            ?>
                <div class="social_link">
                    <ul>
                        <?php
                        if (!empty($contactData['facebook_link'])) {
                            echo '<li><a href="' . $contactData['facebook_link'] . '">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a></li>';
                        }
                        if (!empty($contactData['twitter_link'])) {
                            echo '<li><a href="' . $contactData['twitter_link'] . '">
                                    <i class="fa-brands fa-twitter"></i>
                                </a></li>';
                        }
                        if (!empty($contactData['instagram_link'])) {
                            echo '<li><a href="' . $contactData['instagram_link'] . '">
                                    <i class="fa-brands fa-instagram"></i>
                                </a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php
                    } ?>
            </div>
        </div>

    </div>

    </div>



    <?php include("footer.php") ?>
    <script>
        var form = document.querySelector('form');

        function validateform() {



            if (!form.checkValidity()) {

                event.preventDefault();
                form.classList.add('was_validate');

            }


        }
    </script>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        resetForm();

        function resetForm() {
            $(".myform")[0].reset();
        }
        // $('.myform').submit(function(e) {
        $(document).on('submit', '.myform', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            // $(this).prop('disabled', true);
            if (form.checkValidity()) {
                $('#submit').prop("disabled", true);
                $('.loaderMainContainer').css("display", "inline-block");
            }
            $.ajax({
                url: "ajaxcallfunctions.php",
                method: "POST",
                // data: new FormData(this),
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    $('#submit').prop("disabled", false);
                    $('.loaderMainContainer').css("display", "none");
                    // console.log(response);
                    if (response != 1) {
                        Swal.fire({
                            title: "Oops..?",
                            text: "Please fill the required fields",
                            icon: "info"
                        });
                        resetForm();


                    } else {
                        Swal.fire({
                            title: "Thank you for contacting us !!!",
                            text: "We will reach out to you as soon as possible.",
                            icon: "success",
                            confirmButtonText: 'Close'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = window.location.href;

                            }
                        });
                        resetForm();
                        //location.reload(true);
                        $(this).prop('disabled', false);
                    }
                }

            });

        });
    });
</script>