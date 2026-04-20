<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Contracts\View\View;

class ExtracurricularController extends Controller
{
    public function index(): View
    {
        $extracurriculars = Extracurricular::query()
            ->where('status', 'published')
            ->latest()
            ->paginate(8);

        return view('public.extracurriculars.index', compact('extracurriculars') + $this->buildSeo(
            'Ekstrakurikuler',
            'Kegiatan pengembangan minat dan bakat siswa.',
            null,
            'website'
        ));
    }
}
