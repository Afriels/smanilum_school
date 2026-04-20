<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'stats' => [
                'users' => User::count(),
                'published_posts' => Post::query()->where('status', 'published')->count(),
                'draft_posts' => Post::query()->where('status', 'draft')->count(),
                'site_settings' => SiteSetting::count(),
            ],
            'recent_audits' => AuditLog::query()
                ->latest()
                ->limit(10)
                ->get(['event', 'description', 'created_at']),
        ]);
    }
}

