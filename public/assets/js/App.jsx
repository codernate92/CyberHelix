import React from 'react';
import ReactDOM from 'react-dom';
import { Bar, Pie } from 'react-chartjs-2';
import { Chart, registerables } from 'chart.js';
import mapboxgl from 'mapbox-gl';

Chart.register(...registerables);

// Use your real Mapbox access token here
mapboxgl.accessToken = 'pk.eyJ1IjoibmF0aGFuaGVhdGg5MiIsImEiOiJjbTlmeWVqa2oxczY0Mm1vZXl0bHVueWlnIn0.p3tGikzWDY_coPg2e-vUPw';

// Component that renders the Mapbox map with markers and a legend.
class ThreatMap extends React.Component {
  constructor(props) {
    super(props);
    this.mapContainer = React.createRef();
    // Mock threat data for the top 10 state actor APTs in Europe.
    this.state = {
      threats: [
        { name: 'APT1', actor: 'Russia', coordinates: [30.3351, 59.9343] },      // St. Petersburg
        { name: 'APT2', actor: 'Russia', coordinates: [37.6173, 55.7558] },      // Moscow
        { name: 'APT3', actor: 'China',  coordinates: [2.3522, 48.8566] },       // Paris
        { name: 'APT4', actor: 'Iran',   coordinates: [16.3738, 48.2082] },      // Vienna
        { name: 'APT5', actor: 'North Korea', coordinates: [13.4050, 52.5200] },  // Berlin
        { name: 'APT6', actor: 'North Korea', coordinates: [4.9041, 52.3676] },   // Amsterdam
        { name: 'APT7', actor: 'China',  coordinates: [2.1734, 41.3851] },       // Barcelona
        { name: 'APT8', actor: 'Russia', coordinates: [24.7536, 59.4369] },       // Tallinn
        { name: 'APT9', actor: 'Iran',   coordinates: [18.0686, 59.3293] },       // Stockholm
        { name: 'APT10', actor: 'North Korea', coordinates: [21.0122, 52.2297] }  // Warsaw
      ]
    };
  }

  componentDidMount() {
    this.map = new mapboxgl.Map({
      container: this.mapContainer.current,
      style: 'mapbox://styles/mapbox/dark-v10',
      center: [15, 50],
      zoom: 3
    });

    // Add markers for each threat.
    this.state.threats.forEach(threat => {
      new mapboxgl.Marker({ color: 'red' })
        .setLngLat(threat.coordinates)
        .setPopup(
          new mapboxgl.Popup({ offset: 25 }).setHTML(
            `<h3>${threat.name}</h3><p>Actor: ${threat.actor}</p>`
          )
        )
        .addTo(this.map);
    });
  }

  render() {
    return (
      <div style={{ position: 'relative' }}>
        <div ref={this.mapContainer} style={{ width: '100%', height: '400px' }}></div>
        {/* Legend Overlay */}
        <div style={{
          position: 'absolute',
          bottom: '10px',
          right: '10px',
          backgroundColor: 'rgba(0,0,0,0.6)',
          color: '#fff',
          padding: '10px',
          borderRadius: '5px'
        }}>
          <h5>Threat Legend</h5>
          <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            <li>
              <span style={{
                display: 'inline-block',
                width: '12px',
                height: '12px',
                backgroundColor: 'red',
                marginRight: '5px'
              }}></span>
              APT Threat
            </li>
          </ul>
        </div>
      </div>
    );
  }
}

// Component that renders the charts (Bar and Pie) in a constrained container.
class ThreatCharts extends React.Component {
  render() {
    const barData = {
      labels: ['CPU', 'Memory', 'Disk'],
      datasets: [{
        label: 'System Usage',
        data: [35, 62, 78],
        backgroundColor: [
          'rgba(255,0,204,0.6)',
          'rgba(51,51,255,0.6)',
          'rgba(0,204,255,0.6)'
        ]
      }]
    };

    const pieData = {
      labels: ['Intrusions', 'Alerts', 'Scans'],
      datasets: [{
        data: [15, 10, 5],
        backgroundColor: [
          'rgba(255,99,132,0.6)',
          'rgba(54,162,235,0.6)',
          'rgba(255,206,86,0.6)'
        ]
      }]
    };

    return (
      <div style={{ maxWidth: '600px', margin: '0 auto' }}>
        <div style={{ marginBottom: '40px', height: '300px' }}>
          <h2 style={{ textAlign: 'center' }}>System Usage (Bar Chart)</h2>
          <Bar data={barData} options={{ responsive: true, maintainAspectRatio: false }} />
        </div>
        <div style={{ height: '300px' }}>
          <h2 style={{ textAlign: 'center' }}>Activity Overview (Pie Chart)</h2>
          <Pie data={pieData} options={{ responsive: true, maintainAspectRatio: false }} />
        </div>
      </div>
    );
  }
}

ReactDOM.render(<ThreatMap />, document.getElementById('react-map'));
ReactDOM.render(<ThreatCharts />, document.getElementById('react-charts'));