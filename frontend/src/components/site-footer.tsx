import { siteConfig } from "@/data/site-content";

export function SiteFooter() {
  return (
    <footer className="pb-8 pt-16">
      <div className="container-shell">
        <div className="card-surface overflow-hidden rounded-[2rem] p-8 md:p-10">
          <div className="grid gap-10 md:grid-cols-2 xl:grid-cols-4">
            <div>
              <p className="text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">
                {siteConfig.schoolName}
              </p>
              <p className="mt-4 text-base leading-7 text-[var(--color-slate-700)]">
                Website sekolah modern yang formal, aman, dan mudah dikelola untuk publikasi informasi sekolah.
              </p>
            </div>
            <div>
              <h3 className="text-lg font-bold text-[var(--color-slate-900)]">Alamat</h3>
              <p className="mt-4 text-[var(--color-slate-700)]">{siteConfig.address}</p>
            </div>
            <div>
              <h3 className="text-lg font-bold text-[var(--color-slate-900)]">Kontak</h3>
              <ul className="mt-4 space-y-3 text-[var(--color-slate-700)]">
                <li>{siteConfig.phone}</li>
                <li>{siteConfig.email}</li>
                <li>Senin - Jumat, 07.00 - 15.30 WIB</li>
              </ul>
            </div>
            <div>
              <h3 className="text-lg font-bold text-[var(--color-slate-900)]">Sosial Media</h3>
              <ul className="mt-4 space-y-3 text-[var(--color-slate-700)]">
                {siteConfig.socialLinks.map((item) => (
                  <li key={item.label}>{item.label}</li>
                ))}
              </ul>
            </div>
          </div>
          <div className="mt-10 border-t border-[var(--color-border)] pt-6 text-sm text-[var(--color-slate-500)]">
            © 2026 {siteConfig.schoolName}. Seluruh hak cipta dilindungi.
          </div>
        </div>
      </div>
    </footer>
  );
}

