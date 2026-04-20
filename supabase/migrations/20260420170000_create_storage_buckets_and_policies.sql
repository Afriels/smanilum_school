begin;

insert into storage.buckets (id, name, public, file_size_limit, allowed_mime_types)
values
  (
    'logos',
    'logos',
    true,
    2097152,
    array['image/jpeg', 'image/png', 'image/svg+xml']
  ),
  (
    'favicons',
    'favicons',
    true,
    1048576,
    array['image/png', 'image/x-icon', 'image/vnd.microsoft.icon']
  ),
  (
    'posts',
    'posts',
    true,
    5242880,
    array['image/jpeg', 'image/png', 'image/webp']
  ),
  (
    'galleries',
    'galleries',
    true,
    5242880,
    array['image/jpeg', 'image/png', 'image/webp']
  ),
  (
    'banners',
    'banners',
    true,
    5242880,
    array['image/jpeg', 'image/png', 'image/webp']
  )
on conflict (id) do update
set
  public = excluded.public,
  file_size_limit = excluded.file_size_limit,
  allowed_mime_types = excluded.allowed_mime_types;

drop policy if exists "Public can view logos" on storage.objects;
create policy "Public can view logos"
on storage.objects
for select
to public
using (bucket_id = 'logos');

drop policy if exists "Public can view favicons" on storage.objects;
create policy "Public can view favicons"
on storage.objects
for select
to public
using (bucket_id = 'favicons');

drop policy if exists "Public can view post images" on storage.objects;
create policy "Public can view post images"
on storage.objects
for select
to public
using (bucket_id = 'posts');

drop policy if exists "Public can view gallery images" on storage.objects;
create policy "Public can view gallery images"
on storage.objects
for select
to public
using (bucket_id = 'galleries');

drop policy if exists "Public can view banners" on storage.objects;
create policy "Public can view banners"
on storage.objects
for select
to public
using (bucket_id = 'banners');

commit;
