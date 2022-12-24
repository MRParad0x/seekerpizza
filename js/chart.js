const ctx = document.getElementById("barchart");

Chart.defaults.color = "#bfbfbf";

new Chart(ctx, {
  type: "bar",
  data: {
    labels: [
      "Jan",
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
    datasets: [
      {
        label: "Sales",
        data: [23, 66, 38, 92, 99, 69, 46, 85, 61, 5, 57, 89],
        borderWidth: 1,
        borderRadius: 5,
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
      },
      {
        label: "Revenue",
        data: [52, 3, 92, 89, 99, 93, 43, 61, 8, 25, 34, 72],
        borderWidth: 1,
        borderRadius: 5,
        backgroundColor: "rgba(255, 99, 132, 0.2)",
        borderColor: "rgba(255,99,132,1)",
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const p = document.getElementById("pieChart");

new Chart(p, {
  type: "doughnut",
  data: {
    labels: ["Pasta", "Pizza", "Dessert", "Beverage"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3, 5],
        borderWidth: 1,
        backgroundColor: [
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 99, 132, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
        ],
        borderColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(255,99,132,1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
        ],
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const pa = document.getElementById("polararea");

new Chart(pa, {
  type: "polarArea",
  data: {
    labels: ["Red", "Blue", "Yellow", "Green"],
    datasets: [
      {
        label: "# of Votes",
        data: [12, 19, 3, 5],
        borderWidth: 1,
        backgroundColor: [
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 99, 132, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
        ],
        borderColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(255,99,132,1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
        ],
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const Hbarchart = document.getElementById("Hbarchart");

Chart.defaults.color = "#bfbfbf";

new Chart(Hbarchart, {
  type: "bar",
  data: {
    labels: [
      "Mix Pizza",
      "Chicken Pizza",
      "Cheese Parata",
      "Vanila Ice Cream",
      "Ice Coffe",
    ],
    datasets: [
      {
        label: "Total Quantity",
        data: [23, 66, 38, 92, 77],
        borderWidth: 1,
        borderRadius: 5,
        backgroundColor: [
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 99, 132, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(255, 159, 64, 0.2)",
        ],
        borderColor: [
          "rgba(54, 162, 235, 1)",
          "rgba(255,99,132,1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        barPercentage: 0.8,
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    indexAxis: "y",
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
