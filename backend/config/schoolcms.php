<?php

return [
    'media' => [
        'max_file_size_kb' => (int) env('MEDIA_MAX_FILE_SIZE', 5120),
        'allowed_image_mimes' => explode(',', (string) env('MEDIA_ALLOWED_IMAGE_MIMES', 'image/jpeg,image/png,image/webp')),
        'allowed_document_mimes' => explode(',', (string) env('MEDIA_ALLOWED_DOCUMENT_MIMES', 'application/pdf')),
    ],
    'site' => [
        'frontend_url' => env('FRONTEND_URL'),
        'backend_public_url' => env('APP_URL'),
    ],
];

