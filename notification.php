<?php
// Start session
session_start();

// Include database connection
include 'connection.php';
$conn = Connect();
// Check if user is logged in
if(!isset($_SESSION['login_user2'])){
    header("location: customerlogin.php");
    
}
// Get username from session
$username = $_SESSION['login_user2'];
    
// Fetch user details from database
$query = "SELECT * FROM customer WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('User not found!'); window.location.href='customerlogin.php';</script>";
    exit();
}

$user = mysqli_fetch_assoc($result);
$fullname = $user['fullname'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - SMM Panel</title>
    <link rel="stylesheet" type = "text/css" href ="css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</head>


<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SMM Panel</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
                    <li><a href="userdashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard </a></li>
                    <li>
                        <a href="notification.php">
                            <span class="notification-icon">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge"></span>
                            </span>
                            Notifications
                        </a>
                        (<?php
              if(isset($_SESSION["notification"])){
              $count = count($_SESSION["notification"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
                    </li>
                    <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Notifications</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="filter-buttons">
                            <button class="btn btn-primary btn-filter active" data-filter="all">All</button>
                            <button class="btn btn-default btn-filter" data-filter="unread">Unread</button>
                            <button class="btn btn-default btn-filter" data-filter="read">Read</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-success mark-all-read">
                            <i class="fas fa-check-double"></i> Mark All as Read
                        </button>
                    </div>
                </div>
                
                <div class="notification-list">
                    <!-- Unread Notification -->
                    <div class="notification-card unread" data-status="unread">
                        <h4 class="notification-title">
                            <i class="fas fa-bullhorn text-danger"></i> Server Maintenance Scheduled
                            <span class="label label-danger pull-right">Important</span>
                        </h4>
                        <div class="notification-time">
                            <i class="far fa-clock"></i> Today, 10:30 AM
                        </div>
                        <div class="notification-content">
                            We will be performing scheduled maintenance on our servers this Sunday from 2:00 AM to 4:00 AM EST. During this time, the SMM panel may be temporarily unavailable.
                        </div>
                        <div class="notification-actions">
                            <button class="btn-mark-read">Mark as Read</button>
                        </div>
                    </div>
                    
                    <!-- Unread Notification -->
                    <div class="notification-card unread" data-status="unread">
                        <h4 class="notification-title">
                            <i class="fas fa-gift text-success"></i> Special Offer - 20% Bonus
                            <span class="label label-success pull-right">Promotion</span>
                        </h4>
                        <div class="notification-time">
                            <i class="far fa-clock"></i> Yesterday, 3:45 PM
                        </div>
                        <div class="notification-content">
                            Enjoy a 20% bonus on all deposits made this week! Use promo code BONUS20 during checkout to claim your extra credits. This offer is valid until Friday.
                        </div>
                        <div class="notification-actions">
                            <button class="btn-mark-read">Mark as Read</button>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-card" data-status="read">
                        <h4 class="notification-title">
                            <i class="fas fa-info-circle text-info"></i> New Services Added
                            <span class="label label-info pull-right">Update</span>
                        </h4>
                        <div class="notification-time">
                            <i class="far fa-clock"></i> 2 days ago
                        </div>
                        <div class="notification-content">
                            We've added 10 new social media services to our panel, including TikTok views, Instagram story views, and YouTube comments. Check them out in the services section!
                        </div>
                        <div class="notification-actions">
                            <button class="btn-mark-read" disabled>Marked as Read</button>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-card" data-status="read">
                        <h4 class="notification-title">
                            <i class="fas fa-exclamation-triangle text-warning"></i> Payment Issue Resolved
                            <span class="label label-warning pull-right">Alert</span>
                        </h4>
                        <div class="notification-time">
                            <i class="far fa-clock"></i> 4 days ago
                        </div>
                        <div class="notification-content">
                            The issue with PayPal payments has been resolved. All payment methods are now working correctly. We apologize for any inconvenience caused.
                        </div>
                        <div class="notification-actions">
                            <button class="btn-mark-read" disabled>Marked as Read</button>
                        </div>
                    </div>
                    
                    <!-- Read Notification -->
                    <div class="notification-card" data-status="read">
                        <h4 class="notification-title">
                            <i class="fas fa-trophy text-primary"></i> Your Order Has Been Completed
                        </h4>
                        <div class="notification-time">
                            <i class="far fa-clock"></i> 1 week ago
                        </div>
                        <div class="notification-content">
                            Your order #ORD-28742 for Instagram followers has been successfully completed. Thank you for your business!
                        </div>
                        <div class="notification-actions">
                            <button class="btn-mark-read" disabled>Marked as Read</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>Copyright 2023 &copy; SMM Panel. All rights reserved.</p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Filter notifications
            $('.btn-filter').click(function() {
                $('.btn-filter').removeClass('btn-primary').addClass('btn-default');
                $(this).removeClass('btn-default').addClass('btn-primary');
                
                var filter = $(this).data('filter');
                
                if (filter === 'all') {
                    $('.notification-card').show();
                } else {
                    $('.notification-card').hide();
                    $('.notification-card[data-status="' + filter + '"]').show();
                }
            });
            
            // Mark as read functionality
            $('.btn-mark-read').click(function() {
                var card = $(this).closest('.notification-card');
                card.removeClass('unread');
                card.attr('data-status', 'read');
                $(this).text('Marked as Read').prop('disabled', true);
                
                // Update notification badge count
                updateNotificationCount();
            });
            
            // Mark all as read
            $('.mark-all-read').click(function() {
                $('.notification-card.unread').each(function() {
                    $(this).removeClass('unread');
                    $(this).attr('data-status', 'read');
                    $(this).find('.btn-mark-read').text('Marked as Read').prop('disabled', true);
                });
                
                // Update notification badge count
                updateNotificationCount();
            });
            
            // Function to update notification badge
            function updateNotificationCount() {
                var unreadCount = $('.notification-card.unread').length;
                $('.notification-badge').text(unreadCount);
                
                if (unreadCount === 0) {
                    $('.notification-badge').hide();
                } else {
                    $('.notification-badge').show();
                }
            }
        });
    </script>
</body>
</html>