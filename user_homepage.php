<?php
session_start();
$customer_id = $_SESSION['customer_id'] ?? null;

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
} else {
    echo "<h4 style='margin: 20px;'>Welcome Guest!  <a href='customer_login.php'> Login</a><a href='customer_registration.php'> Register</a></h4>";
          
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
  background-color: #e67e00;
  margin: 0;
  font-family: Arial, sans-serif;
}

.toggle-btn {
  display: none;
  background-color: orange;
  color: white;
  border: none;
  padding: 10px 15px;
  margin: 10px;
  border-radius: 15px;
  cursor: pointer;
  font-size: 16px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  width: 120px;
  text-align: center;
  text-overflow: ellipsis;
  white-space: nowrap;
}

ul.navbar {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: orange;
  border-radius: 15px;
  margin: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  display: flex;
  justify-content: center;
  align-items: center;
}

ul.navbar li {
  flex: 1 0 auto;
  margin: auto;
}

ul.navbar li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

ul.navbar li a:hover {
  background-color: #e67e00;
  border-radius: 15px;
}

.active {
  background-color: #cc6d00;
  border-radius: 10px;
}

.main-content {
  display: flex;
  padding: 15px;
}

.sidebar {
  width: 200px;
  background-color: #ffa733;
  padding: 15px;
  border-radius: 15px;
  margin-right: 15px;
  height: 80vh;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.sidebar h3 {
  color: white;
  margin-top: 0;
}

.sidebar ul {
  padding-left: 0;
}

.sidebar ul li {
  list-style: none;
  margin: 10px 0;
}

.sidebar ul li a {
  color: white;
  text-decoration: none;
  display: block;
  padding: 8px;
  border-radius: 10px;
}

.sidebar ul li a:hover {
  background-color: #e67e00;
}

.items-display {
  display: flex;
  flex-wrap: wrap;
  margin-left: 50px;
  margin-right: 50px;
  background-color: #fff8f0;
  border-radius: 15px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  padding-left: 40px;
  padding-top: 20px;
  padding-bottom: 20px;
  padding-right: 20px;
  border-radius: 15px;
  flex-direction: row;
  gap: 20px;
  justify-content: flex-start;
  align-items: flex-start;
  width: 100%;
}

.item-card {
  background-color: white;
  border-radius: 15px;
  width: 230px;
  height: 300px;
  padding: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  transition: transform 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
  position: relative;
  text-align: center;
}

.item-card:hover {
  transform: translateY(-5px);
}

.item-card img {
  width: 100%;
  height: 200px;
  object-fit: contain;
  background-color: #f0f0f0;
  border-radius: 10px;
}

.item-card h3 {
  margin: 5px 0;
  font-size: 16px;
  color: #e67e00;
  overflow: visible;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.item-card p {
  margin: 0;
  font-size: 14px;
  color: #666;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%;
  white-space: nowrap;
}

.item-card button,
.item-card form button {
  padding: 5px 10px;
  margin-top: 4px;
  font-size: 13px;
  background-color: orange;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  box-sizing: border-box;
}

.item-card button:hover,
.item-card form button:hover {
  background-color: #e67e00;
}


li:first-child a {
  border-top-left-radius: 15px;
  border-bottom-left-radius: 15px;
}

li:last-child a {
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
}

.hidden {
  display: none;
}
.cart-container {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  max-width: 1000px;
  margin: 30px auto;
}
.cart-container h2 {
  color: #e67e00;
  margin-top: 0;
}
.cart-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
}
.cart-item img {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-right: 20px;
  border-radius: 10px;
}
.cart-item h4 {
  margin: 0 0 5px 0;
  color: #e67e00;
}
.cart-item p {
  margin: 0;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 150px;
}
.remove-btn {
  background: #ff4444;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 6px;
  cursor: pointer;
  margin-left: auto;
}
.remove-btn:hover {
  background: #cc0000;
}
</style>
</head>
<body>

<!-- Navigation -->
<ul class="navbar">
<?php
$conn = new mysqli("localhost", "root", "", "Finals");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$currentNav = isset($_GET['nav']) ? $_GET['nav'] : 'Home';
// Fetch nav categories from database
$sql = "SELECT nav_name FROM nav_category";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $navName = htmlspecialchars($row['nav_name'], ENT_QUOTES, 'UTF-8');
    $isActive = ($currentNav === $navName) ? 'active' : '';
    echo "<li><a class='$isActive' href='?nav=" . urlencode($navName) . "'>$navName</a></li>";
  }
} else {
  echo "<li><a href='#'>No nav categories</a></li>";
}
$conn->close();
?>
</ul>

