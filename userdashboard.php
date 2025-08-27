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


// Fetch wallet balance
$walletQuery = "SELECT balance FROM wallet WHERE fullname = '$fullname' LIMIT 1";
$walletResult = mysqli_query($conn, $walletQuery);
if ($walletResult && mysqli_num_rows($walletResult) > 0) {
    $wallet = mysqli_fetch_assoc($walletResult);
    $walletBalance = $wallet['balance'];
} else {
    $walletBalance = 0; // Default balance if no wallet record
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | SMM Panel</title>
    <link rel="stylesheet" type = "text/css" href ="css/userdashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    

</head>
<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="navbar-brand">SMM PANEL</h1>
                  
                </div>
                
                <div class="col-md-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> <?php echo $username; ?>
                        </button>
                        <ul class="nav navbar-nav navbar-right">
                <li class="active" ><a href="notification.php"><span class="glyphicon glyphicon-shopping-cart"></span> Notification
            (<?php
              if(isset($_SESSION["notification"])){
              $count = count($_SESSION["notification"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
             </ul>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout_u.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-plus-circle"></i>
                                New Order
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-concierge-bell"></i>
                                Services
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-cart"></i>
                                Orders
                            </a>
                        </li>
                        
                        <li class="nav-item"> 
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                                <i class="fas fa-credit-card"></i>
                                Recharge Wallet
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contactus.php">
                                <i class="fas fa-headset"></i>
                                Support
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user-circle"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="logout_u.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto main-content">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Dashboard</h2>
                    </div>
                </div>

                <!-- Welcome and Balance Section -->
                <div class="row mb-4">
                    <div class="col-md-8 mb-3">
                        <div class="welcome-card p-4">
                            <h3>Welcome, <?php echo $fullname; ?></h3>
                            <p class="mb-0">Track and manage your social media orders efficiently</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="balance-card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-0">Current balance</p>
                                    <!-- Show real wallet balance -->
                                    <h2 class="mt-0">Ksh. <?php echo number_format($walletBalance, 2); ?></h2>
                                </div>
                                <div>
                                    <!-- <a href="onlinepay.php" class="btn btn-green"> -->
                                    <a href="#" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                                        
                                        <i class="fas fa-plus me-1"></i> Add Funds
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                            <div class="stat-number">15</div>
                            <p>Total Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-sync-alt fa-2x text-warning"></i>
                            <div class="stat-number">8</div>
                            <p>Active Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                            <div class="stat-number">7</div>
                            <p>Completed Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="announcement-card p-4">
                            <h5><i class="fas fa-bullhorn me-2"></i> Announcements</h5>
                            <div class="mt-3">
                                <h6>New Feature</h6>
                                <p class="text-muted">We have added a new feature. Check it out now!</p>
                                <button class="btn btn-sm btn-green">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="orders-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4>Recent Orders</h4>
                                <button class="btn btn-green"><i class="fas fa-plus me-1"></i> New Order</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Service</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12567</td>
                                                <td>2022-10-01</td>
                                                <td>Instagram Followers</td>
                                                <td>100</td>
                                                <td>Ksh. 325.00</td>
                                                <td class="status-completed">Completed</td>
                                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                                            </tr>
                                            <tr>
                                                <td>#12566</td>
                                                <td>2022-10-01</td>
                                                <td>YouTube Views</td>
                                                <td>200</td>
                                                <td>Ksh. 450.00</td>
                                                <td class="status-processing">Processing</td>
                                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                                            </tr>
                                            <tr>
                                                <td>#12565</td>
                                                <td>2022-10-01</td>
                                                <td>TikTok Likes</td>
                                                <td>150</td>
                                                <td>Ksh. 262.50</td>
                                                <td class="status-cancelled">Cancelled</td>
                                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>






















     <!-- Services Section -->
     <div class="row mt-5" id="services">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Our Services</h2>
                            <p class="text-muted mb-0">Get real followers, likes, and views for your social media accounts</p>
                        </div>
                    </div>

                    <!-- TikTok Service -->
                    <div class="col-md-4 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fab fa-tiktok service-icon tiktok-color"></i>
                                <h4 class="card-title">TikTok</h4>
                                <p class="card-text">Get high-quality TikTok followers, likes, and views to boost your presence.</p>
                                <div class="pricing-box">
                                    <h5>Ksh. 1.75 <small class="text-muted">per follower</small></h5>
                                    <button class="btn btn-green mt-2" onclick="selectService('TikTok', 1.75)">
                                        Order Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instagram Service -->
                    <div class="col-md-4 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fab fa-instagram service-icon instagram-color"></i>
                                <h4 class="card-title">Instagram</h4>
                                <p class="card-text">Increase your Instagram followers, likes, and comments with our premium service.</p>
                                <div class="pricing-box">
                                    <h5>Ksh. 3.25 <small class="text-muted">per follower</small></h5>
                                    <button class="btn btn-green mt-2" onclick="selectService('Instagram', 3.25)">
                                        Order Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- YouTube Service -->
                    <div class="col-md-4 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fab fa-youtube service-icon youtube-color"></i>
                                <h4 class="card-title">YouTube</h4>
                                <p class="card-text">Grow your YouTube channel with subscribers, views, and likes.</p>
                                <div class="pricing-box">
                                    <h5>Ksh. 2.25 <small class="text-muted">per subscriber</small></h5>
                                    <button class="btn btn-green mt-2" onclick="selectService('YouTube', 2.25)">
                                        Order Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- New Order Modal -->
    <div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newOrderModalLabel">Place New Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm">
                        <div class="mb-3">
                            <label for="service" class="form-label">Select Service</label>
                            <select class="form-select" id="service" onchange="calculateTotal()" required>
                                <option value="">-- Select Service --</option>
                                <option value="TikTok" data-price="1.75">TikTok - Ksh. 1.75 per follower</option>
                                <option value="Instagram" data-price="3.25">Instagram - Ksh. 3.25 per follower</option>
                                <option value="YouTube" data-price="2.25">YouTube - Ksh. 2.25 per subscriber</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" min="100" max="10000" oninput="calculateTotal()" required>
                            <div class="form-text">Minimum order: 100, Maximum order: 10,000</div>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Profile Link</label>
                            <input type="url" class="form-control" id="link" placeholder="https://..." required>
                        </div>
                        <div class="p-3 bg-light rounded">
                            <div class="d-flex justify-content-between">
                                <span>Total Amount:</span>
                                <strong id="totalAmount">Ksh. 0.00</strong>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <span>Wallet Balance:</span>
                                <strong>Ksh. <span id="walletBalanceModal">100.00</span></strong>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span>Remaining Balance:</span>
                                <strong id="remainingBalance">Ksh. 100.00</strong>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-green" onclick="placeOrder()">Place Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Insufficient Funds Modal -->
    <div class="modal fade" id="insufficientFundsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Insufficient Funds</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You don't have enough funds in your wallet to complete this order.</p>
                    <p>Please recharge your wallet to continue.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-green" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#rechargeModal">Recharge Wallet</button>
                </div>
            </div>
        </div>
    </div>




<!-- Recharge Wallet Modal -->
<div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rechargeModalLabel">Recharge Wallet</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--  Modified: added action + method -->
                <form id="rechargeForm" action="process_payment.php" method="POST">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount (Ksh.)</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="method" id="mpesa" value="mpesa" checked>
                            <label class="form-check-label" for="mpesa">
                                <i class="fas fa-mobile-alt me-1"></i> M-Pesa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="method" id="card" value="card">
                            <label class="form-check-label" for="card">
                                <i class="fas fa-credit-card me-1"></i> Credit/Debit Card
                            </label>
                        </div>
                    </div>

                    <!-- M-Pesa Details -->
                    <div id="mpesaDetails">
                        <div class="mb-3">
                            <label for="phone" class="form-label">M-Pesa Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="mobileNumber" placeholder="e.g., 07XX XXX XXX">
                        </div>
                    </div>

                    <!-- Card Details -->
                    <div id="cardDetails" class="d-none">
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="0000 0000 0000 0000">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cardExpiryMonth" class="form-label">Expiry Month</label>
                                <input type="text" class="form-control" id="cardExpiryMonth" name="cardExpiryMonth" placeholder="MM">
                            </div>
                            <div class="col-md-4">
                                <label for="cardExpiryYear" class="form-label">Expiry Year</label>
                                <input type="text" class="form-control" id="cardExpiryYear" name="cardExpiryYear" placeholder="YY">
                            </div>
                            <div class="col-md-4">
                                <label for="ccv" class="form-label">CCV</label>
                                <input type="text" class="form-control" id="ccv" name="ccv" placeholder="123">
                            </div>
                        </div>
                        <div class="mb-3 mt-2">
                            <label for="cardName" class="form-label">Name on Card</label>
                            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="John Doe">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- 🔹 Modified: submit the form -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="rechargeForm" class="btn btn-green">Proceed to Pay</button>
            </div>
        </div>
    </div>
</div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle M-Pesa vs Card inputs
        document.querySelectorAll('input[name="method"]').forEach((elem) => {
            elem.addEventListener('change', function() {
                if (this.value === 'mpesa') {
                    document.getElementById('mpesaDetails').classList.remove('d-none');
                    document.getElementById('cardDetails').classList.add('d-none');
                } else {
                    document.getElementById('mpesaDetails').classList.add('d-none');
                    document.getElementById('cardDetails').classList.remove('d-none');
                }
            });
        });
    </script>
</body>
</html>