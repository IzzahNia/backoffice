<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .theme-gold { color: #eac14a; }
        .border-theme-gold { border-color: #eac14a !important; }
        .bg-theme-gold { background-color: #eac14a !important; }
        .bg-secondary { background-color: #697e3e !important; }
        .bg-third { background-color: #a3b285 !important; }
    </style>
</head>
<body class="bg-third min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full bg-secondary rounded shadow-2xl p-8 mt-10 text-white">
        <h1 class="text-2xl font-bold mb-6 text-center theme-gold">Application Details</h1>
        <div class="mb-6 space-y-1">
            <div><span class="font-semibold theme-gold">Application ID:</span> <span class="font-mono">{{ $application->id }}</span></div>
            <div><span class="font-semibold theme-gold">Submitted on:</span> <span class="font-mono">{{ $application->created_at->format('d M Y, H:i') }}</span></div>
            <div><span class="font-semibold theme-gold">Status:</span> <span class="font-semibold">{{ ucfirst($application->status) }}</span></div>
        </div>
        <div class="mb-6">
            <div class="text-lg font-bold mb-2 theme-gold">Application Info</div>
            <div><span class="font-semibold theme-gold">Type:</span> {{ ucfirst($application->type) }}</div>
            <div><span class="font-semibold theme-gold">Title:</span> {{ $application->title }}</div>
            <div>
                <span class="font-semibold theme-gold">Description:</span>
                {{ $application->description ? $application->description : '-' }}
            </div>
        </div>
        <div class="bg-white bg-opacity-10 border-l-4 border-theme-gold p-4 rounded">
            <div class="font-semibold mb-2 theme-gold">What happens next:</div>
            <ul class="list-disc pl-5 text-sm">
                <li>Our team will review your application within 3-5 business days.</li>
                <li>You will receive email updates about your application status.</li>
                <li>If approved, you will receive further instructions about orientation.</li>
            </ul>
        </div>
    </div>
</body>
</html>
