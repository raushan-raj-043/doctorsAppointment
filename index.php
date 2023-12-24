<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="Styles/style.css">
</head>
<body>
    <header>
        <nav>
            <ul class="header_list">
                <li class="user_icon">DR</li>
                <li><a href="#FAQ">Help?</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="user">
            <img class = "doctor_img" src="images/doctor.png" alt="Doctor_profile_img">
            <div class="user_details">
                <h2 class="doctor_name">Dr. Manik Dalvi</h2>
                <p class="specialization">Obstetrics & Gynecology</p>
                <button class="profile_btn">Vew Profile</button>
            </div>
        </section>
        <section>
            <hr style="height:0.5px;border-width:0;color:gray;background-color:gray">
        </section>
        <section class="clinic_details">
            <div class="appointment_details">
                <h3 style="color:black; margin:0px"><b>Book Appointment</b></h3>
                <p> Select Your Consultation Type </p>
                <p style="color:green; margin:0px">Fees approx ₹ 500</p>
                <p style="color:blue; margin-top: 1rem">(pay at clinic)</p>
            </div>
            <div class="consultation_type">
                <button class="Clinic appointment_icon selected_type">
                    <img class = "icon_img" src="images/icons8-hospital-64.png" alt="">
                    <p class="mode">Clinic</p>
                </button>
                <button class="Audio appointment_icon">
                    <img class = "icon_img" src="images/icons8-call-50.png" alt="">
                    <p class="mode">Audio</p>
                </button>
                <button class="Video appointment_icon">
                    <img class = "icon_img" src="images/icons8-video-call-50.png" alt="">
                    <p class="mode">Video</p>
                </button>
            </div>
        </section>
        <section id="address">
            <h3 style="color:black; margin:0px"><b>Clinic Name</b></h3>
            <div class="address_container">
                <div class="dot_container">
                    <div class="medium">
                        <div class="small">
                        </div>
                    </div>
                </div>
                <p>Manik Dalvi's Clinic, Kalyan Naka, Rk Business Centre, Opp. Bopal Nagar, Maharashtra, 421302</p>
            </div>
        </section>
        <section>
            <div class="date-container">
                <div class="prev"></div>
                <div class="choice today date_choosen">
                    <h3 class="content">Today</h3>
                    <p id="count_availablity"></p>
                </div>
                <div class="choice tomorrow">
                    <h3 class="content">Tomorrow</h3>
                    <p id="count_availablity"></p>
                </div>
                <div class="choice dayAfterTomorrow">
                    <h3 class="content", id="day-tomorrows-date"></h3>
                    <p id="count_availablity"></p>
                </div>
                <div class="next"> </div>
            </div>
            <div class="slot-container">
                <ul id="available-slots" class="available-slots"></ul>
            </div>
        </section>
        <section class="cnt_container">
            <button class="cnt_btn">Continue</button>
        </section>
        <div id="FAQ" class="FAQ_container">
            <h2 class="FAQ_title"><b>Frequently Asked Questions</b></h2>
            <div class="accordion">
                <ul class = accordion_list>
                    <li class="accordion-item">
                        <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What are the payment options available?</span><span class="icon" aria-hidden="true"></span></button>
                        <div class="accordion-content">
                            <p>E.g, You can pay using a variety of methods such as Internet Banking, Debit/Credit card, Wallet, UPI, and so on.</p>
                        </div>
                    </li>
                    <li class="accordion-item">
                        <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Why is the sky blue?</span><span class="icon" aria-hidden="true"></span></button>
                        <div class="accordion-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut</p>
                        </div>
                    </li>
                    <li class="accordion-item">
                        <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Will we ever discover aliens?</span><span class="icon" aria-hidden="true"></span></button>
                        <div class="accordion-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut</p>
                        </div>
                    </li>
                      <li class="accordion-item">
                        <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">How much does the Earth weigh?</span><span class="icon" aria-hidden="true"></span></button>
                        <div class="accordion-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiu. Ut tortor pretium viverra suspendisse potenti.</p>
                        </div>
                    </li>
                      <li class="accordion-item">
                        <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">How do airplanes stay up?</span><span class="icon" aria-hidden="true"></span></button>
                        <div class="accordion-content">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                        </div>
                    </li>
                </ul>
            </div>
          </div>
    </main>
    <footer>
        <p>&copy; All rights reserved.</p>
    </footer>
    <script src="Scripts/main.js"></script>
    <!-- <script src="script.js"></script> -->
</body>
</html>