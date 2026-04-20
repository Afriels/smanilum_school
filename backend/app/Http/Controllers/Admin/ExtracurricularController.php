<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExtracurricularController extends Controller
{
    use UploadsMedia;

    public function index(): View
    {
        return view('admin.extracurriculars.index', [
            'extracurriculars' => Extracurricular::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.extracurriculars.form', ['extracurricular' => new Extracurricular(['status' => 'published'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateExtracurricular($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['cover_image'] = $this->storeImage($request->file('featured_image'), 'extracurriculars');
        $validated['featured_image_path'] = $validated['cover_image'];
        $extracurricular = Extracurricular::query()->create($validated);
        ActivityLogger::log('extracurricular.created', 'Ekstrakurikuler dibuat.', $extracurricular);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dibuat.');
    }

    public function edit(Extracurricular $extracurricular): View
    {
        return view('admin.extracurriculars.form', compact('extracurricular'));
    }

    public function update(Request $request, Extracurricular $extracurricular): RedirectResponse
    {
        $validated = $this->validateExtracurricular($request, $extracurricular);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);

        if ($request->hasFile('featured_image')) {
            $this->deletePublicFile($extracurricular->featured_image_path ?: $extracurricular->cover_image);
            $validated['cover_image'] = $this->storeImage($request->file('featured_image'), 'extracurriculars');
            $validated['featured_image_path'] = $validated['cover_image'];
        }

        $extracurricular->update($validated);
        ActivityLogger::log('extracurricular.updated', 'Ekstrakurikuler diperbarui.', $extracurricular);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $extracurricular): RedirectResponse
    {
        $this->deletePublicFile($extracurricular->featured_image_path ?: $extracurricular->cover_image);
        $extracurricular->delete();
        ActivityLogger::log('extracurricular.deleted', 'Ekstrakurikuler dihapus.');

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    private function validateExtracurricular(Request $request, ?Extracurricular $extracurricular = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:140'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:extracurriculars,slug,'.($extracurricular?->id ?? 'NULL')],
            'summary' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'featured_image' => $this->imageValidationRules(false),
        ]) + [
            'is_featured' => $request->boolean('is_featured'),
        ];
    }
}

