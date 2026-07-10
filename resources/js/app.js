import "./bootstrap";
// Import Chart.js globally so your Blade components can see it
import Chart from "chart.js/auto";
window.Chart = Chart;

// Import and start Alpine.js
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
