<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMM Panel - Social Media Marketing Services</title>
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
            padding: 80px 0 60px;
            background: linear-gradient(135deg, #4a89dc 0%, #6cbbf2 100%);
            color: white;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 180px;
            margin: 20px 0;
            width: 100%;
            height: auto;
        }
        .tagline {
            font-size: 24px;
            margin: 20px 0;
            font-weight: 300;
        }
        .section-title {
            text-align: center;
            margin: 40px 0 30px;
            color: #4a89dc;
            font-weight: 700;
        }
        .feature-box {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            height: 100%;
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 40px;
            color: #4a89dc;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #4a89dc;
            border-color: #4a89dc;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #3a79cc;
            border-color: #3a79cc;
        }
        .stats-box {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .stats-number {
            font-size: 36px;
            font-weight: 700;
            color: #4a89dc;
            margin: 10px 0;
        }
        .stats-label {
            font-size: 16px;
            color: #666;
        }
        .testimonial {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .testimonial-text {
            font-style: italic;
            margin-bottom: 15px;
        }
        .testimonial-author {
            font-weight: 600;
            color: #4a89dc;
        }
        .payment-method {
            display: inline-block;
            margin: 5px 10px;
            font-size: 24px;
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
        .service-list {
            list-style-type: none;
            padding-left: 0;
        }
        .service-list li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .service-list li:before {
            content: "✓ ";
            color: #4a89dc;
            font-weight: bold;
        }
        .orderblock {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin: 30px 0;
            text-align: center;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .wide {
                padding: 100px 0 40px;
            }
            .logo img {
                max-width: 150px;
            }
            .tagline {
                font-size: 20px;
            }
            .section-title {
                font-size: 24px;
            }
            .feature-box {
                padding: 20px;
            }
            .stats-number {
                font-size: 28px;
            }
            .line {
                display: none;
            }
            .navbar-collapse {
                border-top: 1px solid transparent;
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            }
            .navbar-fixed-top {
                position: fixed;
                top: 0;
            }
        }
        
        @media (max-width: 480px) {
            .tagline {
                font-size: 18px;
            }
            .wide p {
                font-size: 14px;
            }
            .feature-icon {
                font-size: 30px;
            }
            .stats-box {
                padding: 15px;
            }
            .orderblock {
                padding: 20px;
            }
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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="customersignup.php">User Sign-up</a></li>
                            <!-- <li><a href="managersignup.php">Admin Sign-up</a></li> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
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
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo"><img src="images/adimoresmm_logo.png" alt="ADIMORE SMM Logo"></div>
                    <div class="tagline">Africa's Premier SMM Panel</div>
                    <p>Trusted by 42K+ Users and influencers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <!-- Rapid-Fire Delivery Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="feature-box">
                    <h2>Rapid-Fire Delivery</h2>
                    <p>Orders fly out fast — no lag, no drag. Our optimized engine makes sure your deliveries are quick, accurate, and constantly monitored for perfection.</p>
                    <div class="orderblock">
                        <h2>Ready to Get Started?</h2>
                        <center><a class="btn btn-primary btn-lg" href="customerlogin.php" role="button">Order Now</a></center>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <h2 class="section-title">Why Choose ADIMORE-SMM?</h2>
        
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-flash"></span></div>
                    <h3>Stability Unleashed</h3>
                    <p>Our infrastructure runs 24/7 with advanced tech to ensure uninterrupted service. Day or night, expect stability that won't flinch.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-headphones"></span></div>
                    <h3>Always-On Support</h3>
                    <p>Every question deserves an answer — fast. Our 24/7 support team responds with empathy and clarity, keeping your experience smooth.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-dashboard"></span></div>
                    <h3>Intuitive Experience</h3>
                    <p>Navigate with confidence. Our interface is built for flow — sleek, flexible, and seriously satisfying.</p>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <h2 class="section-title">Our Best Selling SMM Services</h2>
        
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="feature-box">
                    <h3>Popular Services Include:</h3>
                    <ul class="service-list">
                        <li>Instagram Followers & Likes</li>
                        <li>TikTok Followers & Views</li>
                        <li>YouTube Subscribers & Watch Hours</li>
                        <li>Facebook Followers & Reels Views</li>
                        <li>Twitter Followers & Retweets</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="feature-box">
                    <h3>Cheapest SMM Panel for Resellers</h3>
                    <p>ADIMORE-SMM is your plug for low-cost, high-quality SMM services — crafted especially for resellers ready to scale and dominate.</p>
                    <p>We offer fast delivery across all major platforms. Manage bulk orders, get instant refills, and automate with ease.</p>
                    <p>Track orders in real-time, switch between services seamlessly, and enjoy 24/7 customer support that actually responds.</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <h2 class="section-title">Trusted Worldwide for Social Media Growth</h2>
        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="stats-box">
                    <div class="stats-number">$0.8</div>
                    <div class="stats-label">Price Starting</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="stats-box">
                    <div class="stats-number">24/7</div>
                    <div class="stats-label">Fastest Support</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="stats-box">
                    <div class="stats-number">42K+</div>
                    <div class="stats-label">Registered Users</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="stats-box">
                    <div class="stats-number">100%</div>
                    <div class="stats-label">Satisfaction</div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <h2 class="section-title">How to Get Started with ADIMORE-SMM</h2>
        
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-user"></span></div>
                    <h3>Sign Up</h3>
                    <p>Create your free account in seconds and unlock your dashboard.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-credit-card"></span></div>
                    <h3>Add Funds</h3>
                    <p>Top up using M-Pesa, Cards, or any local gateway you prefer.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <div class="feature-icon"><span class="glyphicon glyphicon-stats"></span></div>
                    <h3>Track & Grow</h3>
                    <p>Monitor real-time results and scale your growth like a pro.</p>
                </div>
            </div>
        </div>

        <!-- Payment Methods Section -->
        <h2 class="section-title">Our Payment Methods</h2>
        
        <div class="row">
            <div class="col-md-12">
                <div class="feature-box text-center">
                    <p>We support a wide range of secure and instant payment gateways so you can top up with ease:</p>
                    <div>
                        <span class="payment-method">VISA</span>
                        <span class="payment-method">M-Pesa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h4>QUICK ACCESS</h4>
                    <ul class="list-unstyled">
                        <li><a href="customersignup.php">Register</a></li>
                        <li><a href="customerlogin.php">Log In</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="aboutus.php">Our Story</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h4>LEGAL</h4>
                    <ul class="list-unstyled">
                        <li><a href="terms.php">Terms & Conditions</a></li>
                        <li><a href="terms.php#privacy">Privacy Policy</a></li>
                        <li><a href="terms.php#refund">Refund Policy</a></li>
                        <li><a href="contactus.php">Need Help?</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="text-center">Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
            <p class="text-center">Developed by <a href="mailto:emmanuelsystems5@gmail.com">emmanuelSystems</a></p>
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
    </script>
</body>
</html>