<?php
if (isset($_GET['nav']) && $_GET['nav'] === 'Cart') {
?>

  <div class="cart-container">
    <h2>Your Cart</h2>
    <?php
      // Payment process display (mock API) - now handled in popup/modal
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['popup_payment']) && isset($_POST['amount']) && isset($_POST['payment_method']) && isset($_POST['item_name'])) {
          $amount = $_POST['amount'];
          $payment_method = $_POST['payment_method'];
          $item_name = $_POST['item_name'];
          $customer_id = $_SESSION['customer_id'] ?? null;

          $url = "https://apitpoint.com/api/payMock.php";
          $data = [
              'amount' => $amount,
              'payment_method' => $payment_method
          ];

          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          $response = curl_exec($ch);

          if (curl_errno($ch)) {
              $popupResult = "<div style='color:red;'>cURL Error: " . htmlspecialchars(curl_error($ch)) . "</div>";
              curl_close($ch);
          } else {
              curl_close($ch);
              $result = json_decode($response, true);

              $popupResult = "<div style='background:#fff8f0; border-radius:10px; padding:20px; margin-bottom:20px; box-shadow:0 2px 5px rgba(0,0,0,0.1);'>";
              $popupResult .= "<h3 style='color:#e67e00;'>Payment Response</h3>";
              $popupResult .= "Message: " . htmlspecialchars($result['message'] ?? '') . "<br>";
              $popupResult .= "Amount: " . htmlspecialchars($result['amount'] ?? '') . "<br>";
              $popupResult .= "Payment Method: " . htmlspecialchars($result['payment_method'] ?? '') . "<br>";
              $popupResult .= "Status: " . htmlspecialchars($result['status'] ?? '') . "<br>";
              $popupResult .= "</div>";

              // Remove the item from cart if payment is successful
              if (isset($result['status']) && strtolower($result['status']) === 'success' && $customer_id) {
                  $conn = new mysqli("localhost", "root", "", "Finals");
                  if (!$conn->connect_error) {
                      $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND item_name = ?");
                      $stmt->bind_param("is", $customer_id, $item_name);
                      $stmt->execute();
                      $stmt->close();
                      $conn->close();
                  }
              }
          }
          $itemNameJS = json_encode($item_name);
          $paymentMethodJS = json_encode($payment_method);
          $orderQty = isset($_POST['order_quantity']) ? (int)$_POST['order_quantity'] : 1;
          $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 0;
          $itemPrice = $orderQty > 0 ? $amount / $orderQty : $amount;

          $itemPriceJS = json_encode($itemPrice);
          $orderQtyJS = json_encode($orderQty);
          $amountJS = json_encode($amount);
          $paymentStatusJS = json_encode(strtolower($result['status'] ?? ''));
          // Output JS to open modal and show result, then reload to update cart only once
          echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              var modal = document.getElementById('paymentModal');
              var content = document.getElementById('paymentModalContent');
              if (modal && content) {
                content.innerHTML = " . json_encode($popupResult) . ";
                modal.style.display = 'block';

                if ($paymentStatusJS === 'success') {
                  setTimeout(function() {
                    setOrderFormValues(
                      $itemNameJS,
                      $itemPriceJS,
                      $orderQtyJS,
                      $amountJS,
                      $paymentMethodJS
                    );
                    document.getElementById('orderForm').submit();
                  }, 5000);
                } else {
                  setTimeout(function() {
                    modal.style.display = 'none';
                  }, 2800);
                }
              }
            });
          </script>";
      }
    ?>

    <!-- Payment Modal -->
    <div id="paymentModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4);">
      <div style="background:#fff; border-radius:12px; max-width:400px; margin:80px auto; padding:30px 25px; position:relative; box-shadow:0 2px 10px rgba(0,0,0,0.2);" id="paymentModalContent">
        <!-- Payment form/result will be injected here -->
      </div>
      <button onclick="document.getElementById('paymentModal').style.display='none';" style="position:absolute; top:90px; right:calc(50vw - 200px); background:#e67e00; color:#fff; border:none; border-radius:50%; width:32px; height:32px; font-size:20px; cursor:pointer;">&times;</button>
    </div>
    <script>
      // Open modal with payment form
      function openPaymentModal(itemName, itemPrice, quantity, amount) {
        // amount is passed directly, no need to recalculate unless you want to
        var modal = document.getElementById('paymentModal');
        var content = document.getElementById('paymentModalContent');
        content.innerHTML = `
          <h3 style="color:#e67e00;">Pay for <span style="color:#333;">${itemName}</span></h3>
          <form method="post" action="" style="margin-top:15px;">
            <input type="hidden" name="popup_payment" value="1">
            <input type="hidden" name="item_name" value="${itemName}">
            <input type="hidden" name="amount" value="${amount}">
            <input type="hidden" name="order_quantity" value="${quantity}">
            <div style="margin-bottom:10px;">
              <label>Amount:</label>
              <input type="text" value="₱${amount}" readonly style="border:none; background:#f8f8f8; border-radius:6px; padding:6px 10px; width:120px;">
            </div>
            <div style="margin-bottom:15px;">
              <label>Payment Method:</label>
              <select name="payment_method" required style="padding:8px; border-radius:6px; border:1px solid #ccc; margin-left:10px;">
                <option value="" disabled selected>Select a payment method</option>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
              </select>
            </div>
            <button type="submit" class="order-btn" style="width:100%;">Pay Now</button>
          </form>
        `;
        modal.style.display = 'block';
      }
      // Close modal on outside click
      window.onclick = function(event) {
        var modal = document.getElementById('paymentModal');
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

    <?php
      // Make sure the session has customer_id set
      if (!isset($_SESSION['customer_id'])) {
        echo "<p>You are not logged in.</p>";
      } else {
        $customer_id = $_SESSION['customer_id'];
        $conn = new mysqli("localhost", "root", "", "Finals");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $stmt = $conn->prepare("SELECT cart_id, item_name, item_description, item_price, item_image, quantity FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
          echo "<p>Your cart is empty.</p>";
        } else {
          while ($item = $result->fetch_assoc()) {
            $amount = (float)$item['item_price'] * (int)$item['quantity'];
            $cartId = (int)$item['cart_id'];
            $orderQtyId = "order_quantity_$cartId";
            $itemPriceId = "item_price_$cartId";
            $amountId = "amount_$cartId";
            $updateFunc = "updateAmount_$cartId";
            echo "<div class='cart-item'>
                    <img src='" . htmlspecialchars($item['item_image'], ENT_QUOTES) . "' alt='Item Image'>
                    <div class='cart-item-details'>
                      <h4>" . htmlspecialchars($item['item_name']) . "</h4>
                      <p>" . htmlspecialchars($item['item_description']) . "</p>
                      <p><strong>₱" . number_format($item['item_price'], 2) . "</strong></p>
                    </div>
                    <form method='post' action='process_order.php' oninput=\"{$updateFunc}()\" style='display:inline-block;'>
                      <div class='cart-order-btn-container'>
                        <label for='{$orderQtyId}' style='margin-right:8px;'>Quantity:</label>
                        <input type='number' id='{$orderQtyId}' name='order_quantity' value='" . (int)$item['quantity'] . "' min='1' style='width:60px; margin-right:10px;' onchange=\"{$updateFunc}()\">
                        <input type='hidden' name='item_name' value='" . htmlspecialchars($item['item_name'], ENT_QUOTES) . "'>
                        <input type='hidden' name='item_price' id='{$itemPriceId}' value='" . htmlspecialchars($item['item_price'], ENT_QUOTES) . "'>
                        <label for='{$amountId}' style='margin-right:8px;'>Amount:</label>
                        <input type='number' name='amount' id='{$amountId}' value='" . number_format($amount, 2, '.', '') . "' step='0.01' style='padding:8px; border-radius:6px; border:1px solid #ccc; width:120px; margin-right:10px;' readonly>
                        <button type='button' class='order-btn'
                          onclick=\"openPaymentModal(
                            '" . htmlspecialchars(addslashes($item['item_name'])) . "',
                            document.getElementById('{$itemPriceId}').value,
                            document.getElementById('{$orderQtyId}').value,
                            document.getElementById('{$amountId}').value
                          );\">
                          Order
                        </button>
                      </div>
                    </form>
                    <script>
                      function {$updateFunc}() {
                        var qty = document.getElementById('{$orderQtyId}').value;
                        var price = document.getElementById('{$itemPriceId}').value;
                        var amount = parseFloat(qty) * parseFloat(price);
                        document.getElementById('{$amountId}').value = amount.toFixed(2);
                      }
                    </script>
                    <form method='post' action='delete_cart.php' class='cart-remove-form' onsubmit='return confirm(\"Are you sure you want to remove this item from the cart?\");'>
                      <input type='hidden' name='cart_id' value='" . (int)$item['cart_id'] . "'>
                      <button type='submit' class='remove-btn'>X</button>
                    </form>
                  </div>";
          }
        }
        $stmt->close();
        $conn->close();
      }
    ?>

    <style>
      .cart-item-details {
        flex: 1;
      }
      .cart-remove-form {
        margin-left: 20px;
        display: flex;
        align-items: center;
      }
      .cart-order-btn-container {
        text-align: right;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
      }
      .order-btn {
        background: #e67e00;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 6px;
        cursor: pointer;
      }
      .order-btn:hover {
        background: #cc6d00;
      }
    </style>
  </div>
