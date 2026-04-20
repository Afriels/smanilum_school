<?php

namespace App\Support;

use App\Services\SupabaseStorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadsMedia
{
    protected function storeImage(?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return null;
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename .= '-'.Str::lower(Str::random(8)).'.'.$file->getClientOriginalExtension();

        return $file->storeAs($directory, $filename, 'public');
    }

    protected function storeSupabaseMedia(?UploadedFile $file, string $bucketKey, string $directory = ''): ?string
    {
        if (! $file) {
            return null;
        }

        $storage = app(SupabaseStorageService::class);

        if (! $storage->isConfigured()) {
            return $this->storeImage($file, trim($directory, '/') !== '' ? trim($directory, '/') : $bucketKey);
        }

        return $storage->upload($file, $bucketKey, $directory);
    }

    protected function deletePublicFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        $storage = app(SupabaseStorageService::class);
        $remoteFile = $storage->parseStoredValue($path);

        if ($remoteFile) {
            $storage->deleteByStoredValue($path);

            return;
        }

        $localPath = Str::startsWith($path, 'storage/')
            ? Str::after($path, 'storage/')
            : $path;

        if (Storage::disk('public')->exists($localPath)) {
            Storage::disk('public')->delete($localPath);
        }
    }

    protected function imageValidationRules(
        bool $required = false,
        array $extensions = ['jpg', 'jpeg', 'png', 'webp'],
        int $maxKilobytes = 5120,
        bool $mustBeImage = true
    ): array {
        $rules = [
            $required ? 'required' : 'nullable',
        ];

        if ($mustBeImage) {
            $rules[] = 'image';
        }

        $rules[] = 'mimes:'.implode(',', $extensions);
        $rules[] = 'max:'.$maxKilobytes;

        return $rules;
    }

    protected function logoValidationRules(bool $required = false): array
    {
        return $this->imageValidationRules($required, ['jpg', 'jpeg', 'png', 'svg'], 2048);
    }

    protected function faviconValidationRules(bool $required = false): array
    {
        return [
            $required ? 'required' : 'nullable',
            'mimes:png,ico',
            'max:1024',
        ];
    }
}
