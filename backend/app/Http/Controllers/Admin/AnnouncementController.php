<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Support\ActivityLogger;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        return view('admin.announcements.index', [
            'announcements' => Announcement::query()->latest('event_date')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.announcements.form', ['announcement' => new Announcement(['status' => 'published'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAnnouncement($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $announcement = Announcement::query()->create($validated);
        ActivityLogger::log('announcement.created', 'Pengumuman dibuat.', $announcement);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.form', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $this->validateAnnouncement($request, $announcement);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $announcement->update($validated);
        ActivityLogger::log('announcement.updated', 'Pengumuman diperbarui.', $announcement);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();
        ActivityLogger::log('announcement.deleted', 'Pengumuman dihapus.');

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function validateAnnouncement(Request $request, ?Announcement $announcement = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:announcements,slug,'.($announcement?->id ?? 'NULL')],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'event_date' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published,archived'],
        ]) + [
            'is_featured' => $request->boolean('is_featured'),
        ];
    }
}

