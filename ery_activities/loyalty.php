<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'panyeros_db');

// Initialize variables
$totalInventory = 0;
$lowStockCount = 0;
$totalLoyaltyPoints = 0;
$recentFeedbacks = [];

try {
    // Database connection
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get total inventory items
    $stmt = $conn->query("SELECT COUNT(*) as total FROM inventory");
    $totalInventory = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Get low stock items (assuming stock_quantity < 10 is low stock)
    $stmt = $conn->query("SELECT COUNT(*) as total FROM inventory WHERE stock_quantity < 10");
    $lowStockCount = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Get total loyalty points issued
    $stmt = $conn->query("SELECT SUM(points) as total FROM loyalty_cards");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalLoyaltyPoints = $result['total'] ?? 0;
    
    // Get recent feedbacks
    $stmt = $conn->query("SELECT customer_name, feedback, rating, created_at 
                          FROM feedbacks 
                          ORDER BY created_at DESC 
                          LIMIT 5");
    $recentFeedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// Get user name
$userName = $_SESSION['user_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Panyeros sa Kusina</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 200px;
            background: linear-gradient(180deg, #C17A3F 0%, #B8693A 100%);
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }
        
        .sidebar-header {
            background: #C17A3F;
            padding: 20px 15px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .nav-item a {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            color: #2d2d2d;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s;
            background: rgba(255,255,255,0.2);
        }
        
        .nav-item a:hover {
            background: rgba(255,255,255,0.3);
            padding-left: 25px;
        }
        
        .nav-item.active a {
            background: rgba(0,0,0,0.2);
            color: #fff;
            font-weight: 600;
        }
        
        .nav-icon {
            margin-right: 12px;
            font-size: 20px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 200px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .top-bar {
            background: linear-gradient(90deg, #C17A3F 0%, #D4874B 100%);
            padding: 15px 30px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .content-area {
            padding: 30px;
            flex: 1;
        }
        
        .page-title {
            font-size: 32px;
            color: #D4874B;
            margin-bottom: 30px;
            font-weight: 500;
        }
        
        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .dashboard-card {
            background: #b5b5b5;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            min-height: 150px;
            display: flex;
            flex-direction: column;
        }
        
        .card-title {
            color: #4a4a4a;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-value {
            font-size: 72px;
            font-weight: bold;
            color: #2d2d2d;
            margin: auto 0;
            text-align: center;
        }
        
        .card-small-value {
            font-size: 48px;
        }
        
        /* Feedback Section */
        .feedback-section {
            background: #b5b5b5;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .section-title {
            color: #4a4a4a;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .feedback-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .feedback-item {
            background: rgba(255,255,255,0.3);
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #D4874B;
        }
        
        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .customer-name {
            font-weight: 600;
            color: #2d2d2d;
        }
        
        .feedback-date {
            font-size: 12px;
            color: #666;
        }
        
        .feedback-text {
            color: #444;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .rating {
            color: #F5B461;
            margin-top: 5px;
        }
        
        .no-data {
            text-align: center;
            color: #666;
            padding: 40px;
            font-style: italic;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            
            .sidebar-header {
                font-size: 12px;
                padding: 15px 10px;
            }
            
            .nav-item a {
                padding: 15px 10px;
                justify-content: center;
            }
            
            .nav-item a span:not(.nav-icon) {
                display: none;
            }
            
            .main-content {
                margin-left: 60px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            Panyeros sa kusina
        </div>
        <ul class="nav-menu">
            <li class="nav-item active">
                <a href="dashboard.php">
                    <span class="nav-icon">🏠</span>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="loyalty-cards.php">
                    <span class="nav-icon">💳</span>
                    <span>Loyalty Cards</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="feedbacks.php">
                    <span class="nav-icon">💬</span>
                    <span>Feedbacks</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($userName); ?></span>
            </div>
            <a href="logout.php" style="text-decoration: none;">
                <button class="logout-btn">Logout</button>
            </a>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            <h1 class="page-title">Dashboard</h1>
            
            <!-- Dashboard Cards -->
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-title">Total Inventory Items</div>
                    <div class="card-value"><?php echo $totalInventory; ?></div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-title">Low Stock Alert</div>
                    <div class="card-value"><?php echo $lowStockCount; ?></div>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-title">Total Loyalty Points Issued</div>
                    <div class="card-value card-small-value"><?php echo number_format($totalLoyaltyPoints); ?></div>
                </div>
            </div>
            
            <!-- Recent Feedback Section -->
            <div class="feedback-section">
                <div class="section-title">Recent Feedback</div>
                
                <?php if (empty($recentFeedbacks)): ?>
                    <div class="no-data">No feedback available yet</div>
                <?php else: ?>
                    <div class="feedback-list">
                        <?php foreach ($recentFeedbacks as $feedback): ?>
                            <div class="feedback-item">
                                <div class="feedback-header">
                                    <span class="customer-name"><?php echo htmlspecialchars($feedback['customer_name']); ?></span>
                                    <span class="feedback-date"><?php echo date('M d, Y', strtotime($feedback['created_at'])); ?></span>
                                </div>
                                <div class="feedback-text"><?php echo htmlspecialchars($feedback['feedback']); ?></div>
                                <div class="rating">
                                    <?php 
                                    $rating = isset($feedback['rating']) ? (int)$feedback['rating'] : 0;
                                    echo str_repeat('⭐', $rating); 
                                    ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>