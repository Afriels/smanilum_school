import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { galleryItems } from "@/data/site-content";

export default function GaleriPage() {
  return (
    <SiteShell>
      <PageHero
        title="Galeri"
        description="Album foto dan video disusun agar visual kegiatan sekolah tetap elegan, ringan, dan mudah dijelajahi."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          {galleryItems.map((item, index) => (
            <article key={item} className="card-surface overflow-hidden rounded-[1.75rem]">
              <div className="h-52 bg-[linear-gradient(135deg,#dcecff,#8cbcff,#0f4fbf)]" />
              <div className="p-6">
                <p className="text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-primary)]">
                  Album {index + 1}
                </p>
                <h2 className="mt-3 text-xl font-bold text-[var(--color-slate-900)]">
                  {item}
                </h2>
                <p className="mt-3 leading-7 text-[var(--color-slate-700)]">
                  Placeholder album untuk foto/video yang nantinya dikelola melalui modul galeri.
                </p>
              </div>
            </article>
          ))}
        </div>
      </section>
    </SiteShell>
  );
}

