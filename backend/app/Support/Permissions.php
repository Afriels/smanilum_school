<?php

namespace App\Support;

class Permissions
{
    public const SUPER_ADMIN = 'super-admin';
    public const CONTENT_ADMIN = 'content-admin';
    public const EDITOR = 'editor';
    public const VIEWER = 'viewer';

    public static function adminRoles(): array
    {
        return [
            self::SUPER_ADMIN,
            self::CONTENT_ADMIN,
            self::EDITOR,
            self::VIEWER,
        ];
    }
}

