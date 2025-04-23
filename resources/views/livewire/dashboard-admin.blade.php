<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl max-w-md w-full">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Pending Applications</h2>
                    <p class="text-sm text-gray-500">Applications awaiting your review</p>
                </div>
                <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded-full">
                    5
                </span>
            </div>

            <ul class="mt-4 space-y-4 min-h-80 max-h-80 overflow-y-auto">
                <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-700">John Doe</p>
                            <p class="text-xs text-gray-400">Submitted on Apr 18, 2025</p>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Review</a>
                    </div>
                </li>
                <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-700">Jane Smith</p>
                            <p class="text-xs text-gray-400">Submitted on Apr 17, 2025</p>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Review</a>
                    </div>
                </li>
                <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-700">Michael Tan</p>
                            <p class="text-xs text-gray-400">Submitted on Apr 16, 2025</p>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Review</a>
                    </div>
                </li>
                <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-700">Aisha Rahman</p>
                            <p class="text-xs text-gray-400">Submitted on Apr 15, 2025</p>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Review</a>
                    </div>
                </li>
                <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-700">Lucas Wong</p>
                            <p class="text-xs text-gray-400">Submitted on Apr 14, 2025</p>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Review</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Vendor Category Distribution</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Weekly Attendance</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>
    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Weekly Attendance</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
    const ctx3 = document.getElementById('myChart3').getContext('2d');

    new Chart(ctx3, {
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
        datasets: [
          {
            label: 'Dataset 1', // Label for the first line
            data: [12, 19, 3, 5, 2, 3], // Data points for the first line
            borderColor: 'rgba(255, 99, 132, 1)', // Line color
            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Fill color (optional)
            borderWidth: 2, // Line thickness
          },
          {
            label: 'Dataset 2', // Label for the second line
            data: [8, 15, 6, 10, 4, 7], // Data points for the second line
            borderColor: 'rgba(54, 162, 235, 1)', // Line color
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Fill color (optional)
            borderWidth: 2, // Line thickness
          },
          {
            label: 'Dataset 3', // Label for the third line
            data: [5, 10, 15, 20, 25, 30], // Data points for the third line
            borderColor: 'rgba(75, 192, 192, 1)', // Line color
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Fill color (optional)
            borderWidth: 2, // Line thickness
          },
          {
            label: 'Dataset 4', // Label for the fourth line
            data: [20, 18, 16, 14, 12, 10], // Data points for the fourth line
            borderColor: 'rgba(153, 102, 255, 1)', // Line color
            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Fill color (optional)
            borderWidth: 2, // Line thickness
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true, // Y-axis starts at zero
          },
        },
      },
    });
  </script>
