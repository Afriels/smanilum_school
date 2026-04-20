import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { adminLoginUrl } from "@/lib/site-config";

export default function AdminInfoPage() {
  return (
    <SiteShell>
      <PageHero
        title="Dashboard Admin"
        description="Panel admin dipisahkan dari website publik untuk menjaga keamanan, alur kerja editorial, dan pengelolaan konten yang lebih terstruktur."
      />
      <section className="section-space">
        <div className="container-shell">
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="text-2xl font-bold text-[var(--color-slate-900)]">
              Akses Admin
            </h2>
            <p className="mt-4 leading-8 text-[var(--color-slate-700)]">
              Implementasi starter ini menempatkan inti CMS dan autentikasi admin pada backend Laravel. Frontend publik dapat membaca konten lewat API tanpa mencampur area publik dan area administrasi.
            </p>
            <a
              href={adminLoginUrl}
              className="mt-6 inline-flex rounded-full bg-[var(--color-primary)] px-6 py-3 text-sm font-semibold text-white"
            >
              Buka Login Admin
            </a>
          </article>
        </div>
      </section>
    </SiteShell>
  );
}
