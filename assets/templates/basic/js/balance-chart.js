

"use strict";


var options = {
  series: [
    {
      name: "Investment",

      data: [44, 1, 57, 56, 61, 58, 63, 60, 66, 77, 100, 100],

    },
    {
      name: "Revenue",
      data: [76, 1, 101, 98, 87, 105, 91, 114, 94, 98, 100, 100],
    },
  ],
  chart: {
    type: "bar",
    height: 350,
    toolbar: {
      show: false,
    },
    foreColor: '#fff',
    options: {
      colors: ['white', 'red']
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: [
      "jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
  fill: {
    opacity: 1,
    colors: ['#5a6791', '#f01313']
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "$ " + val + " thousands";
      },
    },
    theme: "dark",
  },
  grid: {
    show: false,
  },
  legend: {
    markers: {
      fillColors: ['#5a6791', '#f01313']
    }
  }
};
let balanceChart = document.querySelector("#chart");
if (balanceChart) {
  var chart = new ApexCharts(balanceChart, options);
  chart.render();
}
