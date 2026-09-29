<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicArea;
use App\Models\Career;
use App\Models\Institution;
use App\Models\Question;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'areas' => AcademicArea::count(),
                'careers' => Career::count(),
                'institutions' => Institution::count(),
                'questions' => Question::count(),
                'users' => User::count(),
            ],
        ]);
    }
}
