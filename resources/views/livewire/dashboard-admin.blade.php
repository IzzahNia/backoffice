<div class="grid grid-cols-6 gap-6">
    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl max-w-md w-full">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Pending Applications</h2>
                    <p class="text-sm text-gray-500">Applications awaiting your review</p>
                </div>
                <span class="inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded-full">
                    {{ count($pendingReviews) }}
                </span>
            </div>

            <ul class="mt-4 space-y-4 min-h-80 max-h-80 overflow-y-auto">
                @forelse ($pendingReviews as $review)
                    <li class="p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-700">{{ $review->title }} <span class="text-sm text-gray-500">by {{ $review->user->name }}</span></p>
                                <p class="text-xs text-gray-400">Submitted on {{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                            {{-- <a href="{{ route('review') }}" class="text-blue-500 hover:underline text-sm">Review</a> --}}
                        </div>
                    </li>
                @empty
                    <li class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-center text-gray-500">No pending applications</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Users Role Distribution</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="userRolesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-span-6 lg:col-span-3">
    <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Application Status Distribution</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="applicationStatusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-span-6 lg:col-span-3">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Application Form Type Distribution</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="applicationTypeChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-span-6">
        <div class="p-4 bg-white shadow rounded-xl">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Total Applications by Month ({{ now()->year }})</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="applicationsByMonthChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const users = document.getElementById('userRolesChart');
  new Chart(users, {
    type: 'pie',
    data: {
      labels: {!! json_encode(array_keys($userRoleCounts)) !!},
      datasets: [{
        label: '# of Users',
        data: {!! json_encode(array_values($userRoleCounts)) !!},
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

  const applicationStatus = document.getElementById('applicationStatusChart');
  new Chart(applicationStatus, {
    type: 'pie',
    data: {
      labels: {!! json_encode(array_keys($applicationStatusCounts)) !!},
      datasets: [{
        label: '# of Applications',
        data: {!! json_encode(array_values($applicationStatusCounts)) !!},
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

  // Applications by Month Line Chart
  const applicationsByMonthCtx = document.getElementById('applicationsByMonthChart').getContext('2d');
  new Chart(applicationsByMonthCtx, {
    type: 'line',
    data: {
      labels: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      ],
      datasets: [{
        label: 'Applications',
        data: [
          @for ($i = 1; $i <= 12; $i++)
            {{ $applicationsByMonth[$i] ?? 0 }}{{ $i < 12 ? ',' : '' }}
          @endfor
        ],
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
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

  // Application Form Type Pie Chart
  const applicationType = document.getElementById('applicationTypeChart');
  new Chart(applicationType, {
    type: 'pie',
    data: {
      labels: {!! json_encode(array_keys($applicationTypeCounts)) !!},
      datasets: [{
        label: '# of Applications',
        data: {!! json_encode(array_values($applicationTypeCounts)) !!},
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
