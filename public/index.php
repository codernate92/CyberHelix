<?php
require __DIR__ . '/../vendor/autoload.php';
use NathanHeath\SecurityDashboard\SecurityDashboard;

$dashboard = new SecurityDashboard();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cyberpunk Security Dashboard</title>
  <!-- Mapbox CSS -->
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="/assets/style.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
  <style>
    /* Additional inline styling for demo purposes */
    body { padding-top: 70px; }
  </style>
</head>
<body>
  <!-- Fixed Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Cyber Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
              aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#php-dashboard">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#react-map">Map</a></li>
          <li class="nav-item"><a class="nav-link" href="#react-charts">Charts</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="text-center my-4">
    <img src="/assets/logo.svg" alt="Cyberhelix Logo" class="logo">
  </div>

  <div class="container py-4">
    <!-- PHP-Rendered Dashboard -->
    <div id="php-dashboard" class="mb-5">
      <?php $dashboard->renderDashboard(); ?>
    </div>

    <!-- React Map Section -->
    <div id="react-map" class="mb-5"></div>

    <!-- React Charts Section -->
    <div id="react-charts" class="mb-5"></div>
  </div>

  <!-- Load React libraries -->
  <script src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Load the React bundle -->
  <script src="/assets/js/bundle.js"></script>
</body>
</html>
