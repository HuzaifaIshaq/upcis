<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My App</title>

  <!-- Bootstrap 5 CSS (required for offcanvas + styling) -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  >
</head>
<body>

  <!-- Include the Sidebar Offcanvas -->
  <?php include 'sidebar.php'; ?>

  <!-- Your Page Content -->
  <div class="container mt-4">
    <h1>My Main Content</h1>
    <p>
      If everything is correct, click the <strong>hamburger button</strong> (top-left) 
      to open the offcanvas sidebar.
    </p>
  </div>

  <!-- Bootstrap 5 JS Bundle (Popper + Bootstrap) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
