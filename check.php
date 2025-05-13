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
    </div>

    <!-- Collapsible Section -->
    <div class="mb-3">
        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#lahorePrices" aria-expanded="false" aria-controls="lahorePrices">
            View Lahore Prices
        </button>
        <div class="collapse mt-3" id="lahorePrices">
            <div class="card card-body">
                <div class="primary-card">
                    <div class="card-header">Price Calculator</div>
                    <form id="price-calculator-form" onsubmit="calculateTotalAdjustedPrice(event); return false;">
                        <div class="form-group">
                            <label for="order-number">Order Number:</label>
                            <input type="number" class="form-control" id="order-number" placeholder="Order Number">
                        </div>

                        <!-- Book 1 -->
                        <div class="form-group row">
                            <label class="col-sm-6">LPBook1 List Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook1-list" placeholder="List Price">
                            <label class="col-sm-6">Purchase Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook1-purchase" placeholder="Purchase Price">
                            <p><strong>Adjusted Discount:</strong> <span id="lpbook1-discount">0%</span></p>
                        </div>

                        <!-- Book 2 -->
                        <div class="form-group row">
                            <label class="col-sm-6">LPBook2 List Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook2-list" placeholder="List Price">
                            <label class="col-sm-6">Purchase Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook2-purchase" placeholder="Purchase Price">
                            <p><strong>Adjusted Discount:</strong> <span id="lpbook2-discount">0%</span></p>
                        </div>

                        <!-- Book 3 -->
                        <div class="form-group row">
                            <label class="col-sm-6">LPBook3 List Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook3-list" placeholder="List Price">
                            <label class="col-sm-6">Purchase Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook3-purchase" placeholder="Purchase Price">
                            <p><strong>Adjusted Discount:</strong> <span id="lpbook3-discount">0%</span></p>
                        </div>

                        <!-- Book 4 -->
                        <div class="form-group row">
                            <label class="col-sm-6">LPBook4 List Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook4-list" placeholder="List Price">
                            <label class="col-sm-6">Purchase Price:</label>
                            <input type="number" class="form-control col-sm-6" id="lpbook4-purchase" placeholder="Purchase Price">
                            <p><strong>Adjusted Discount:</strong> <span id="lpbook4-discount">0%</span></p>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Calculate Total</button>
                    </form>

                    <div class="text-center" style="margin-top: 20px;">
                        <h4>Total Adjusted Purchase Price: <span id="final-price">0.00</span></h4>
                    </div>
                </div>
            </div>
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

<script>
    function calculateTotalAdjustedPrice(event) {
        event.preventDefault();

        function getAdjustedPrice(listPrice, purchasePrice) {
            if (listPrice > 0) {
                const initialDiscount = ((listPrice - purchasePrice) / listPrice) * 100;
                const adjustedDiscount = Math.max(initialDiscount - 10, 0); 
                return listPrice * (1 - adjustedDiscount / 100);
            } else {
                return purchasePrice;
            }
        }

        let totalAdjustedPrice = 0;

        const books = [1, 2, 3, 4];
        books.forEach(book => {
            const listPrice = parseFloat(document.getElementById(`lpbook${book}-list`).value) || 0;
            const purchasePrice = parseFloat(document.getElementById(`lpbook${book}-purchase`).value) || 0;
            const adjustedPrice = getAdjustedPrice(listPrice, purchasePrice);
            document.getElementById(`lpbook${book}-discount`).innerText = ((listPrice - adjustedPrice) / listPrice * 100).toFixed(2) + "%";
            totalAdjustedPrice += adjustedPrice;
        });

        document.getElementById('final-price').innerText = totalAdjustedPrice.toFixed(2);
    }
</script>

<?php include 'footer.php'; ?>
