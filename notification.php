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
                    <!-- <div class="notification-card unread" data-status="unread">
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
                    </div> -->
                    
                    <?php
                // Fetch user email
                $username = $_SESSION['login_user2'];
                $sql_user = "SELECT email FROM customer WHERE username='$username'";
                $result_user = $conn->query($sql_user);

                if ($result_user && $result_user->num_rows > 0) {
                    $row_user = $result_user->fetch_assoc();
                    $user_email = $row_user['email'];

                    // Fetch notifications (responses) for this email
                    $sql_notifications = "SELECT id, Subject, Message, Response, Status, created_at 
                                            FROM contact 
                                            WHERE Email='$user_email' AND Response IS NOT NULL AND Response <> '' 
                                            ORDER BY created_at DESC";
                    $result_notif = $conn->query($sql_notifications);

                    if ($result_notif && $result_notif->num_rows > 0) {
                        while ($notif = $result_notif->fetch_assoc()) {
                            $status = ($notif['Status'] == 'unread') ? 'unread' : 'read';
                            echo '<div class="notification-card '.$status.'" data-id="'.$notif['id'].'" data-status="'.$status.'">
                                    <h4 class="notification-title">
                                        <i class="fas fa-envelope '.($status=='unread'?'text-danger':'text-muted').'"></i> '.$notif['Subject'].'
                                    </h4>
                                    <div class="notification-time">
                                        <i class="far fa-clock"></i> '.$notif['created_at'].'
                                    </div>
                                    <div class="notification-content">
                                        <strong>Your message:</strong> '.$notif['Message'].'<br>
                                        <strong>Admin response:</strong> '.$notif['Response'].'
                                    </div>
                                    <div class="notification-actions">';
                            if ($status == 'unread') {
                                echo '<button class="btn-mark-read">Mark as Read</button>';
                            } else {
                                echo '<button class="btn-mark-read" disabled>Marked as Read</button>';
                            }
                            echo '</div></div>';
                        }
                    } else {
                        echo "<p style='text-align:center;'>No notifications yet.</p>";
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p>
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
            $('.notification-list').on('click', '.btn-mark-read', function() {
                var card = $(this).closest('.notification-card');
                var notifId = card.data('id');

                $.post("update_notification.php", { id: notifId }, function(response) {
                    if (response === "success") {
                        card.removeClass('unread').addClass('read');
                        card.attr('data-status', 'read');
                        card.find('.btn-mark-read').text('Marked as Read').prop('disabled', true);

                        updateNotificationCount();
                    }
                });
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