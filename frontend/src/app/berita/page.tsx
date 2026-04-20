import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { announcements, newsItems } from "@/data/site-content";

export default function BeritaPage() {
  return (
    <SiteShell>
      <PageHero
        title="Berita & Pengumuman"
        description="Halaman ini disiapkan untuk daftar berita, detail artikel, filter kategori, dan fitur pencarian konten."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
          <div className="grid gap-5">
            <div className="card-surface rounded-[1.5rem] p-5">
              <div className="grid gap-4 md:grid-cols-[minmax(0,1fr)_220px]">
                <input
                  type="search"
                  placeholder="Cari berita atau pengumuman..."
                  className="rounded-full border border-[var(--color-border)] bg-white px-5 py-3 outline-none"
                  readOnly
                />
                <div className="rounded-full border border-[var(--color-border)] bg-[var(--color-surface-soft)] px-5 py-3 text-sm text-[var(--color-slate-700)]">
                  Filter kategori: Semua
                </div>
              </div>
            </div>
            {newsItems.map((item) => (
              <article key={item.title} className="card-surface rounded-[1.75rem] p-8">
                <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">
                  {item.category}
                </p>
                <h2 className="mt-4 text-2xl font-bold text-[var(--color-slate-900)]">
                  {item.title}
                </h2>
                <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
                  {item.excerpt}
                </p>
                <p className="mt-5 text-sm text-[var(--color-slate-500)]">
                  {item.date}
                </p>
              </article>
            ))}
          </div>
          <aside className="card-surface rounded-[1.75rem] p-8">
            <h2 className="text-2xl font-bold text-[var(--color-slate-900)]">
              Agenda Singkat
            </h2>
            <div className="mt-5 space-y-4">
              {announcements.map((item) => (
                <div
                  key={item}
                  className="rounded-2xl bg-[var(--color-surface-soft)] p-4 text-[var(--color-slate-700)]"
                >
                  {item}
                </div>
              ))}
            </div>
          </aside>
        </div>
      </section>
    </SiteShell>
  );
}