<?php
}
?>

<button class="toggle-btn" id="navToggle">☰ Menu</button>

<?php if (!isset($_GET['nav']) || $_GET['nav'] === 'Home'): ?>
<!-- Main content section -->
<div class="main-content">

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Categories</h3>
    <ul>
      <?php
      $conn = new mysqli("localhost", "root", "", "Finals");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $currentCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

      // All category
      $activeClass = ($currentCategory === 'all') ? 'active' : '';
      echo "<li><a class='$activeClass' href='?nav=Home&category=all'>All</a></li>";

      // Other categories
      $sql = "SELECT category_name FROM categories";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $category = htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8');
          $isActive = ($currentCategory === $category) ? 'active' : '';
          echo "<li><a class='$isActive' href='?nav=Home&category=" . urlencode($category) . "'>$category</a></li>";
        }
      } else {
        echo "<li><a href='#'>No categories available</a></li>";
      }

      $conn->close();
      ?>
    </ul>
  </div>

  <!-- Items Section -->
  <div class="items-display">
    <?php
    $conn = new mysqli('localhost', 'root', '', 'Finals');
    if ($conn->connect_error) {
      die("Database connection failed.");
    }

    // Fetch items based on selected category
    $category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';

    if ($category_filter === 'all') {
      $sql = "SELECT item_name, item_description, item_price, category_name, item_image FROM item_details";
      $stmt = $conn->prepare($sql);
    } else {
      $sql = "SELECT item_name, item_description, item_price, category_name, item_image FROM item_details WHERE category_name = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $category_filter);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Display items
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        // Add to Cart form posts to add_to_cart.php, which should handle DB insert
        echo "<div class='item-card'>
                <img src='{$row['item_image']}' alt='Image' style='width:100%; height:150px; object-fit:cover; border-radius:10px; margin-bottom:10px;'>
                <h3>" . htmlspecialchars($row['item_name']) . "</h3>
                <p>" . htmlspecialchars($row['item_description']) . "</p>
                <p><strong>₱" . number_format($row['item_price'], 2) . "</strong></p>
                <form method='post' action='add_to_cart.php' style='margin-bottom:5px;'>
                  <input type='hidden' name='item_name' value='" . htmlspecialchars($row['item_name'], ENT_QUOTES) . "'>
                  <input type='hidden' name='item_description' value='" . htmlspecialchars($row['item_description'], ENT_QUOTES) . "'>
                  <input type='hidden' name='item_price' value='" . htmlspecialchars($row['item_price'], ENT_QUOTES) . "'>
                  <input type='hidden' name='item_image' value='" . htmlspecialchars($row['item_image'], ENT_QUOTES) . "'>
                  <button type='submit'>Add to Cart</button>
                </form>
                <button onclick=\"location.href='view_item.php?item_name=" . urlencode($row['item_name']) . "'\">View Item</button>
              </div>";
      }
    } else {
      echo "<p>No items available.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
  </div>
</div>
<?php endif; ?>

<style>
.profile-container {
  max-width: 700px;
  margin: 40px auto;
  background: #fff8f0;
  border-radius: 15px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  padding: 30px;
  text-align: center;
}
.profile-avatar {
  margin-bottom: 20px;
}
.profile-avatar img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.profile-username {
  color: #e67e00;
  margin-bottom: 10px;
}
.profile-shipping {
  margin-bottom: 20px;
}
.profile-label {
  font-weight: bold;
}
.profile-btn {
  background: #e67e00;
  color: #fff;
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  margin-bottom: 12px;
  margin-top: 5px;
  transition: background 0.2s;
}
.profile-btn:hover {
  background: #cc6d00;
}
.profile-logout {
  display: inline-block;
  background: red;
  color: #fff;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  margin-top: 10px;
}
.profile-not-logged-in,
.profile-db-fail,
.profile-not-found {
  text-align: center;
  margin-top: 40px;
}
.shipping-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.4);
}
.shipping-modal-content {
  background: #fff;
  border-radius: 12px;
  max-width: 400px;
  margin: 100px auto;
  padding: 30px 25px;
  position: relative;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  text-align: left;
}
.shipping-address-textarea {
  width: 100%;
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
}
.shipping-modal-actions {
  margin-top: 15px;
  display: flex;
  gap: 10px;
}
.cancel-btn {
  background: #ccc;
  color: #333;
}
.orders-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.4);
}
.orders-modal-content {
  background: #fff;
  border-radius: 12px;
  max-width: 700px;
  margin: 90px auto;
  padding: 30px 25px;
  position: relative;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  text-align: left;
}
.orders-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}
.orders-table th, .orders-table td {
  padding: 8px 10px;
  border-bottom: 1px solid #eee;
  text-align: left;
}
.orders-table th {
  background: #f6e9d8;
  color: #e67e00;
}
.orders-table tr:last-child td {
  border-bottom: none;
}
.no-orders,
.orders-error,
.loading-orders {
  text-align: center;
  margin: 18px 0;
  color: #888;
}
</style>
<?php
if (isset($_GET['nav']) && $_GET['nav'] === 'Profile') {
  function displayCustomerProfile() {
    if (!isset($_SESSION['customer_id'])) {
      echo "<div class='profile-not-logged-in'><h2>You're currently not logged in!</h2></div>";
      return;
    }
    $customer_id = $_SESSION['customer_id'];
    $conn = new mysqli("localhost", "root", "", "Finals");
    if ($conn->connect_error) {
      echo "<div class='profile-db-fail'><h2>Database connection failed.</h2></div>";
      return;
    }
    $stmt = $conn->prepare("SELECT customer_username, shipping_address FROM customer_accounts WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $stmt->bind_result($customer_username, $shipping_address);
    if ($stmt->fetch()) {
      $safe_shipping_address = htmlspecialchars($shipping_address, ENT_QUOTES, 'UTF-8');
      echo "
      <div class='profile-container'>
        <div class='profile-avatar'>
          <img src='https://ui-avatars.com/api/?name=" . urlencode($customer_username) . "&background=e67e00&color=fff&rounded=true&size=100' alt='Profile'>
        </div>
        <h2 class='profile-username'>" . htmlspecialchars($customer_username, ENT_QUOTES, 'UTF-8') . "</h2>
        <div class='profile-shipping'>
          <label class='profile-label'>Shipping Address:</label>
          <span id='shippingAddressDisplay'>$safe_shipping_address</span>
        </div>
        <button onclick=\"document.getElementById('customizeShippingModal').style.display='block';\" class='profile-btn'>Customize Shipping Address</button><br>
        <button onclick=\"document.getElementById('viewOrdersModal').style.display='block';\" class='profile-btn'>View Orders</button><br>
        <a href='logout.php' class='profile-logout'>Logout</a>
      </div>
      <!-- Modal for customizing shipping address -->
      <div id='customizeShippingModal' class='shipping-modal'>
        <div class='shipping-modal-content'>
          <h3>Customize Shipping Address</h3>
          <form method='post'>
            <input type='hidden' name='update_shipping_address' value='1'>
            <textarea name='shipping_address' rows='4' class='shipping-address-textarea'>$safe_shipping_address</textarea>
            <div class='shipping-modal-actions'>
              <button type='submit' class='profile-btn'>Save</button>
              <button type='button' onclick=\"document.getElementById('customizeShippingModal').style.display='none';\" class='profile-btn cancel-btn'>Cancel</button>
            </div>
          </form>
        </div>
      </div>
      ";
      $stmt->close(); // Close before running new queries!

      // Modal for viewing orders (no AJAX, all fetched here)
      echo "
      <div id='viewOrdersModal' class='orders-modal' style='display:none;'>
        <div class='orders-modal-content'>
          <h3>Your Orders</h3>
          <table border='1' cellpadding='10' cellspacing='0' style='width:100%; border-collapse: collapse; margin: 0 auto; text-align: center;'>
            <thead style='background-color: #e67e00; color: white;'>
              <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Qty</th>
                <th>Total (₱)</th>
                <th>Payment</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>";
      // Fetch user orders and their items (no AJAX)
      $orders_sql = "SELECT order_id, order_date, status, payment_method FROM orders WHERE customer_id = ? ORDER BY order_date DESC";
      $orders_stmt = $conn->prepare($orders_sql);
      $orders_stmt->bind_param("i", $customer_id);
      $orders_stmt->execute();
      $orders_result = $orders_stmt->get_result();

      if ($orders_result && $orders_result->num_rows > 0) {
        while($order = $orders_result->fetch_assoc()) {
          $order_id = $order['order_id'];
          // Fetch order items for this order
          $items_sql = "SELECT item_name, item_price, quantity FROM order_items WHERE order_id = ?";
          $items_stmt = $conn->prepare($items_sql);
          $items_stmt->bind_param("i", $order_id);
          $items_stmt->execute();
          $items_result = $items_stmt->get_result();

          $item_names = [];
          $quantities = [];
          $total = 0;
          if ($items_result && $items_result->num_rows > 0) {
            while ($item = $items_result->fetch_assoc()) {
              $item_names[] = htmlspecialchars($item['item_name']);
              $quantities[] = (int)$item['quantity'];
              $total += $item['item_price'] * $item['quantity'];
            }
          }
          $items_stmt->close(); // CLOSE EACH ITEM STMT

          echo "<tr>";
          echo "<td>" . htmlspecialchars($order_id) . "</td>";
          echo "<td>" . htmlspecialchars($order['order_date']) . "</td>";
          echo "<td>" . (!empty($item_names) ? implode('<br>', $item_names) : '-') . "</td>";
          echo "<td>" . (!empty($quantities) ? implode('<br>', $quantities) : '-') . "</td>";
          echo "<td>" . number_format($total,2) . "</td>";
          echo "<td>" . htmlspecialchars($order['payment_method']) . "</td>";
          echo "<td>" . htmlspecialchars($order['status']) . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>You have no orders yet.</td></tr>";
      }
      $orders_stmt->close();
      echo "
            </tbody>
          </table>
          <div style='margin-top:18px; text-align:center;'>
            <button type='button' onclick=\"document.getElementById('viewOrdersModal').style.display='none';\" class='profile-btn cancel-btn'>Close</button>
          </div>
        </div>
      </div>
      <script>
        // Show modal for orders without AJAX
        document.querySelectorAll('.profile-btn').forEach(function(btn) {
          if (btn.textContent.trim() === 'View Orders') {
            btn.addEventListener('click', function() {
              document.getElementById('viewOrdersModal').style.display = 'block';
            });
          }
        });
        // Hide modal when clicking outside (optional)
        window.onclick = function(event) {
          var modal = document.getElementById('viewOrdersModal');
          if (event.target == modal) {
            modal.style.display = 'none';
          }
          var modal2 = document.getElementById('customizeShippingModal');
          if (event.target == modal2) {
            modal2.style.display = 'none';
          }
        }
      </script>
      ";
    } else {
      $stmt->close();
      echo "<div class='profile-not-found'><h2>User not found.</h2></div>";
    }
    $conn->close();
  }

  // Handle shipping address update
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_shipping_address'])) {
    if (!empty($_POST['shipping_address']) && isset($_SESSION['customer_id'])) {
      $new_addr = $_POST['shipping_address'];
      $customer_id = $_SESSION['customer_id'];
      $conn = new mysqli("localhost", "root", "", "Finals");
      if (!$conn->connect_error) {
        $stmt = $conn->prepare("UPDATE customer_accounts SET shipping_address = ? WHERE customer_id = ?");
        $stmt->bind_param("si", $new_addr, $customer_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        // Refresh to show the new address
        echo "<script>window.location.href=window.location.href;</script>";
        exit;
      }
    }
  }
  displayCustomerProfile();
}
?>


<form id="orderForm" method="post" action="process_order.php" style="display:none;">
  <input type="hidden" name="payment_method" id="orderPaymentMethod">
  <input type="hidden" name="item_name" id="orderItemName">
  <input type="hidden" name="item_price" id="orderItemPrice">
  <input type="hidden" name="order_quantity" id="orderQuantity">
  <input type="hidden" name="amount" id="orderAmount">
</form>
<script>
  // Helper to set values before submitting the hidden order form
  function setOrderFormValues(itemName, itemPrice, quantity, amount, paymentMethod) {
    document.getElementById('orderItemName').value = itemName;
    document.getElementById('orderItemPrice').value = itemPrice;
    document.getElementById('orderQuantity').value = quantity;
    document.getElementById('orderAmount').value = amount;
    document.getElementById('orderPaymentMethod').value = paymentMethod;
  }
</script>
</body>
</html>
