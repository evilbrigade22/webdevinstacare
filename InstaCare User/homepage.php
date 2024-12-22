<?php
session_start();
include('../database/database_conn.php');
$student_id = $_SESSION['student_id'];
include('php/fetch_student_data.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HealthCare</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="nav">
            <div class="logo">
                <h4><img src="img/instacarelogo.png" alt=""></h4>
            </div>
            <div class="links">
                <a href="homepage.php">Home</a>
                <a href="status.php">Status</a>
                <a href="profile.php">Profile</a>
                <a href="php/logout_function.php" class="mainlink">Logout</a>
            </div>
        </div>

        <!-- LANDING PAGE -->

        <div class="landing">
            <div class="landingText" data-aos="fade-left" data-aos-duration="1000">
                <h1 class="underline" style="color:#e0501b; ">Welcome,
                    <?php echo $f_name ?>
                </h1>
                <h1><span style="color:black;font-size: 3vw; font-style:italic"> Your Trusted Campus Clinic Companion!</span> </h1>
                <div class="btn">
                    <a href="#services">Learn More</a>
                </div>
            </div>
            <div class="landingImage" data-aos="fade-down" data-aos-duration="2000">
                <img src="img/bg.png" alt="">
            </div>
        </div>

        <!-- ABOUT SECTION -->

        <div id="services" class="feat bg-gray pt-5 pb-5">
            <div class="container" data-aos="fade-down" data-aos-duration="1000">
                <div class="row">
                    <div class="section-head col-sm-12">
                        <h4>Our Services!</h4>
                    </div>
                    <div class="content">
                        <div class="col-lg-4 col-sm-6">
                            <div class="item"> <span class="icon feature_box_col_one"><i class="fa fa-globe"></i></span>
                                <div><img src="../InstaCare User/img/chatbot.jpg" style="height: 15rem; padding: 1rem;"></div>
                                <p>It is designed to assist you with any questions you have regarding on clinic. Whether you need to book an appointment, check available services, ask about operating hours, or inquire about medical records, our chatbot is available 24/7 to provide you with accurate and timely information. Just type your question, and let the Clinic Assistant guide you to the answers you need.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="item"> <span class="icon feature_box_col_two"><i class="fa fa-anchor"></i></span>
                                <div><img src="../InstaCare User/img/bp.jpg" style="height: 15rem; padding: 1rem; "></div>
                                <p> Our clinic provides thorough Blood Pressure Monitoring services to support your heart health. Our experienced team ensures accurate readings in a comfortable environment. Visit us to take charge of your health today.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="item"> <span class="icon feature_box_col_three"><i class="fa fa-hourglass-half"></i></span>
                                <div><img src="../InstaCare User/img/consultation.jpg" style="height: 15rem; padding: 1rem; "></div>
                                <p>Our clinic provides a detailed Consultation Record Service to ensure seamless continuity of care. After each visit, your consultation details, including diagnoses, treatments, and recommendations, are meticulously documented and securely stored in our system. This allows both you and our healthcare professionals to easily access and review your medical history, ensuring personalized and effective care at every appointment. </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="item"> <span class="icon feature_box_col_four"><i class="fa fa-database"></i></span>
                                <div><img src="../InstaCare User/img/bookaappiontment.jpg" style="height: 15rem; padding: 1rem;"></div>
                                <p>Schedule your next visit to our clinic as quick and easy. Simply choose your preferred date and time, and our intuitive online system will guide you through the process. Whether you need a routine check-up, a specialist consultation, or follow-up care, our streamlined booking system ensures that you can secure your appointment for better health and book your appointment!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFO SECTION -->


    <div class="infoCards">
        <div class="card one" data-aos="fade-up" data-aos-duration="1000">
            <img src="img" class="cardoneImg" alt="" data-aos="fade-up" data-aos-duration="1100">
            <div class="cardbgone"></div>
            <div class="cardContent">
                <h2>Request Medicine</h2>
                <p>Provide your details, and we'll prepare it for you to pick-up!</p>
                <div>
                    <div class="cardBtn" onclick="openModal('medicineModal')">
                        <img src="" class="cardIcon">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 1: Request Medicine -->
        <div id="medicineModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('medicineModal')">&times;</span>

                <form class="form" action="php/insert_medreq_data.php" method="POST">

                    <h2 style="text-align: center;">Medicine Request</h2>

                    <div class="form-row">
                        <label for="medicine">Medicine:</label>
                        <select id="medicine" name="medicine" required>
                            <?php
                            $query = "SELECT * FROM inventory_db";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id'];
                                    $medicine_name = htmlspecialchars($row['medicine_name']);
                                    echo '<option value="' . $product_id . '">' . $medicine_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="2" required />
                    </div>
                    <div class="form-row">
                        <label for="health-concern">Health Concern :</label>
                        <textarea id="health-concern" name="health-concern" required></textarea>
                    </div>
                    <button class="submit" type="submit">Submit</button>
                </form>

            </div>
        </div>

        <!-- Card 2: Request MedCert -->
        <div class="card two" data-aos="fade-up" data-aos-duration="1300">
            <img src="img/learn.png" class="cardtwoImg" alt="" data-aos="fade-up" data-aos-duration="1200">
            <div class="cardbgtwo"></div>
            <div class="cardContent">
                <h2>Request Medical Certificate</h2>
                <p>Provide your details, and we'll prepare it for you promptly!</p>
                <div>
                    <div class="cardBtn" onclick="openModal('certificateModal')">
                        <img src="img/next.png" alt="" class="cardIcon">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2: Request MedCert -->

        <div id="certificateModal" class="modal">

            <form action="php/insert_medcert_data.php" method="POST" enctype="multipart/form-data">

                <div class="modal-content">
                    <span class="close" onclick="closeModal('certificateModal')">&times;</span>
                    <form class="form" id="certificateForm">
                        <h2 style="text-align: center;">Medical Certificate Request</h2>

                        <div class="form-row">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value=" <?php echo $f_name . ' ' . $m_name . ' ' . $l_name ?>" readonly />
                        </div>
                        <div class="form-row">
                            <label for="purpose">Purpose : </label>
                            <select id="purpose" name="purpose" required>
                                <option value="" style="display: none;">Select</option>
                                <option value="OJT">OJT</option>
                                <option value="School Enrollment">School Enrollment</option>
                                <option value="Travel Purpose">Travel Purpose</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                        <div class="form-row hidden" id="other-purpose-container">
                            <label for="other-purpose">Please specify: </label>
                            <input type="text" id="other-purpose" name="other-purpose" />
                        </div>

                        <script>
                            document.getElementById('purpose').addEventListener('change', function() {
                                var otherPurposeContainer = document.getElementById('other-purpose-container');
                                if (this.value === 'Other') {
                                    otherPurposeContainer.classList.remove('hidden');
                                } else {
                                    otherPurposeContainer.classList.add('hidden');
                                }
                            });
                        </script>
                        <div class="form-row">
                            <label for="uploadLaboratory" name="uploadLaboratory">Upload Laboratory Result :</label>
                            <input type="file" id="uploadLaboratory" name="uploadLaboratory" accept="image/*" required />
                        </div>
                        <button class="submit" type="submit" id="submitBtn">Submit</button>
                    </form>
                </div>
            </form>
        </div>



        <!-- Card 3: Book Appointment -->
        <div class="card three" data-aos="fade-up" data-aos-duration="1600">
            <img src="img/videocall.png" class="cardthreeImg" alt="" data-aos="fade-up" data-aos-duration="1300">
            <div class="cardbgonethree"></div>
            <div class="cardContent">
                <h2>Book Appointment</h2>
                <p>Choose your preferred date and time, and get scheduled quickly.</p>
                <div>
                    <div class="cardBtn" onclick="openModal('appointmentModal')">
                        <img src="img/next.png" alt="" class="cardIcon">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 3: Book Appointment -->
        <div id="appointmentModal" class="modal">
            <form class="form" action="php/insert_appointment_data.php" method="POST">

                <div class="modal-content">
                    <span class="close" onclick="closeModal('appointmentModal')">&times;</span>
                    <h2 style="text-align: center;">Appointment</h2>


                    <div class="form-row">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $f_name . ' ' . $m_name . ' ' . $l_name ?>" readonly />
                    </div>
                    <div class="form-row">
                        <label for="appointment-date">Appointment Date : </label>
                        <input type="date" name="date">
                    </div>
                    <div class="form-row">
                        <label for="appointment-time">Appointment Time : </label>
                        <input type="time" name="time">
                    </div>
                    <div class="form-row">
                        <label for="health-concern">Health Concern:</label>
                        <select id="health-concern" name="health-concern" required>
                            <option value="follow-up">Follow up</option>
                            <option value="consultation">Medical Consultation</option>
                            <option value="bp-monetory">BP Monetory</option>
                            <option value="dental-constultation">Dental Consultation </option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="message">Reason: </label>
                        <textarea name="reason" id="message" required></textarea>
                    </div>
                    <button class="submit">Submit</button>
            </form>
        </div>
    </div>
    </div>



    <!-- BANNER AND FOOTER -->

    <div class="banner">
        <div class="bannerText" data-aos="fade-right" data-aos-duration="1000">
            <h1>Download the Cinic App Today. <br> <span style="font-size:1.6vw;font-weight:normal" class="bannerInnerText">
                    Stay Updated and get all your medical needs taken care of!
                </span> </h1>
            <a href="#"> <img src="img/AndroidPNG.png" alt=""> </a>
            <a href="#"> <img src="img/iosPNG.png" alt=""> </a>
        </div>
        <div class="bannerImg" data-aos="fade-up" data-aos-duration="1000">
            <img src="img/MobileApp.png" alt="">
        </div>
    </div>

    <div class="footer">
        <h2>InstaCare.</h2>

    </div>
    </div>


    <script>
        window.embeddedChatbotConfig = {
            chatbotId: "Ro57Sv3-ew4A5pSMUPdfN",
            domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="Ro57Sv3-ew4A5pSMUPdfN" domain="www.chatbase.co" defer>
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- script for modals of requests -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach((modal) => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>






</body>

</html>