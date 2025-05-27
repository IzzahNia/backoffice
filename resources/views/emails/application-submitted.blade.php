<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Submitted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
</head>
<body class="bg-theme-four" style="font-family: sans-serif; margin:0; padding:0;">
    <div style="max-width:600px;margin:40px auto;background:#fff;border-radius:12px;box-shadow:0 4px 24px #0002;padding:32px;">
        <h2 class="theme-secondary" style="font-size:2em;font-weight:bold;margin-bottom:16px;">Application Submitted</h2>
        <p class="theme-secondary">Thank you for your submission!</p>
        <p class="theme-secondary"><strong>Title:</strong> {{ $application->title }}</p>
        <p class="theme-secondary"><strong>Description:</strong> {{ $application->description }}</p>
        <p class="theme-secondary"><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
        <p class="theme-secondary"><strong>Type:</strong> {{ ucfirst($application->type) }}</p>

        {{-- @if(isset($application->data['form']) && is_array($application->data['form']))
            <h4 class="theme-secondary" style="margin-top:24px;">Form Details:</h4>
            <ul style="padding-left:20px;">
                @foreach($application->data['form'] as $key => $value)
                    <li class="theme-secondary">
                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                        @if(is_array($value))
                            {{ implode(', ', $value) }}
                        @else
                            {{ $value }}
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif --}}

        <div class="bg-white bg-opacity-10 border-l-4 border-theme-secondary p-4 rounded" style="background:#fff3;border-left:4px solid #222;padding:16px;border-radius:8px;margin-top:24px;">
            <div class="font-semibold mb-2 theme-secondary" style="font-weight:bold;margin-bottom:8px;color:#222;">What happens next:</div>
            <ul class="list-disc pl-5 text-sm theme-secondary" style="padding-left:20px;font-size:0.95em;color:#222;">
                <li>Our team will review your application within 3-5 business days.</li>
                <li>You will receive email updates about your application status.</li>
                <li>If approved, you will receive further instructions about orientation.</li>
            </ul>
        </div>
    </div>
</body>
</html>
