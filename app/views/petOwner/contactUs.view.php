<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Contact Us </title>  
        <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?= ROOT ?>/assets/css/petOwner/colourPalette.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/PO_commonStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/cardStyles.css" rel="stylesheet">
        <link href="<?= ROOT ?>/assets/css/petOwner/contactUs.css" rel="stylesheet">

        <link href="<?= ROOT ?>/assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">

        
    </head>
    <body>
        <!-- navbar on top: -->
        <?php include_once '../app/views/navbar/po_Sidebar.php'; ?>
        <script> const ROOT = `<?= ROOT ?>`; </script>

        <div class="bodyArea">

            <section class="dashArea" id="FAQs">
                <h2 class="dashHeader">FAQ</h2>

                <details name="faq">
                    <summary>What is VetiPlus pet care management system?</summary>
                    VetiPlus is a web-based platform that connects pet owners with veterinary and grooming services.
                    It allows users to book appointments, manage schedules, and access various pet care features
                    in one convenient interface.
                </details>
                <details name="faq">
                    <summary>Who can use this system?</summary>
                    The system is designed for:
                    <ul><li>Pet owners: To book and manage vet or salon appointments.</li>
                        <li>Veterinarians: To handle consultations and manage schedules.</li>
                        <li>Pet salons: To manage grooming appointments and customer interactions.</li>
                        <li>Vet Assistants: To find and assist Veterinarians.</li>
                    </ul>
                </details>
                <details name="faq">
                    <summary>What services are supported by the system?</summary>
                    Our platform supports:
                    <ul><li>Petcare at your fingertips</li>
                        <li>Appointment management and scheduling.</li>
                        <li>Connecting service providers and pet-owners</li>
                    </ul>
                </details>
                <details name="faq">
                    <summary>How can I book an appointment?</summary>
                    Pet owners can log in, select the desired service (vet or salon),
                    choose an available date and time, and confirm the appointment.
                </details>
                <details name="faq">
                    <summary>Can I cancel or reschedule appointments?</summary>
                    Yes, pet owners can reschedule appointments upto a mximum of 3 per month at no additional cost.
                    Note, however, that no refunds will be issued at any normal circumstance.
                </details>
                <details name="faq">
                    <summary>Do I need to download anything to use the system?</summary>
                    No, the system is entirely web-based and can be accessed via a browser
                    on any device, including desktops, laptops, tablets, and smartphones.
                </details>
                <details name="faq">
                    <summary>Is my personal data secure?</summary>
                    Yes, the system employs secure data storage and encryption methods to protect all user data.
                </details>
                <details name="faq">
                    <summary>What if I encounter an issue with the system?</summary>
                    If you face any issues, once you are logged in, you can contact our support team via the feedback form.
                    We aim to resolve all queries ASAP.
                </details>
            </section>

            <section class="dashArea" id="vpDetails">
                <img src="<?= ROOT ?>/assets/images/petOwner/vp-logo.png" class="vpLogo" alt="VetiPlus logo">
                <div>
                    <h2>Address</h2>
                    <p>UCSC Building Complex,<br/>
                    35 Reid Ave,<br/>
                    Colombo 00700</p>
                </div>
                <div>
                    <h2>Email</h2>
                    <p>vetiplus737@gmail.com</p>
                </div>
                <div>
                    <h2>Call us</h2>
                    <p>+94 12 345 6789<br/>+94 12 345 6789</p>
                </div>
            </section>

            <!-- <section class="dashArea">
                <h3 class="dashHeader">Send us a Message</h3>

                <form action="" method="post" enctype="multipart/form-data" id="contactUsForm">
                    <div class="formGroup">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" min="5" placeholder="Enter your name" required>
                    </div>
                    <div class="formGroup">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="formGroup">
                        <label for="contactNumber">Contact number</label>
                        <input type="text" id="contactNumber" name="contactNumber" min="10"
                            placeholder="Enter your contact number" required>
                    </div>
                    <div class="formGroup">
                        <label for="type">Select a Message type</label>
                        <select name="type" id="type">
                            <option value="feedback" selected>Feedback</option>
                            <option value="complaint">Complaint</option>
                        </select>
                    </div>

                    <div class="for-Complaint formGroup">
                        <div class="formGroup">
                            <button class="cardBtn" type="button">
                                <label for="profilePicture">Upload an image:</label>
                            </button>
                            <input type="file" id="profilePicture" class="complaintInput" accept="image/*" name="profilePicture" hidden disabled>
                        </div>
                        <div class="formGroup">
                            <label for="issue">Issue:</label>
                            <textarea id="issue" name="issue" class="complaintInput" disabled></textarea>
                        </div>
                    </div>

                    <div class="for-Feedback formGroup">
                        <div class="formGroup">
                            <label for="rating">Rating:</label>
                            <input type="number" id="rating" name="rating" min="1" max="5" class="feedbackInput" hidden>
                            <div id="starContainer"></div>
                        </div>
                        <div class="formGroup">
                            <label for="comment">Comment:</label>
                            <textarea id="comment" name="comment" class="feedbackInput"></textarea>
                        </div>
                    </div>

                    <button class="cardBtn" type="submit">Submit</button>
                    <button class="cardBtn" type="reset">Reset</button>
                </form>
            </section> -->


            <!-- <div class="contact-form">
                <h2>Send us a Message</h2>
                <form action="<?=ROOT?>/SalonContact" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="email">Email</label> -->
                            <!-- <input type="hidden" id="email" name="email" value = "<?= $email ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label for="messageType">Message Type</label>
                            <select id="messageType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Inquiry">Inquiry</option>
                            </select>
                        </div>
                    </div>

                    <div id="messageContainer" class="form-group" style="display:none;">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
                    </div>

                    <div id="ratingContainer" class="form-group" style="display:none;">
                        <label>Rating</label>
                        <div class="rating">
                            <input type="radio" name="rate" id="rate-5" value="5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4" value="4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3" value="3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2" value="2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1" value="1">
                            <label for="rate-1" class="fas fa-star"></label>
                        </div>
                    </div>

                    <div id="uploadContainer" class="form-group" style="display:none;">
                        <label for="imageUpload">Upload Image</label>
                        <div class="file-upload">
                            <input type="file" id="imageUpload" name="image" accept="image/*">
                            <span class="file-upload-text">Choose file</span>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" name="contactSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form> -->
            <!-- </div> --> -->
    
            <!-- footer at page's bottom: -->
            <?php include_once '../app/views/navbar/po_Footer.php'; ?>

        </div>

        <script src="<?=ROOT?>/assets/js/petOwner/popUp.js"></script>
        <script src="<?=ROOT?>/assets/js/petOwner/submitForm.js"></script>
        <!-- <script>
            interactiveStarRating('starContainer')

            const contactUsForm = document.getElementById('contactUsForm');
            const typeSelect = document.getElementById('type');

            const complaintInputs = contactUsForm.querySelectorAll('.complaintInput');
            const feedbackInput = contactUsForm.querySelectorAll('.feedbackInput');

            const complaintsDiv = contactUsForm.querySelector('for-Complaint');
            const feedbacksDiv = contactUsForm.querySelector('for-Feedback');

            typeSelect.addEventListener('change', () => {
                const typeState = (typeSelect.value == "feedback");

                complaintInputs.forEach(x => {x.disabled = typeState; x.required = !typeState});
                feedbackInput.forEach(x => {x.disabled = !typeState; x.required = typeState});

                complaintsDiv.style.display = (typeState ? 'none' : 'flex');
                feedbacksDiv.style.display = (typeState ? 'flex' : 'none');
            })
        </script> -->


    </body>
</html>