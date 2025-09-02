<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | SMM Panel</title>
    <link rel="stylesheet" href="css/userdashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .navbar-brand {
            font-weight: bold;
            color: #4a89dc !important;
        }
        .wide {
            text-align: center;
            padding: 60px 0;
            background: linear-gradient(135deg, #4a89dc 0%, #6cbbf2 100%);
            color: white;
            margin-bottom: 30px;
        }
        .tagline {
            font-size: 28px;
            margin: 20px 0;
            font-weight: 300;
        }
        .section-title {
            text-align: center;
            margin: 40px 0 30px;
            color: #4a89dc;
            font-weight: 700;
        }
        .faq-content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .panel-title {
            font-weight: 600;
        }
        .panel-heading {
            background-color: #f8f9fa !important;
        }
        .panel-body {
            border-top: 1px solid #eee !important;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #4a89dc;
            color: white;
            cursor: pointer;
            padding: 12px 15px;
            border-radius: 50%;
            font-size: 18px;
        }
        #myBtn:hover {
            background-color: #3a79cc;
        }
        .faq-item {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .faq-question {
            background-color: #f8f9fa;
            padding: 15px;
            cursor: pointer;
            font-weight: 600;
            position: relative;
        }
        .faq-answer {
            padding: 15px;
            border-top: 1px solid #ddd;
            display: none;
        }
        .faq-question:after {
            content: '+';
            position: absolute;
            right: 15px;
            font-weight: bold;
        }
        .faq-question.active:after {
            content: '-';
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ADIMORE-SMM</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li class="active"><a href="faq.php">FAQ</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="customersignup.php">User Sign-up</a></li>
                            <!-- <li><a href="managersignup.php">Admin Sign-up</a></li> -->
                        </ul>
                    </li>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="customerlogin.php">User Login</a></li>
                            <li><a href="managerlogin.php">Admin Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="wide">
        <div class="tagline">Frequently Asked Questions</div>
        <p>Find answers to common questions about our SMM services</p>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <!-- FAQ Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="faq-content">
                    <h2 class="section-title">Common Questions</h2>
                    
                    <div class="faq-item">
                        <div class="faq-question">What is AdimoreHub SMM?</div>
                        <div class="faq-answer">
                            <p>AdimoreHub SMM is an all-in-one Social Media Marketing platform. We help grow your social media accounts quickly and efficiently with our range of services.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Is AdimoreHub safe to use?</div>
                        <div class="faq-answer">
                            <p>Yes, AdimoreHub is completely safe to use. We prioritize the security of our clients and use secure payment methods to ensure your transactions are protected.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">How do I register an account?</div>
                        <div class="faq-answer">
                            <p>Registering an account is simple:</p>
                            <ol>
                                <li>Click on the "Sign Up" button in the top right corner</li>
                                <li>Select "User Sign-up"</li>
                                <li>Fill in your details including username, email, and password</li>
                                <li>Verify your email address</li>
                                <li>Log in to your new account</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">How can AdimoreHub help me make money?</div>
                        <div class="faq-answer">
                            <p>AdimoreHub offers a referral program that allows you to earn money by inviting others to join our platform. For every 10 people you invite who create an account, you earn Ksh.100.</p>
                            <p>Additionally, as a reseller, you can purchase our services at wholesale prices and sell them to your clients at a markup, generating profit for your business.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">What payment methods do you accept?</div>
                        <div class="faq-answer">
                            <p>We accept a wide range of payment methods including:</p>
                            <ul>
                                <li>M-Pesa</li>
                                <li>PayPal</li>
                                <li>Crypto currencies</li>
                                <li>Credit/Debit Cards</li>
                                <li>Payoneer</li>
                                <li>Skrill</li>
                                <li>And other local payment options</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">How fast are your delivery times?</div>
                        <div class="faq-answer">
                            <p>Our delivery times vary by service but we pride ourselves on rapid delivery. Most services start within minutes of ordering, with some beginning instantly. We process an order every 0.14 seconds on average.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Do you offer refunds?</div>
                        <div class="faq-answer">
                            <p>We have a refund policy in place for orders that don't meet our quality standards or fail to deliver as promised. Please check our Terms of Service for detailed information about our refund policy.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">What social media platforms do you support?</div>
                        <div class="faq-answer">
                            <p>We support all major social media platforms including:</p>
                            <ul>
                                <li>Instagram (followers, likes, views)</li>
                                <li>TikTok (followers, likes, views)</li>
                                <li>YouTube (subscribers, views, comments)</li>
                                <li>Facebook (likes, followers, shares)</li>
                                <li>Twitter (followers, retweets, likes)</li>
                                <li>Telegram (members, views)</li>
                                <li>And many more</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Do you offer services for businesses?</div>
                        <div class="faq-answer">
                            <p>Yes, we offer specialized services for businesses including:</p>
                            <ul>
                                <li>Customized growth packages</li>
                                <li>White-label solutions for agencies</li>
                                <li>Bulk ordering discounts</li>
                                <li>API access for automated orders</li>
                                <li>Dedicated account management for large clients</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">How can I contact customer support?</div>
                        <div class="faq-answer">
                            <p>We offer 24/7 customer support through multiple channels:</p>
                            <ul>
                                <li>Live chat on our website</li>
                                <li>Email support at support@adimorehub.com</li>
                                <li>WhatsApp messaging</li>
                                <li>Phone support during business hours</li>
                            </ul>
                            <p>Our average response time is under 5 minutes for most inquiries.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Help Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="faq-content text-center">
                    <h3>Still have questions?</h3>
                    <p>If you didn't find the answer you were looking for, our support team is always ready to help.</p>
                    <a href="contactus.php" class="btn btn-primary">Contact Support</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>QUICK ACCESS</h4>
                    <ul class="list-unstyled">
                        <li><a href="customersignup.php">Register</a></li>
                        <li><a href="customerlogin.php">Log In</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="aboutus.php">Our Story</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>LEGAL</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Refund</a></li>
                        <li><a href="contactus.php">Need Help?</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="text-center">Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </button>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script>
        // Back to top button
        window.onscroll = function() { scrollFunction() };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        
        // FAQ accordion functionality
        $(document).ready(function() {
            $('.faq-question').click(function() {
                // Toggle active class
                $(this).toggleClass('active');
                // Toggle answer visibility
                $(this).next('.faq-answer').slideToggle(200);
                
                // Close other open answers
                $('.faq-question').not(this).removeClass('active');
                $('.faq-answer').not($(this).next('.faq-answer')).slideUp(200);
            });
        });
    </script>
</body>
</html>