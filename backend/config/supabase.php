<?php

$supabaseUrl = rtrim((string) env('SUPABASE_URL', ''), '/');

return [
    'url' => $supabaseUrl,
    'anon_key' => env('SUPABASE_ANON_KEY'),
    'secret_key' => env('SUPABASE_SECRET_KEY'),
    'storage' => [
        'api_url' => $supabaseUrl !== '' ? $supabaseUrl.'/storage/v1' : null,
        'public_url' => $supabaseUrl !== '' ? $supabaseUrl.'/storage/v1/object/public' : null,
        'cache_control' => env('SUPABASE_STORAGE_CACHE_CONTROL', '3600'),
        'timeout' => (int) env('SUPABASE_STORAGE_TIMEOUT', 30),
    ],
    'buckets' => [
        'logos' => env('SUPABASE_BUCKET_LOGOS', 'logos'),
        'favicons' => env('SUPABASE_BUCKET_FAVICONS', 'favicons'),
        'posts' => env('SUPABASE_BUCKET_POSTS', 'posts'),
        'galleries' => env('SUPABASE_BUCKET_GALLERIES', 'galleries'),
        'banners' => env('SUPABASE_BUCKET_BANNERS', 'banners'),
    ],
];
