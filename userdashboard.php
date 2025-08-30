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
$userId = $user['id']; //This defines the $userId variable before it's used in the stats queries

// Fetch wallet balance
$walletQuery = "SELECT balance FROM wallet WHERE fullname = '$fullname' LIMIT 1";
$walletResult = mysqli_query($conn, $walletQuery);
if ($walletResult && mysqli_num_rows($walletResult) > 0) {
    $wallet = mysqli_fetch_assoc($walletResult);
    $walletBalance = $wallet['balance'];
} else {
    $walletBalance = 0; // Default balance
}


// Stats Queries
$totalOrdersQuery = "SELECT COUNT(*) AS total FROM orders WHERE user_id = '$userId'";
$totalOrders = mysqli_fetch_assoc(mysqli_query($conn, $totalOrdersQuery))['total'];

$activeOrdersQuery = "SELECT COUNT(*) AS total FROM orders WHERE user_id = '$userId' AND status = 'Processing'";
$activeOrders = mysqli_fetch_assoc(mysqli_query($conn, $activeOrdersQuery))['total'];

$completedOrdersQuery = "SELECT COUNT(*) AS total FROM orders WHERE user_id = '$userId' AND status = 'Completed'";
$completedOrders = mysqli_fetch_assoc(mysqli_query($conn, $completedOrdersQuery))['total'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard | SMM Panel</title>
  <link rel="stylesheet" href="css/userdashboard.css">
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
        <div class="dropdown d-inline-block me-3">
          <a href="notification.php" class="btn btn-outline-primary position-relative">
            <i class="fas fa-bell"></i> Notifications
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php
              $sql_user = "SELECT email FROM customer WHERE username='$username'";
              $result_user = $conn->query($sql_user);
              if ($result_user && $result_user->num_rows > 0) {
                  $row_user = $result_user->fetch_assoc();
                  $user_email = $row_user['email'];
                  $sql_count = "SELECT COUNT(*) AS total FROM contact 
                                WHERE Email='$user_email' AND Response IS NOT NULL AND Response <> ''";
                  $result_count = $conn->query($sql_count);
                  $row_count = $result_count->fetch_assoc();
                  echo $row_count['total'];
              } else {
                  echo "0";
              }
              ?>
            </span>
          </a>
        </div>
        <div class="dropdown d-inline-block">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i> <?php echo $username; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
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
          <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#newOrderModal"><i class="fas fa-plus-circle"></i> New Order</a></li>
          <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#viewOrderModal"><i class="fas fa-shopping-cart"></i> Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#rechargeModal"><i class="fas fa-credit-card"></i> Recharge Wallet</a></li>
          <li class="nav-item"><a class="nav-link" href="contactus.php"><i class="fas fa-headset"></i> Support</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
          <li class="nav-item mt-4"><a class="nav-link" href="logout_u.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
    </nav>
    
    <!-- Main content -->
    <main class="col-md-10 ms-sm-auto main-content">
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
                <h2 class="mt-0">Ksh. <?php echo number_format($walletBalance, 2); ?></h2>
              </div>
              <div>
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
            <div class="stat-number"><?php echo $totalOrders; ?></div>
            <p>Total Orders</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
            <i class="fas fa-sync-alt fa-2x text-warning"></i>
            <div class="stat-number"><?php echo $activeOrders; ?></div>
            <p>Active Orders</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
            <i class="fas fa-check-circle fa-2x text-success"></i>
            <div class="stat-number"><?php echo $completedOrders; ?></div>
            <p>Completed Orders</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="announcement-card p-4">
            <h5><i class="fas fa-bullhorn me-2"></i> Announcements</h5>
            <div class="mt-3"><h6>New Feature</h6><p class="text-muted">We have added a new feature. Check it out now!</p><button class="btn btn-sm btn-green">View Details</button></div>
          </div>
        </div>
      </div>

      <!-- Recent Orders Section -->
      <div class="orders-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4>Recent Orders</h4>
          <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#newOrderModal"><i class="fas fa-plus me-1"></i> New Order</button>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead><tr><th>Order ID</th><th>Date</th><th>Service</th><th>Link</th><th>Quantity</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                <?php
                                    // Fetch user details from database (use only the columns you need)
                    $query  = "SELECT id, fullname, email FROM customer WHERE username = ?";
                    $stmt   = $conn->prepare($query);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $user   = $stmt->get_result()->fetch_assoc();

                    if (!$user) {
                        echo "<script>alert('User not found!'); window.location.href='customerlogin.php';</script>";
                        exit();
                    }

                    $fullname = $user['fullname'];
                    $userId   = (int)$user['id'];   // <-- we are going to refer to id column in customer table

                    // Fetch recent orders for this user
                    $ordersQuery = "SELECT * FROM orders WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 10";
                    $ordersResult = mysqli_query($conn, $ordersQuery);

                    if ($ordersResult && mysqli_num_rows($ordersResult) > 0) {
                        while ($order = mysqli_fetch_assoc($ordersResult)) {
                            // Status class for styling
                            $statusClass = '';
                            if ($order['status'] == 'Completed') $statusClass = 'status-completed';
                            elseif ($order['status'] == 'Processing') $statusClass = 'status-processing';
                            elseif ($order['status'] == 'Cancelled') $statusClass = 'status-cancelled';

                            echo "<tr>
                                    <td>#{$order['id']}</td>
                                    <td>{$order['created_at']}</td>
                                    <td>{$order['platform']}</td>
                                    <td><a href='{$order['link']}' target='_blank'>View Link</a></td>
                                    <td>{$order['quantity']}</td>
                                    <td>Ksh. " . number_format($order['amount'], 2) . "</td>;
                                    <td class='{$statusClass}'>{$order['status']}</td>
                                    <td><button class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewOrderModal' data-id='{$order['id']}'>View</button></td>
                        
                    
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No recent orders found.</td></tr>";
                    }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- BEGINNING OF MODALS -->
<!-- New Order Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Place New Order</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <form id="orderForm" action="process_order.php" method="POST">
          <div class="mb-3">
            <label for="service" class="form-label">Select Platform</label>
            <select class="form-select" id="service" name="platform" required>
              <option value="">-- Select Platform --</option>
              <?php
              $servicesQuery = "SELECT id, platform, price FROM services";
              $servicesResult = mysqli_query($conn, $servicesQuery);
              if ($servicesResult && mysqli_num_rows($servicesResult) > 0) {
                  while ($row = mysqli_fetch_assoc($servicesResult)) {
                      echo "<option value='{$row['id']}' data-price='{$row['price']}'>{$row['platform']}</option>";
                  }
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity"  placeholder="100" min="100" max="10000" required>
            <div class="form-text">Minimum: 100, Maximum: 10,000</div>
          </div>
          <div class="mb-3">
            <label for="link" class="form-label">Profile/Video Link</label>
            <input type="url" class="form-control" id="link" name="link" placeholder="https://..." required>
          </div>
          <div class="p-3 bg-light rounded">
            <p>Price per Subscriber/Follower: <strong>Ksh. <span id="priceLabel">0.00</span></strong></p>
            <p>Total: <strong>Ksh. <span id="totalLabel">0.00</span></strong></p>
            <p>Wallet Balance: <strong>Ksh. <?php echo number_format($walletBalance, 2); ?></strong></p>
          </div>
        </form>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" form="orderForm" class="btn btn-green">Place Order</button></div>
    </div>
  </div>
</div>

<!-- Recharge Wallet Modal -->
<div class="modal fade" id="rechargeModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Recharge Wallet</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <form id="rechargeForm" action="process_payment.php" method="POST">
        <div class="mb-3"><label for="amount" class="form-label">Amount (Ksh.)</label><input type="number" class="form-control" id="amount" name="amount"  placeholder="1000"min="100" required></div>
        <div class="mb-3">
          <label class="form-label">Payment Method</label>
          <div class="form-check"><input class="form-check-input" type="radio" name="method" value="mpesa" checked><label class="form-check-label">M-Pesa</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="method" value="card"><label class="form-check-label">Card</label></div>
        </div>
        <div id="mpesaDetails"><div class="mb-3"><label class="form-label">M-Pesa Phone</label><input type="tel" class="form-control" name="mobileNumber" placeholder="0712300045"></div></div>
        <div id="cardDetails" class="d-none">
          <div class="mb-3"><label class="form-label">Card Number</label><input type="text" class="form-control" name="cardNumber" placeholder="0000 0000 0000 0000"></div>
          <div class="row"><div class="col-md-4"><input type="text" class="form-control" name="cardExpiryMonth" placeholder="MM"></div><div class="col-md-4"><input type="text" class="form-control" name="cardExpiryYear" placeholder="YY"></div><div class="col-md-4"><input type="text" class="form-control" name="ccv" placeholder="123"></div></div>
          <div class="mb-3 mt-2"><label class="form-label">Name on Card</label><input type="text" class="form-control" name="cardName" placeholder="John Smith"></div>
        </div>
      </form>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" form="rechargeForm" class="btn btn-green">Proceed to Pay</button></div>
  </div></div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="orderDetails">
          <p class="text-center text-muted">Loading order details...</p>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- END OF MODALS -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Toggle M-Pesa vs Card
  document.querySelectorAll('input[name="method"]').forEach(el=>{
    el.addEventListener('change',()=>{
      if(el.value==='mpesa'){document.getElementById('mpesaDetails').classList.remove('d-none');document.getElementById('cardDetails').classList.add('d-none');}
      else{document.getElementById('mpesaDetails').classList.add('d-none');document.getElementById('cardDetails').classList.remove('d-none');}
    });
  });
  // Price calc
  const serviceDropdown=document.getElementById("service");
  const quantityInput=document.getElementById("quantity");
  const priceLabel=document.getElementById("priceLabel");
  const totalLabel=document.getElementById("totalLabel");
  let currentPrice=0;
  if(serviceDropdown){
    serviceDropdown.addEventListener("change",function(){
      currentPrice=parseFloat(this.options[this.selectedIndex].getAttribute("data-price"))||0;
      priceLabel.textContent=currentPrice.toFixed(2);
      calculateTotal();
    });
  }
  if(quantityInput){quantityInput.addEventListener("input",calculateTotal);}
  function calculateTotal(){let qty=parseInt(quantityInput.value)||0;let total=qty*currentPrice;totalLabel.textContent=total.toFixed(2);}

  // View Order - load details via AJAX
const viewOrderModal = document.getElementById('viewOrderModal');
if (viewOrderModal) {
  viewOrderModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const orderId = button.getAttribute('data-id');
    const orderDetails = document.getElementById('orderDetails');
    orderDetails.innerHTML = "<p class='text-center text-muted'>Loading order details...</p>";

    fetch("get_order.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + orderId
    })
    .then(response => response.text())
    .then(data => {
      orderDetails.innerHTML = data;
    })
    .catch(error => {
      orderDetails.innerHTML = "<p class='text-danger'>Error loading order details.</p>";
    });
  });
}

</script>

<footer><div class="container"><p>Copyright 2025 &copy; SMM Panel. All rights reserved.</p></div></footer>
</body>
</html>
