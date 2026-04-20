<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(): View
    {
        $page = Page::query()->where('slug', 'kontak')->first();
        $settings = SiteSetting::query()->where('is_public', true)->get()->pluck('value', 'key');

        return view('public.contact', [
            'page' => $page,
            'settings' => $settings,
        ] + $this->buildSeo(
            'Kontak',
            $page?->excerpt ?: ($settings['site_description'] ?? 'Hubungi sekolah untuk informasi lebih lanjut.'),
            $settings['default_og_image'] ?? null,
            'website'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:3000'],
            'company' => ['nullable', 'max:0'],
        ]);

        ContactMessage::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim.');
    }
}
