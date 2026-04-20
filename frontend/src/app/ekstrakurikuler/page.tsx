import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { extracurriculars } from "@/data/site-content";

export default function EkstrakurikulerPage() {
  return (
    <SiteShell>
      <PageHero
        title="Ekstrakurikuler"
        description="Modul ekstrakurikuler menampilkan daftar kegiatan, deskripsi singkat, dan dokumentasi yang bisa dikelola dari dashboard."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 md:grid-cols-2">
          {extracurriculars.map((item) => (
            <article key={item.title} className="card-surface rounded-[1.75rem] p-8">
              <h2 className="text-2xl font-bold text-[var(--color-slate-900)]">
                {item.title}
              </h2>
              <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
                {item.description}
              </p>
            </article>
          ))}
        </div>
      </section>
    </SiteShell>
  );
}

