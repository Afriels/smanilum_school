import { PageHero } from "@/components/page-hero";
import { SiteShell } from "@/components/site-shell";
import { siteConfig } from "@/data/site-content";

export default function KontakPage() {
  return (
    <SiteShell>
      <PageHero
        title="Kontak"
        description="Halaman kontak memadukan form publik, informasi humas/admin, jam operasional, dan peta lokasi sekolah."
      />
      <section className="section-space">
        <div className="container-shell grid gap-6 lg:grid-cols-[380px_minmax(0,1fr)]">
          <article className="card-surface rounded-[1.75rem] p-8">
            <h2 className="text-2xl font-bold text-[var(--color-slate-900)]">
              Informasi Kontak
            </h2>
            <div className="mt-5 space-y-4 text-[var(--color-slate-700)]">
              <p>{siteConfig.address}</p>
              <p>{siteConfig.phone}</p>
              <p>{siteConfig.email}</p>
              <p>Senin - Jumat, 07.00 - 15.30 WIB</p>
              <p>Admin/Humas: Layanan informasi publik sekolah</p>
            </div>
          </article>
          <div className="grid gap-6">
            <article className="card-surface rounded-[1.75rem] p-8">
              <h2 className="text-2xl font-bold text-[var(--color-slate-900)]">
                Form Kontak
              </h2>
              <div className="mt-5 grid gap-4 md:grid-cols-2">
                <input className="rounded-2xl border border-[var(--color-border)] px-4 py-3" placeholder="Nama lengkap" readOnly />
                <input className="rounded-2xl border border-[var(--color-border)] px-4 py-3" placeholder="Email" readOnly />
                <input className="rounded-2xl border border-[var(--color-border)] px-4 py-3 md:col-span-2" placeholder="Subjek" readOnly />
                <textarea className="min-h-36 rounded-2xl border border-[var(--color-border)] px-4 py-3 md:col-span-2" placeholder="Pesan" readOnly />
                <div className="rounded-2xl bg-[var(--color-surface-soft)] px-4 py-3 text-sm text-[var(--color-slate-700)] md:col-span-2">
                  Honeypot / CAPTCHA / rate limiting akan ditangani oleh backend Laravel.
                </div>
              </div>
            </article>
            <article className="card-surface overflow-hidden rounded-[1.75rem]">
              <iframe
                title="Peta lokasi sekolah"
                src={siteConfig.mapEmbed}
                className="h-[360px] w-full border-0"
                loading="lazy"
              />
            </article>
          </div>
        </div>
      </section>
    </SiteShell>
  );
}

