// Bar Chart
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    // ← بيانات حقيقية من الـ Blade
    labels: typeof chartLabels !== 'undefined' ? chartLabels : [],
    datasets: [{
      label: "Diagnoses",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      // ← بيانات حقيقية من الـ Blade
      data: typeof chartData !== 'undefined' ? chartData : [],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: { left: 10, right: 25, top: 25, bottom: 0 }
    },
    scales: {
      xAxes: [{
        gridLines: { display: false, drawBorder: false },
        ticks: { maxTicksLimit: 12 },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10,
          // ← شيل الـ $ وخليها أرقام بس
          callback: function(value) { return value; }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
        }
      }],
    },
    legend: { display: false },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      callbacks: {
        label: function(tooltipItem, chart) {
          return 'Diagnoses: ' + tooltipItem.yLabel;
        }
      }
    },
  }
});