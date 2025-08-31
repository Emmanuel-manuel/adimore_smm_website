<?php
require_once 'connection.php';
include('session_m.php');

if (!isset($login_session)) {
    header('Location: managerlogin.php'); 
    exit();
}

$conn = Connect();

// Handle response submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respond'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $response = $conn->real_escape_string($_POST['response']);
    $sql = "UPDATE contact SET Response='$response' WHERE Email='$email'";
    
    if ($conn->query($sql)) {
        $success = "Response submitted successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch all feedback
$sql = "SELECT * FROM contact ORDER BY Name ASC";
$result = $conn->query($sql);
$feedback_data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedback_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Feedback | SMM Panel</title>
    <link rel="stylesheet" type="text/css" href="css/managefeedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #8e44ad;
            --success-color: #00b894;
            --warning-color: #fdcb6e;
            --danger-color: #d63031;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand, .navbar-nav li a {
            color: white !important;
            font-weight: 600;
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .feedback-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .feedback-item:last-child {
            border-bottom: none;
        }
        
        .customer-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .customer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 15px;
        }
        
        .feedback-content {
            margin-bottom: 15px;
        }
        
        .subject {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .message {
            color: #6c757d;
            line-height: 1.5;
        }
        
        .response-form {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .response-textarea {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            width: 100%;
            resize: vertical;
            min-height: 100px;
        }
        
        .btn-respond {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-respond:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 92, 231, 0.3);
        }
        
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
            border: none;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .no-feedback {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .no-feedback i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .sidebar {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .sidebar .list-group-item {
            border: none;
            border-left: 4px solid transparent;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .sidebar .list-group-item:hover {
            background-color: #f8f9fa;
            border-left-color: var(--primary-color);
        }
        
        .sidebar .list-group-item.active {
            background-color: var(--primary-color);
            color: white;
            border-left-color: var(--secondary-color);
        }
        
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        
        @media (max-width: 768px) {
            .customer-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .customer-avatar {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">SMM Panel</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="#"><i class="fas fa-user"></i> Welcome <?php echo $login_session; ?></a></li>
                    <li><a href="manageservices.php">Manage Services</a></li>
                    <li class="active"><a href="manage_feedback.php">Manage Feedback</a></li>
                    <li class="fas fa-sign-out-alt"><a href="logout_m.php"> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <div class="page-header">
            <h1><i class="fas fa-comments"></i> Manage Feedback</h1>
            <p>View and respond to user feedback and inquiries</p>
        </div>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="list-group">
                        <a href="manageservices.php" class="list-group-item">Manage Services</a>
                        <a href="manage_users.php" class="list-group-item">Manage Users</a>
                        <a href="post_notifications.php" class="list-group-item">Post Notifications</a>
                        <a href="manage_feedback.php" class="list-group-item active">Manage Users Feedback</a>
                        <a href="manage_orders.php" class="list-group-item">Manage Orders</a>
                        <a href="logout_m.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <?php if (count($feedback_data) > 0): ?>
                    <?php foreach ($feedback_data as $feedback): ?>
                        <div class="card">
                            <div class="card-header">
                                Feedback from <?php echo $feedback['Name']; ?>
                                <span class="pull-right">
                                    <i class="far fa-clock"></i> 
                                    <?php 
                                        $date = new DateTime($feedback['created_at'] ?? 'now');
                                        echo $date->format('M j, Y g:i A'); 
                                    ?>
                                </span>
                            </div>
                            <div class="feedback-item">
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        <?php echo strtoupper(substr($feedback['Name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <h4><?php echo $feedback['Name']; ?></h4>
                                        <p>
                                            <i class="fas fa-envelope"></i> <?php echo $feedback['Email']; ?> | 
                                            <i class="fas fa-phone"></i> <?php echo $feedback['Mobile']; ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="feedback-content">
                                    <div class="subject">
                                        <i class="fas fa-tag"></i> <?php echo $feedback['Subject']; ?>
                                    </div>
                                    <div class="message">
                                        <?php echo nl2br(htmlspecialchars($feedback['Message'])); ?>
                                    </div>
                                </div>
                                
                                <?php if (!empty($feedback['Response'])): ?>
                                    <div class="response-display">
                                        <strong><i class="fas fa-reply"></i> Your Response:</strong>
                                        <div class="alert alert-info">
                                            <?php echo nl2br(htmlspecialchars($feedback['Response'])); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="POST" class="response-form">
                                    <input type="hidden" name="email" value="<?php echo $feedback['Email']; ?>">
                                    <div class="form-group">
                                        <label for="response-<?php echo $feedback['Email']; ?>">
                                            <i class="fas fa-edit"></i> Write your response:
                                        </label>
                                        <textarea 
                                            id="response-<?php echo $feedback['Email']; ?>" 
                                            name="response" 
                                            class="response-textarea" 
                                            placeholder="Type your response here..." 
                                            required
                                        ><?php echo isset($feedback['Response']) ? htmlspecialchars($feedback['Response']) : ''; ?></textarea>
                                    </div>
                                    <button type="submit" name="respond" class="btn-respond">
                                        <i class="fas fa-paper-plane"></i> <?php echo !empty($feedback['Response']) ? 'Update Response' : 'Send Response'; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card">
                        <div class="no-feedback">
                            <i class="far fa-comments"></i>
                            <h3>No Feedback Found</h3>
                            <p>There are no feedback messages in the system at the moment.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to top button
        $(document).ready(function(){
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });
            
            $('.back-to-top').click(function(){
                $('html, body').animate({scrollTop : 0}, 800);
                return false;
            });
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>