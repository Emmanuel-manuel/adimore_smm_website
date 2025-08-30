<?php
// Start session
session_start();

// Include database connection
include 'connection.php';
$conn = Connect();

// Check if user is logged in
if(!isset($_SESSION['login_user2'])){
    header("location: customerlogin.php");
    exit();
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
$email = $user['email'];
$contact = $user['contact'];

// Handle profile picture upload
$profilePicture = "images/profile_picture.png"; // Local default image

// Check if user has a profile picture in the database
if (!empty($user['profile_picture'])) {
    $profilePicture = 'data:image/jpeg;base64,' . base64_encode($user['profile_picture']);
}

// Handle form submission for profile picture
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }
    
    // Check file size (max 5MB)
    if ($_FILES["profile_picture"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Read the file and store it in database as BLOB
            $imageData = file_get_contents($target_file);
            $escapedImageData = mysqli_real_escape_string($conn, $imageData);
            
            $updateQuery = "UPDATE customer SET profile_picture = '$escapedImageData' WHERE username = '$username'";
            if (mysqli_query($conn, $updateQuery)) {
                echo "<script>alert('Profile picture updated successfully!'); window.location.href='profile.php';</script>";
            } else {
                echo "<script>alert('Error updating profile picture in database.');</script>";
            }
            
            // Remove the uploaded file after storing in database
            unlink($target_file);
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['current_password'])) {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    // Verify current password
    $verifyQuery = "SELECT password FROM customer WHERE username = '$username'";
    $verifyResult = mysqli_query($conn, $verifyQuery);
    $userData = mysqli_fetch_assoc($verifyResult);
    
    // In a real application, you would use password_verify() for hashed passwords
    if ($userData['password'] == $currentPassword) {
        if ($newPassword == $confirmPassword) {
            $updatePasswordQuery = "UPDATE customer SET password = '$newPassword' WHERE username = '$username'";
            if (mysqli_query($conn, $updatePasswordQuery)) {
                echo "<script>alert('Password changed successfully!');</script>";
            } else {
                echo "<script>alert('Error updating password.');</script>";
            }
        } else {
            echo "<script>alert('New passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fullname; ?> -AdimoreSMMHub Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <header>
            <div class="profile-img-container" data-bs-toggle="modal" data-bs-target="#profilePictureModal">
                <img src="<?php echo $profilePicture; ?>" alt="<?php echo $fullname; ?>" class="profile-img">
                <div class="profile-img-overlay">
                    <i class="fas fa-camera fa-2x text-white"></i>
                </div>
            </div>
            <div class="profile-info">
                <h1><?php echo $fullname; ?></h1>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span><?php echo !empty($contact) ? $contact : 'No phone number provided'; ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span><?php echo !empty($email) ? $email : 'No email provided'; ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-user"></i>
                        <span><?php echo $username; ?></span>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="section">
            <div class="toggle-container">
                <div class="section-title">
                    <i class="fas fa-moon"></i>
                    <span>Dark Mode</span>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="darkModeToggle">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">
                <i class="fas fa-key"></i>
                <span>Change Password</span>
            </div>
            <p>Keep your account secure by updating your password regularly.</p>
            <button type="button" class="change-password-btn" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                <i class="fas fa-edit"></i> Change Password
            </button>
        </div>
        
        <div class="section">
            <div class="section-title">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            <div class="settings-option">
                <span>Language</span>
                <span>English</span>
            </div>
            <div class="settings-option">
                <span>Notifications</span>
                <span>Enabled</span>
            </div>
            <div class="settings-option">
                <span>Privacy</span>
                <span>Private</span>
            </div>
        </div>
        
        <a href="logout_u.php" class="logout-btn">
            <i class="fas fa-lock"></i> Log Out
        </a>
    </div>

    <!-- Profile Picture Modal -->
    <div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilePictureModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profilePicture" class="form-label">Select a new profile picture</label>
                            <input class="form-control" type="file" id="profilePicture" name="profile_picture" accept="image/*" required>
                            <div class="form-text">Max file size: 5MB. Supported formats: JPG, PNG, GIF.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload Picture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark mode functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;
        
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            darkModeToggle.checked = true;
        }
        
        // Toggle dark mode
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', null);
            }
        });
        
        // Form validation for change password
        const changePasswordForm = document.querySelector('#changePasswordModal form');
        if (changePasswordForm) {
            changePasswordForm.addEventListener('submit', function(e) {
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('New passwords do not match!');
                }
            });
        }
    </script>
</body>
</html>