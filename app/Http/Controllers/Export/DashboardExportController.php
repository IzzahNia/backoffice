<?php
namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardExportController extends Controller
{
    public function export()
    {
        $userRoleCounts = User::select('role')
            ->selectRaw('count(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        $applicationStatusCounts = Application::select('status')
            ->selectRaw('count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $applicationTypeCounts = Application::select('type')
            ->selectRaw('count(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        $applicationsByMonth = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $response = new StreamedResponse(function () use (
            $userRoleCounts, $applicationStatusCounts, $applicationTypeCounts, $applicationsByMonth
        ) {
            $handle = fopen('php://output', 'w');

            // User Roles
            fputcsv($handle, ['User Role', 'Count']);
            foreach ($userRoleCounts as $role => $count) {
                fputcsv($handle, [$role, $count]);
            }
            fputcsv($handle, []); // Empty row

            // Application Status
            fputcsv($handle, ['Application Status', 'Count']);
            foreach ($applicationStatusCounts as $status => $count) {
                fputcsv($handle, [$status, $count]);
            }
            fputcsv($handle, []);

            // Application Type
            fputcsv($handle, ['Application Type', 'Count']);
            foreach ($applicationTypeCounts as $type => $count) {
                fputcsv($handle, [$type, $count]);
            }
            fputcsv($handle, []);

            // Applications by Month
            fputcsv($handle, ['Month', 'Applications']);
            foreach (range(1, 12) as $month) {
                fputcsv($handle, [date('M', mktime(0, 0, 0, $month, 10)), $applicationsByMonth[$month] ?? 0]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="dashboard-data.csv"');

        return $response;
    }
}
