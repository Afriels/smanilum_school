import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { academicPrograms } from "@/data/site-content";

export default function AkademikPage() {
  return (
    <SiteShell>
      <PageHero
        title="Akademik"
        description="Bagian akademik menampilkan kurikulum, program unggulan, dan informasi pembelajaran dalam gaya presentasi yang profesional dan rapi."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 lg:grid-cols-2">
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Kurikulum
            </h2>
            <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
              Kurikulum dirancang untuk menguatkan kompetensi akademik inti,
              literasi numerasi, teknologi, dan pengembangan karakter secara
              seimbang.
            </p>
          </article>
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Program Unggulan
            </h2>
            <div className="mt-5 space-y-4">
              {academicPrograms.map((item) => (
                <div
                  key={item}
                  className="rounded-2xl border border-[var(--color-border)] px-4 py-3 text-[var(--color-slate-700)]"
                >
                  {item}
                </div>
              ))}
            </div>
          </article>
        </div>
      </section>
    </SiteShell>
  );
}

