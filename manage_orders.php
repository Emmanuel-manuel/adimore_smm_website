<?php
// Start session
require_once 'connection.php';
include('session_m.php');

if (!isset($login_session)) {
    header('Location: managerlogin.php'); 
    exit();
}

$conn = Connect();

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $updateQuery = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";
    if (mysqli_query($conn, $updateQuery)) {
        $success = "Order status updated successfully!";
    } else {
        $error = "Error updating order status: " . mysqli_error($conn);
    }
}

// Fetch all orders from the database with customer information
$query = "SELECT o.*, c.fullname, c.email, c.contact 
          FROM orders o 
          JOIN customer c ON o.user_id = c.id 
          ORDER BY o.created_at DESC";
$result = mysqli_query($conn, $query);

// Check if there are any orders
$orders = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="css/manage_orders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Admin<span>Panel</span></div>
                <div class="admin-info">
                    <div class="admin-avatar">A</div>
                    <div>Welcome, Admin</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <a href="manageservices.php" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        
        <h1 class="page-title">
            <i class="fas fa-clipboard-list"></i> Manage Orders
        </h1>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
                <div class="card order-card">
                    <div class="card-header">
                        <div class="order-id">Order #<?php echo $order['id']; ?></div>
                        <div>
                            <span class="platform-badge"><?php echo $order['platform']; ?></span>
                            <span class="status-badge status-<?php echo strtolower($order['status']); ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="order-info">
                        <div class="info-item">
                            <span class="info-label">Customer</span>
                            <span class="info-value"><?php echo $order['fullname']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?php echo $order['email']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <span class="info-value"><?php echo $order['contact']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">User ID</span>
                            <span class="info-value"><?php echo $order['user_id']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Quantity</span>
                            <span class="info-value"><?php echo $order['quantity']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Amount</span>
                            <span class="info-value">$<?php echo number_format($order['amount'], 2); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Order Date</span>
                            <span class="info-value"><?php echo date('M j, Y g:i A', strtotime($order['created_at'])); ?></span>
                        </div>
                        <div class="info-item link-item">
                            <span class="info-label">Link</span>
                            <span class="info-value">
                                <a href="<?php echo $order['link']; ?>" target="_blank">
                                    <?php echo $order['link']; ?>
                                </a>
                            </span>
                        </div>
                    </div>
                    <form method="POST" class="action-form">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <select name="status" class="form-select" required>
                            <option value="Processing" <?php echo $order['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                            <option value="Completed" <?php echo $order['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Cancelled" <?php echo $order['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                        <button type="submit" class="btn-update">
                            <i class="fas fa-sync-alt"></i> Update Status
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card">
                <div class="no-orders">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>No Orders Found</h3>
                    <p>There are no orders in the system at the moment.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation to status update
        document.querySelectorAll('.btn-update').forEach(button => {
            button.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            });
        });
        
        // Add confirmation for cancelling orders
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const statusSelect = this.querySelector('select[name="status"]');
                if (statusSelect.value === 'Cancelled') {
                    if (!confirm('Are you sure you want to cancel this order?')) {
                        e.preventDefault();
                    }
                }
            });
        });
    </script>
</body>
</html>