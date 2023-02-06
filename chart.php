<script>
const ctx = document.getElementById("barchart");

Chart.defaults.color = "#bfbfbf";

const labels = <?php echo json_encode($month) ?>;
const data1 = <?php echo json_encode($sales) ?>;
const data2 = <?php echo json_encode($revenue) ?>;

new Chart(ctx, {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Sales",
        data: data1,
        borderWidth: 1,
        borderRadius: 5,
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
      },
      {
        label: "Revenue",
        data: data2,
        borderWidth: 1,
        borderRadius: 5,
        backgroundColor: "rgba(255, 99, 132, 0.2)",
        borderColor: "rgba(255,99,132,1)",
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
</script>

<script>

const Hbarchart = document.getElementById("Hbarchart");

const products = <?php echo json_encode($products) ?>;
const qty = <?php echo json_encode($quantity) ?>;

Chart.defaults.color = "#bfbfbf";

new Chart(Hbarchart, {
  type: "bar",
  data: {
    labels: products,
    datasets: [
      {
        label: "Total Quantity",
        data: qty,
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
    responsive: true,
    maintainAspectRatio: false,
    indexAxis: "y",
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

</script>

<script>
const p = document.getElementById("pieChart");

const category = <?php echo json_encode($category) ?>;
const catqty = <?php echo json_encode($catqty) ?>;

new Chart(p, {
  type: "doughnut",
  data: {
    labels: category,
    datasets: [
      {
        label: "Categorywise Foods Sales",
        data: catqty,
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
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const pa = document.getElementById("polararea");
const gandc = <?php echo json_encode($gandc) ?>;

new Chart(pa, {
  type: "polarArea",
  data: {
    labels: ["Customer", "Guest"],
    datasets: [
      {
        label: "Numbers of Customers",
        data: gandc,
        borderWidth: 1,
        backgroundColor: ["rgba(54, 162, 235, 0.2)", "rgba(255, 99, 132, 0.2)"],
        borderColor: ["rgba(54, 162, 235, 1)", "rgba(255,99,132,1)"],
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
</script>