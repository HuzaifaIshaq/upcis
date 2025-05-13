<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.php'; ?>
<?php include 'header.php'; ?>

<h2>Add New Order</h2>
<form action="add_order.php" method="POST">
    <div class="mb-3">
        <label for="order_date" class="form-label">Order Date</label>
        <input type="date" class="form-control" id="order_date" name="order_date" required>
    </div>
    <div class="mb-3">
        <label for="order_number" class="form-label">Order Number</label>
        <input type="text" class="form-control" id="order_number" name="order_number" required>
    </div>
    <div class="mb-3">
        <label for="tracking_code" class="form-label">Tracking Code</label>
        <input type="text" class="form-control" id="tracking_code" name="tracking_code">
    </div>
    <div class="mb-3">
        <label for="cost_price" class="form-label">Cost Price</label>
        <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" required>
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="auto_add" name="auto_add">
            <label class="form-check-label" for="auto_add">Add 10% to Cost Price</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="sale_price" class="form-label">Sale Price</label>
        <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" required>
    </div>
    <div class="mb-3">
        <label for="comments" class="form-label">Comments</label>
        <textarea class="form-control" id="comments" name="comments"></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Order</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $order_date = $_POST['order_date'];
    $order_number = $_POST['order_number'];
    $tracking_code = $_POST['tracking_code'];
    $cost_price = $_POST['cost_price'];
    if (isset($_POST['auto_add'])) {
        $cost_price *= 1.1;
    }
    $sale_price = $_POST['sale_price'];
    $comments = $_POST['comments'];
    $month_year = date('Y-m', strtotime($order_date));

    $sql = "INSERT INTO orders (order_date, order_number, tracking_code, cost_price, sale_price, comments, month_year)
            VALUES ('$order_date', '$order_number', '$tracking_code', '$cost_price', '$sale_price', '$comments', '$month_year')";

    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Order added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<?php include 'footer.php'; ?>
