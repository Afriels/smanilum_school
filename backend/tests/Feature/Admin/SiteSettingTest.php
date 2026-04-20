<?php

namespace Tests\Feature\Admin;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SiteSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_site_setting_helper_returns_saved_value(): void
    {
        SiteSetting::query()->create([
            'group' => 'branding',
            'key' => 'logo',
            'value' => 'logo/sample-logo.png',
            'type' => 'file',
            'is_public' => true,
        ]);

        $this->assertSame('logo/sample-logo.png', SiteSetting::getValue('logo'));
        $this->assertSame('fallback', SiteSetting::getValue('unknown_key', 'fallback'));
    }

    public function test_admin_setting_routes_are_registered(): void
    {
        $this->assertTrue(Route::has('admin.settings.edit'));
        $this->assertTrue(Route::has('admin.settings.update'));
        $this->assertTrue(Route::has('admin.settings.update.post'));
    }

    public function test_branding_fallback_assets_exist(): void
    {
        $this->assertFileExists(public_path('images/logo-default.svg'));
        $this->assertFileExists(public_path('images/favicon.ico'));
    }
}
