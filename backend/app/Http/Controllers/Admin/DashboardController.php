<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AuditLog;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'posts' => Post::count(),
                'featured_posts' => Post::query()->where('show_in_slider', true)->count(),
                'galleries' => Gallery::count(),
                'announcements' => Announcement::count(),
                'banners' => Banner::count(),
                'users' => User::count(),
            ],
            'recentAudits' => AuditLog::query()->with('user')->latest()->take(10)->get(),
            'recentPosts' => Post::query()->latest()->take(5)->get(),
        ]);
    }
}

