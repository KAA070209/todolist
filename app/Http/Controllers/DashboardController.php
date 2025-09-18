<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $usersByRole = Role::withCount('users')->get();
        $latestUsers = User::with('role')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', [
            'totalUsers' => $totalUsers,
            'usersByRole' => $usersByRole,
            'latestUsers' => $latestUsers
        ]);
    }
}
