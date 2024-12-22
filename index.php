<?php
session_start();
include('database/database_conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In & Sign Up Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header">
        <img src="images/instacarelogo.png" alt="Logo" class="logo">
    </header>
    <div class="cont">
        <form action="php/login_function.php" method="POST">
            <div class="form sign-in">
                <h2>Sign In</h2>
                <label>
                    <span>USERNAME</span>
                    <input type="username" name="username" required>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>
                <p class="error"><?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo $_SESSION['error_message'];
                                        unset($_SESSION['error_message']);
                                    }
                                    ?></p>

                <button class="submit">Sign In</button>
                <p class="forgot-pass">Forgot Password ?</p>
            </div>
        </form>

        <div class="sub-cont">
            <div class="img">
                <div class="img-text m-up">
                    <h2>New here?</h2>
                    <p>Sign up for a world of wellness.!</p>
                </div>
                <div class="img-text m-in">
                    <h2>Part of the family?</h2>
                    <p>Already have an account? Sign in and stay healthy!</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Sign Up</span>
                    <span class="m-in">Sign In</span>
                </div>
            </div>

            <!-- start of register code here -->
            <form action="php/register_function.php" method="POST">
                <div class="form-sign-up">
                    <h2>Sign Up</h2>
                    <div class="grid-container">
                        <label>
                            <span>Full Name</span>
                            <input type="text" name="name" required>
                        </label>
                        <label>
                            <span>ID Number</span>
                            <input type="number" name="id_number" required>
                        </label>
                        <label>
                            <span>Birthdate</span>
                            <input type="date" name="bday" required>
                        </label>
                        <label>
                            <span>Course</span>
                            <input type="text" name="course" required>
                        </label>
                        <label>
                            <span>Section</span>
                            <input type="text" name="section" required>
                        </label>
                        <label>
                            <span>Gender</span>
                            <input type="text" name="gender" required>
                        </label>


                        <label>
                            <span>Status</span>
                            <input type="text" name="status" required>
                        </label>
                        <label>
                            <span>Nationality</span>
                            <input type="text" name="nationality" required>
                        </label>
                        <label>
                            <span>Contact No.</span>
                            <input type="number" name="contact" required>
                        </label>
                        <label>
                            <span>Contact Person</span>
                            <input type="text" name="contact_person" required>
                        </label>
                        <label>
                            <span>Address</span>
                            <input type="text" name="address" required>
                        </label>
                        <label>
                            <span>Username</span>
                            <input type="text" name="username" required>
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" name="password" required>
                        </label>
                    </div>

                    <p class="error"><?php
                                        if (isset($_SESSION['error_message'])) {
                                            echo $_SESSION['error_message'];
                                            unset($_SESSION['error_message']);
                                        }
                                        ?></p>
                    <div class="terms-conditions">
                        <label>
                            <input type="checkbox">
                            <span>I agree to the <a href="#">Terms and Conditions</a></span>
                        </label>
                    </div>

                    <button class="submit">Sign Up Now</button>

                </div>
            </form>
            <!-- end of register code -->
        </div>
    </div>

    <script>
        document.querySelector('.img-btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s-signup');
        });
    </script>
</body>

</html>