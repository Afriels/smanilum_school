<?php

namespace App\Support;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $event, string $description, ?Model $subject = null, array $meta = []): void
    {
        AuditLog::query()->create([
            'user_id' => Auth::id(),
            'event' => $event,
            'description' => $description,
            'subject_type' => $subject ? $subject::class : null,
            'subject_id' => $subject?->getKey(),
            'ip_address' => request()->ip(),
            'user_agent' => (string) request()->userAgent(),
            'meta' => $meta ?: null,
        ]);
    }
}

