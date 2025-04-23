<div class="grid grid-cols-6 gap-6">
    <div class="col-span-3">
        <div class="p-4 bg-white shadow rounded-xl max-w-md w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                <a href="#" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>

            <ul class="space-y-4 min-h-80 max-h-80 overflow-y-auto">
                <li class="flex items-start space-x-3">
                    <div class="bg-green-100 text-green-600 p-2 rounded-full">
                        <!-- icon (e.g., update) -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582M20 20v-5h-.582M4 20l16-16" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            Your application was approved.
                            <a href="#" class="text-blue-600 hover:underline">Learn more</a>
                        </p>
                        <span class="text-xs text-gray-400">Yesterday</span>
                    </div>
                </li>

                <li class="flex items-start space-x-3">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                        <!-- icon (e.g., pending review) -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 6a9 9 0 110 18 9 9 0 010-18z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            Your application is <span class="font-medium">Under Review</span>.
                            <a href="#" class="text-blue-600 hover:underline">Learn more</a>
                        </p>
                        <span class="text-xs text-gray-400">Apr 20, 2025</span>
                    </div>
                </li>

                <li class="flex items-start space-x-3">
                    <div class="bg-red-100 text-red-600 p-2 rounded-full">
                        <!-- icon (e.g., alert) -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">
                            Your Application link was rejected.
                            <a href="#" class="text-blue-600 hover:underline">Learn more</a>
                        </p>
                        <span class="text-xs text-gray-400">Apr 18, 2025</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-span-3">
        <div class="p-4 bg-white shadow rounded-xl max-w-md w-full">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Incoming Events</h2>
                <a href="#" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>

            <ul class="space-y-4 min-h-80 max-h-80 overflow-y-auto">
                <li class="flex items-start space-x-3">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <!-- calendar icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Team Meeting with Marketing Dept.</p>
                        <span class="text-xs text-gray-400">Today at 3:00 PM</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-span-6">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Application Status Overview</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="applicationChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('applicationChart');

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Approved', 'Rejected', 'Pending'],
        datasets: [{
          label: 'Applications',
          data: [10, 5, 15],
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
