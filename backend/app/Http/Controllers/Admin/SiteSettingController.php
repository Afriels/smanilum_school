<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    use UploadsMedia;

    public function edit(): View
    {
        $settings = SiteSetting::query()->get()->keyBy('key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:180'],
            'site_tagline' => ['required', 'string', 'max:220'],
            'site_description' => ['nullable', 'string'],
            'default_og_image' => ['nullable', 'string', 'max:190'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:120'],
            'facebook_url' => ['nullable', 'string', 'max:190'],
            'instagram_url' => ['nullable', 'string', 'max:190'],
            'youtube_url' => ['nullable', 'string', 'max:190'],
            'student_count' => ['nullable', 'string', 'max:40'],
            'teacher_count' => ['nullable', 'string', 'max:40'],
            'extracurricular_count' => ['nullable', 'string', 'max:40'],
            'graduation_rate' => ['nullable', 'string', 'max:40'],
            'map_embed_url' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'favicon' => ['nullable', 'mimes:png,ico', 'max:1024'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
        ]);

        $settings = SiteSetting::query()->get()->keyBy('key');

        if ($request->boolean('remove_logo')) {
            $this->deletePublicFile($settings['logo']->value ?? null);
            $validated['logo'] = null;
        }

        if ($request->boolean('remove_favicon')) {
            $this->deletePublicFile($settings['favicon']->value ?? null);
            $validated['favicon'] = null;
        }

        if ($request->hasFile('logo')) {
            $this->deletePublicFile($settings['logo']->value ?? null);
            $validated['logo'] = $this->storeImage($request->file('logo'), 'logo');
        } elseif (! array_key_exists('logo', $validated)) {
            unset($validated['logo']);
        }

        if ($request->hasFile('favicon')) {
            $this->deletePublicFile($settings['favicon']->value ?? null);
            $validated['favicon'] = $this->storeFavicon($request);
        } elseif (! array_key_exists('favicon', $validated)) {
            unset($validated['favicon']);
        }

        unset($validated['remove_logo'], $validated['remove_favicon']);

        foreach ($validated as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'group' => $this->resolveGroup($key),
                    'value' => $value,
                    'type' => in_array($key, ['site_description', 'address'], true) ? 'textarea' : (in_array($key, ['logo', 'favicon'], true) ? 'file' : 'text'),
                    'is_public' => true,
                ]
            );
        }

        ActivityLogger::log('settings.updated', 'Pengaturan website diperbarui.');

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan website berhasil diperbarui.');
    }

    protected function storeFavicon(Request $request): ?string
    {
        $file = $request->file('favicon');

        if (! $file) {
            return null;
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = 'favicon-'.strtolower((string) str()->random(10)).'.'.$extension;

        return $file->storeAs('favicon', $filename, 'public');
    }

    protected function resolveGroup(string $key): string
    {
        if (in_array($key, ['address', 'phone', 'email', 'facebook_url', 'instagram_url', 'youtube_url', 'map_embed_url'], true)) {
            return 'contact';
        }

        if (in_array($key, ['logo', 'favicon'], true)) {
            return 'branding';
        }

        return 'identity';
    }
}
