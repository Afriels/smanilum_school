import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { profileSections } from "@/data/site-content";

export default function ProfilPage() {
  return (
    <SiteShell>
      <PageHero
        title="Profil Sekolah"
        description="Menampilkan sejarah, visi misi, struktur organisasi, guru dan staf, serta fasilitas sekolah dalam format yang formal dan mudah dipahami."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 lg:grid-cols-2">
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Sejarah Sekolah
            </h2>
            <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
              {profileSections.history}
            </p>
          </article>
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Visi
            </h2>
            <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
              {profileSections.vision}
            </p>
          </article>
        </div>
        <div className="container-shell mt-6 grid gap-6 lg:grid-cols-[minmax(0,1fr)_420px]">
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Misi
            </h2>
            <div className="mt-5 space-y-4">
              {profileSections.missions.map((item) => (
                <div
                  key={item}
                  className="rounded-2xl bg-[var(--color-surface-soft)] p-4 leading-7 text-[var(--color-slate-700)]"
                >
                  {item}
                </div>
              ))}
            </div>
          </article>
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="font-serif text-3xl font-bold text-[var(--color-slate-900)]">
              Fasilitas
            </h2>
            <ul className="mt-5 space-y-4 text-[var(--color-slate-700)]">
              {profileSections.facilities.map((item) => (
                <li
                  key={item}
                  className="rounded-2xl border border-[var(--color-border)] bg-white px-4 py-3"
                >
                  {item}
                </li>
              ))}
            </ul>
          </article>
        </div>
      </section>
    </SiteShell>
  );
}

