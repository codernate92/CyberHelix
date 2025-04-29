<?php
require __DIR__ . '/../vendor/autoload.php';

use NathanHeath\SecurityDashboard\SecurityDashboard;

header('Content-Type: application/json');

$dashboard = new SecurityDashboard();

echo json_encode([
    'status'    => $dashboard->getStatus(),
    'lastScan'  => $dashboard->getLastScanTime(),
    'alerts'    => $dashboard->getAlertsCount(),
]);