<?php
namespace NathanHeath\SecurityDashboard;

require __DIR__ . '/../vendor/autoload.php';

class SecurityDashboard
{
    private $data;

    public function __construct()
    {
        // Simulate an expanded dataset with many more metrics
        $this->data = [
            'status' => 'OK',
            'lastScan' => date('Y-m-d H:i:s'),
            'alerts' => 5,
            'threatLevel' => 'Low',
            'networkIntrusions' => 0,
            'vulnerabilities' => 2,
            'malwareDetections' => 1,
            'anomalyScore' => 0.23,
            'splunkData' => $this->getSplunkData(),
            'mispData' => $this->getMispData(),
            'recordedFutureData' => $this->getRecordedFutureData(),
            'firewallEvents' => 12,
            'accessLogs' => 34,
            'systemHealth' => 'Good',
            // Expanded metrics (simulate 40+ items)
            'cpuUsage' => '35%',
            'memoryUsage' => '62%',
            'diskUsage' => '78%',
            'ioLatency' => '15ms',
            'uptime' => '14 days',
            'intrusionAttempts' => 3,
            'phishingEmails' => 8,
            'ddosAttempts' => 0,
            'portScans' => 27,
            'unauthorizedAccess' => 2,
            'dataLeakAlerts' => 1,
            'antivirusStatus' => 'Up-to-date',
            'patchLevel' => 'Level 5',
            'vpnConnections' => 9,
            'remoteCodeExec' => 0,
            'sqlInjectionAttempts' => 4,
            'xssAttempts' => 6,
            'ransomwareAlerts' => 0,
            'botnetTraffic' => 'Low',
            'failedLogins' => 12,
            'successfulLogins' => 98,
            'suspiciousProcesses' => 3,
            'configurationDrifts' => 1,
            'complianceScore' => '95%',
            'backupStatus' => 'Healthy',
            'encryptionStatus' => 'Enabled',
            'protocolViolations' => 2,
            'vpnAnomalies' => 0,
            'apiAbuse' => 1,
            'resourceOverloads' => 0,
            'userBehaviorAnomalies' => 4,
            'firewallRuleViolations' => 1,
            'geoIPMismatches' => 5,
            'dataExfiltrationAlerts' => 0,
            'cloudSecurityEvents' => 7,
        ];
    }

    public function getStatus() { return $this->data['status']; }
    public function getLastScanTime() { return $this->data['lastScan']; }
    public function getAlertsCount() { return $this->data['alerts']; }
    public function getSplunkData() { return 'Splunk events: 120'; }
    public function getMispData() { return 'MISP indicators: 45'; }
    public function getRecordedFutureData() { return 'Recorded Future risk score: 67'; }

    // Generates a card given a title and value
    private function generateCard($title, $value)
    {
        return "<div class=\"col-md-4 col-sm-6 mb-4\">
                  <div class=\"card cyber-card\">
                    <div class=\"card-body\">
                      <h2 class=\"card-title\">{$title}</h2>
                      <p class=\"card-text value\">{$value}</p>
                    </div>
                  </div>
                </div>";
    }

    public function renderDashboard()
    {
        $cards = '';
        // Fixed key metrics
        $fixedMetrics = [
          'Status' => $this->getStatus(),
          'Last Scan' => $this->getLastScanTime(),
          'Alerts' => $this->getAlertsCount(),
          'Threat Level' => $this->data['threatLevel'],
          'Network Intrusions' => $this->data['networkIntrusions'],
          'Vulnerabilities' => $this->data['vulnerabilities'],
          'Malware Detections' => $this->data['malwareDetections'],
          'Anomaly Score' => $this->data['anomalyScore'],
          'Splunk Data' => $this->data['splunkData'],
          'MISP Data' => $this->data['mispData'],
          'Recorded Future' => $this->data['recordedFutureData'],
        ];
        foreach ($fixedMetrics as $title => $value) {
            $cards .= $this->generateCard($title, $value);
        }

        // Expanded metrics
        foreach ($this->data as $key => $value) {
            if (in_array($key, ['status', 'lastScan', 'alerts', 'threatLevel', 'networkIntrusions',
                                 'vulnerabilities', 'malwareDetections', 'anomalyScore', 'splunkData',
                                 'mispData', 'recordedFutureData'])) {
                continue;
            }
            $title = ucwords(str_replace(['_', 'Data'], [' ', ''], $key));
            $cards .= $this->generateCard($title, $value);
        }

        echo "<div class=\"dashboard-container\">
                <h2 class=\"mb-4\">PHP Security Dashboard</h2>
                <div class=\"row\">{$cards}</div>
              </div>";
    }
}
