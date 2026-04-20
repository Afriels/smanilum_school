<?php

namespace App\Console\Commands;

use App\Models\Banner;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FixSupabaseMediaUrls extends Command
{
    protected $signature = 'media:fix-supabase-urls {--dry-run : Only show affected records without updating them}';

    protected $description = 'Detect and fix stored Supabase media URLs that still use /storage/v1/object/ instead of /storage/v1/object/public/.';

    public function handle(): int
    {
        $supabaseUrl = rtrim((string) config('supabase.url'), '/');

        if ($supabaseUrl === '') {
            $this->error('SUPABASE_URL belum dikonfigurasi.');

            return self::FAILURE;
        }

        $wrongPrefix = $supabaseUrl.'/storage/v1/object/';
        $correctPrefix = $supabaseUrl.'/storage/v1/object/public/';
        $dryRun = (bool) $this->option('dry-run');

        $targets = [
            [
                'label' => 'site_settings.value',
                'model' => SiteSetting::class,
                'column' => 'value',
                'id' => 'key',
                'extraWhere' => fn ($query) => $query->whereIn('key', ['logo', 'favicon', 'default_og_image']),
            ],
            [
                'label' => 'posts.featured_image_path',
                'model' => Post::class,
                'column' => 'featured_image_path',
                'id' => 'slug',
            ],
            [
                'label' => 'pages.featured_image_path',
                'model' => Page::class,
                'column' => 'featured_image_path',
                'id' => 'slug',
            ],
            [
                'label' => 'banners.image_path',
                'model' => Banner::class,
                'column' => 'image_path',
                'id' => 'slug',
            ],
            [
                'label' => 'gallery_albums.cover_image_path',
                'model' => Gallery::class,
                'column' => 'cover_image_path',
                'id' => 'slug',
            ],
            [
                'label' => 'gallery_items.file_path',
                'model' => GalleryItem::class,
                'column' => 'file_path',
                'id' => 'title',
            ],
            [
                'label' => 'gallery_items.thumbnail_path',
                'model' => GalleryItem::class,
                'column' => 'thumbnail_path',
                'id' => 'title',
            ],
            [
                'label' => 'extracurriculars.cover_image',
                'model' => Extracurricular::class,
                'column' => 'cover_image',
                'id' => 'slug',
            ],
            [
                'label' => 'extracurriculars.featured_image_path',
                'model' => Extracurricular::class,
                'column' => 'featured_image_path',
                'id' => 'slug',
            ],
        ];

        $totalAffected = 0;
        $totalUpdated = 0;

        foreach ($targets as $target) {
            /** @var class-string<Model> $modelClass */
            $modelClass = $target['model'];
            $column = $target['column'];
            $identifier = $target['id'];

            $query = $modelClass::query()
                ->where($column, 'like', $wrongPrefix.'%')
                ->where($column, 'not like', $correctPrefix.'%');

            if (isset($target['extraWhere'])) {
                $target['extraWhere']($query);
            }

            $records = $query->get([$modelClass::query()->getModel()->getKeyName(), $identifier, $column]);

            if ($records->isEmpty()) {
                continue;
            }

            $this->newLine();
            $this->info($target['label']);

            foreach ($records as $record) {
                $currentValue = (string) $record->{$column};
                $fixedValue = Str::replaceFirst($wrongPrefix, $correctPrefix, $currentValue);
                $label = (string) ($record->{$identifier} ?: $record->getKey());

                $this->line(sprintf('- %s', $label));
                $this->line(sprintf('  old: %s', $currentValue));
                $this->line(sprintf('  new: %s', $fixedValue));

                if (! $dryRun) {
                    $record->{$column} = $fixedValue;
                    $record->save();
                    $totalUpdated++;
                }

                $totalAffected++;
            }
        }

        $this->newLine();
        $this->info(sprintf('Affected records: %d', $totalAffected));

        if ($dryRun) {
            $this->comment('Dry run aktif. Tidak ada perubahan yang disimpan.');
        } else {
            $this->info(sprintf('Updated records: %d', $totalUpdated));
        }

        return self::SUCCESS;
    }
}
