<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | SMM Panel</title>
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
        .about-content {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .branch-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
        }
        .branch-title {
            color: #4a89dc;
            font-weight: 600;
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
        .feature-list {
            list-style-type: none;
            padding-left: 0;
        }
        .feature-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .feature-list li:before {
            content: "✔ ";
            color: #4a89dc;
            font-weight: bold;
        }
        .icon-heading {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .icon-heading:before {
            margin-right: 10px;
            font-size: 28px;
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
                    <li class="active"><a href="aboutus.php">About</a></li>
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
        <div class="tagline">It's not our <font color="red"><strong>work life</strong></font>, it's our <font color="green"><strong><em>life's work</em>.</strong></font></div>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <!-- About Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="about-content">
                    <h2 class="section-title">About AdimoreHub</h2>
                    <p>Welcome to AdimoreHub.com, the Best and Cheapest SMM Panel in Africa, trusted by thousands for Instagram followers, TikTok views, YouTube growth, Facebook engagement, Telegram members, and more.</p>
                    
                    <p>We are a New Generation SMM Panel built to empower African creators, influencers, brands, and businesses with affordable, reliable, and fast social media marketing solutions.</p>
                    
                    <p>Since our launch, we have grown to become one of the most trusted SMM panels in Kenya and across Africa, helping thousands of clients boost their visibility, engagement, and authority online.</p>
                </div>
            </div>
        </div>

        <!-- Who We Are Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="about-content">
                    <h3 class="icon-heading">🌍 Who We Are</h3>
                    <p>At AdimoreHub.com, we are more than just an SMM panel. We are a partner committed to helping you grow authentically and effectively.</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li>💎 Cheapest Prices in Africa</li>
                                <li>⚡ Fast Delivery</li>
                                <li>🔒 Real & Targeted Services</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li>🎧 24/7 Support – Always-on customer service for quick solutions.</li>
                                <li>💳 Secure Payments – Local options like M-Pesa and Mobile Money.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- What We Offer Section -->
        <h2 class="section-title">🚀 What We Offer</h2>
        
        <div class="row">
            <div class="col-md-12">
                <div class="about-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li>High-quality Instagram followers, likes, and views</li>
                                <li>Fast TikTok followers, likes, and video views</li>
                                <li>Real YouTube subscribers, watch time, and comments</li>
                                <li>Facebook page likes, post engagement, and shares</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li>Telegram members, channel views, and engagement</li>
                                <li>Twitter (X), Threads, Snapchat, LinkedIn, Shazam, and more</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <h2 class="section-title">💡 Why Choose AdimoreHub?</h2>
        
        <div class="row">
            <div class="col-md-12">
                <div class="about-content">
                    <p>Affordable SMM services tailored for African creators and businesses.</p>
                    <p>Secure M-Pesa & mobile money payments for convenience.</p>
                    <p>Instant delivery speeds to keep you ahead of the competition.</p>
                    <p>Services that comply with platform policies for safe, sustainable growth.</p>
                    
                    <p>Whether you're a budding influencer, a startup, or a global brand, AdimoreHub gives you the tools to grow smarter, faster, and stronger online.</p>
                    
                    <p class="text-center" style="font-weight: bold; font-size: 18px; margin-top: 20px;">
                        👉 AdimoreHub – The Best & Cheapest SMM Panel in Africa. Trusted. Affordable. Reliable.
                    </p>
                </div>
            </div>
        </div>

        <!-- Global Presence Section -->
        <h2 class="section-title">Trusted by Users Worldwide</h2>
        
        <div class="row">
            <!-- <div class="col-md-4">
                <div class="branch-box">
                    <h3 class="branch-title">SMM Panel Nigeria</h3>
                    <p>Popular among creators and marketers, our Nigerian panel delivers real results for Instagram, TikTok, and YouTube.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="branch-box">
                    <h3 class="branch-title">SMM Panel USA</h3>
                    <p>Servicing the American market with premium social media growth services for all major platforms.</p>
                </div>
            </div> -->
            <div class="col-md-4">
                <div class="branch-box">
                    <h3 class="branch-title">TikTok, Instagram, YouTube and Facebook Likes & Views</h3>
                    <p>Specialized service for Social Media growth, helping content creators boost their presence on the fastest-growing platform.</p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <h2 class="section-title">Premium Features Built for Success</h2>
        
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="about-content">
                    <h3>Free Child Panel</h3>
                    <p>Spend over $2,500 and unlock your own branded panel — ready to serve your clients under your name.</p>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="about-content">
                    <h3>Market-Beating Prices</h3>
                    <p>Access world-class social media growth tools at unbeatable rates. High quality. Low cost. No compromise.</p>
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
                        <li><a href="terms.php">Terms & Conditions</a></li>
                        <li><a href="terms.php#privacy">Privacy Policy</a></li>
                        <li><a href="terms.php#refund">Refund Policy</a></li>
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
    </script>
</body>
</html>