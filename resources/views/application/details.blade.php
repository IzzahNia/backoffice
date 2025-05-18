<!-- filepath: /Users/moafif/Development/FYP/backoffice/resources/views/application/details.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .theme-primary { color: #eac14a; }
        .theme-secondary { color: black; }
        .border-theme-primary { border: 3px solid #eac14a !important; }
        .border-theme-secondary { border: 3px solid black !important; }
        .bg-theme-primary { background-color: #eac14a !important; }
        .bg-theme-secondary { background-color: #697e3e !important; }
        .bg-theme-third { background-color: #f6ff8b !important; }
        .bg-theme-four { background-color: white !important; }
        .bg-theme-five { background-color: black !important; }
        .header-bg {
            background-image: url('https://images.unsplash.com/photo-1661260101232-bd47a10035b8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-theme-four min-h-screen flex flex-col">
    <!-- Header with background image -->
    <header class="header-bg h-40 flex items-center justify-center shadow-lg relative">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Application Details</h1>
        </div>
    </header>
    <div class="flex-1 flex items-center justify-center">
        <div class="max-w-lg w-full bg-theme-four border-theme-secondary rounded shadow-2xl p-8 mt-10 text-white">
            <h2 class="text-2xl font-bold mb-6 text-center theme-secondary">Application Details</h2>
            <div class="mb-6 space-y-1">
                <div><span class="font-semibold theme-secondary">Application ID:</span> <span class="font-mono theme-secondary">{{ $application->id }}</span></div>
                <div><span class="font-semibold theme-secondary">Submitted on:</span> <span class="font-mono theme-secondary">{{ $application->created_at->format('d M Y, H:i') }}</span></div>
                <div><span class="font-semibold theme-secondary">Status:</span> <span class="font-semibold theme-primary">{{ ucfirst($application->status) }}</span></div>
            </div>
            <div class="mb-6">
                <div class="text-lg font-bold mb-2 theme-secondary">Application Info</div>
                <div><span class="font-semibold theme-secondary">Type:</span> <span class="theme-secondary">{{ ucfirst($application->type) }}</span></div>
                <div><span class="font-semibold theme-secondary">Title:</span> <span class="theme-secondary">{{ $application->title }}</span></div>
                <div><span class="font-semibold theme-secondary">Description:</span> <span class="theme-secondary">{{ $application->description ?: '-' }}</span></div>
            </div>
            <div class="bg-white bg-opacity-10 border-l-4 border-theme-secondary p-4 rounded">
                <div class="font-semibold mb-2 theme-secondary">What happens next:</div>
                <ul class="list-disc pl-5 text-sm theme-secondary">
                    <li>Our team will review your application within 3-5 business days.</li>
                    <li>You will receive email updates about your application status.</li>
                    <li>If approved, you will receive further instructions about orientation.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
