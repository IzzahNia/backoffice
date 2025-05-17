<?php
namespace App\Http\Controllers;

use App\Models\Application;

class ApplicationDetailsController extends Controller
{
    public function show(Application $application)
    {
        return view('application.details', compact('application'));
    }
}
