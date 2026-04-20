import Link from "next/link";
import {
  academicPrograms,
  announcements,
  galleryItems,
  highlights,
  newsItems,
  siteConfig,
  stats,
  testimonials,
} from "@/data/site-content";
import {
  ArrowRightIcon,
  GraduationCapIcon,
  ShieldIcon,
  SparkIcon,
} from "@/components/icons";
import { NewsCarousel } from "@/components/news-carousel";
import { SectionHeading } from "@/components/section-heading";
import { SiteShell } from "@/components/site-shell";
import { publicApiHomeUrl } from "@/lib/site-config";

const heroCards = [
  {
    title: "Akreditasi dan Tata Kelola",
    description: "Mendorong mutu layanan yang akuntabel, aman, dan terukur.",
    icon: ShieldIcon,
  },
  {
    title: "Pembelajaran Adaptif",
    description: "Kelas modern dengan pendekatan akademik, karakter, dan teknologi.",
    icon: GraduationCapIcon,
  },
  {
    title: "Prestasi dan Talenta",
    description: "Ekosistem siswa untuk unggul di bidang akademik maupun non-akademik.",
    icon: SparkIcon,
  },
];

export default function Home() {
  return (
    <SiteShell>
      <NewsCarousel items={newsItems} />

      <section className="overflow-hidden pt-8">
        <div className="container-shell">
          <div className="hero-grid card-surface rounded-[2rem] border px-7 py-8 md:px-12 md:py-12">
            <div>
              <p className="mb-4 inline-flex rounded-full bg-[var(--color-primary-soft)] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">
                Profil Sekolah Modern
              </p>
              <h1 className="text-balance max-w-3xl font-serif text-4xl font-bold leading-tight text-[var(--color-slate-900)] md:text-6xl">
                {siteConfig.schoolName}
              </h1>
              <p className="mt-5 max-w-2xl text-xl leading-9 text-[var(--color-slate-700)]">
                {siteConfig.tagline}
              </p>
              <p className="mt-5 max-w-2xl text-lg leading-8 text-[var(--color-slate-500)]">
                {siteConfig.shortDescription}
              </p>
              <div className="mt-8 flex flex-col gap-4 sm:flex-row">
                <Link
                  href="/profil"
                  className="inline-flex items-center justify-center gap-2 rounded-full bg-[var(--color-primary)] px-6 py-3 text-sm font-semibold text-white"
                >
                  Lihat Profil
                  <ArrowRightIcon className="h-4 w-4" />
                </Link>
                <Link
                  href="/kontak"
                  className="inline-flex items-center justify-center rounded-full border border-[var(--color-border)] bg-white px-6 py-3 text-sm font-semibold text-[var(--color-slate-700)]"
                >
                  Hubungi Sekolah
                </Link>
              </div>
            </div>

            <div className="grid gap-4">
              <div className="rounded-[1.75rem] bg-[linear-gradient(145deg,var(--color-primary),#72a8ff)] p-6 text-white">
                <p className="text-sm uppercase tracking-[0.3em] text-white/80">
                  Banner Sekolah
                </p>
                <h2 className="mt-4 max-w-sm font-serif text-3xl font-bold leading-tight">
                  Formal, elegan, dan siap menjadi pusat informasi sekolah yang profesional.
                </h2>
                <div className="mt-8 grid grid-cols-2 gap-3">
                  {stats.slice(0, 2).map((stat) => (
                    <div key={stat.label} className="rounded-2xl bg-white/14 p-4">
                      <p className="text-2xl font-bold">{stat.value}</p>
                      <p className="mt-1 text-sm text-white/80">{stat.label}</p>
                    </div>
                  ))}
                </div>
              </div>
              <div className="grid gap-4 md:grid-cols-3">
                {heroCards.map(({ icon: Icon, title, description }) => (
                  <article
                    key={title}
                    className="rounded-[1.5rem] border border-[var(--color-border)] bg-white p-5"
                  >
                    <Icon className="h-8 w-8 text-[var(--color-primary)]" />
                    <h3 className="mt-4 text-lg font-bold text-[var(--color-slate-900)]">
                      {title}
                    </h3>
                    <p className="mt-2 text-sm leading-7 text-[var(--color-slate-600)]">
                      {description}
                    </p>
                  </article>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="section-space">
        <div className="container-shell grid gap-10 lg:grid-cols-[minmax(0,1fr)_380px]">
          <div className="card-surface rounded-[2rem] p-8 md:p-10">
            <SectionHeading
              eyebrow="Sambutan Kepala Sekolah"
              title="Membangun ekosistem belajar yang tertib, hangat, dan berorientasi prestasi."
              description="Website ini dirancang sebagai pusat informasi resmi sekolah agar orang tua, siswa, dan masyarakat dapat mengakses profil, agenda, berita, dan layanan publik secara cepat serta terpercaya."
            />
          </div>
          <div className="grid gap-4">
            {highlights.map((item) => (
              <article key={item.title} className="card-surface rounded-[1.5rem] p-6">
                <h3 className="text-xl font-bold text-[var(--color-slate-900)]">
                  {item.title}
                </h3>
                <p className="mt-3 leading-7 text-[var(--color-slate-700)]">
                  {item.description}
                </p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="pb-8">
        <div className="container-shell grid gap-4 md:grid-cols-4">
          {stats.map((stat) => (
            <article
              key={stat.label}
              className="card-surface rounded-[1.5rem] p-6 text-center"
            >
              <p className="text-4xl font-bold text-[var(--color-primary)]">
                {stat.value}
              </p>
              <p className="mt-2 text-sm uppercase tracking-[0.2em] text-[var(--color-slate-500)]">
                {stat.label}
              </p>
            </article>
          ))}
        </div>
      </section>

      <section className="section-space">
        <div className="container-shell">
          <SectionHeading
            eyebrow="Berita Terbaru"
            title="Publikasi sekolah ditata rapi agar informasi penting mudah ditemukan."
            description="Struktur berita, pengumuman, dan agenda disiapkan modular untuk memudahkan admin non-teknis mengelola konten dari dashboard."
          />
          <div className="mt-10 grid gap-5 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div className="grid gap-5 md:grid-cols-3">
              {newsItems.map((item) => (
                <article key={item.title} className="card-surface rounded-[1.75rem] p-6">
                  <p className="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-primary)]">
                    {item.category}
                  </p>
                  <h3 className="mt-4 text-xl font-bold text-[var(--color-slate-900)]">
                    {item.title}
                  </h3>
                  <p className="mt-3 leading-7 text-[var(--color-slate-700)]">
                    {item.excerpt}
                  </p>
                  <p className="mt-6 text-sm text-[var(--color-slate-500)]">
                    {item.date}
                  </p>
                </article>
              ))}
            </div>
            <aside className="card-surface rounded-[1.75rem] p-6">
              <p className="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-primary)]">
                Pengumuman / Agenda
              </p>
              <div className="mt-5 space-y-4">
                {announcements.map((item) => (
                  <div
                    key={item}
                    className="rounded-2xl bg-[var(--color-surface-soft)] p-4 text-sm leading-7 text-[var(--color-slate-700)]"
                  >
                    {item}
                  </div>
                ))}
              </div>
            </aside>
          </div>
        </div>
      </section>

      <section className="section-space">
        <div className="container-shell grid gap-10 lg:grid-cols-2">
          <div>
            <SectionHeading
              eyebrow="Galeri Kegiatan"
              title="Dokumentasi kegiatan dapat dikelola per album, foto, dan video."
              description="Galeri dirancang untuk memudahkan publik melihat dinamika kegiatan sekolah secara visual tanpa membuat tampilan terasa ramai."
            />
            <div className="mt-8 grid gap-4 sm:grid-cols-2">
              {galleryItems.map((item, index) => (
                <article
                  key={item}
                  className="rounded-[1.5rem] border border-[var(--color-border)] bg-[linear-gradient(160deg,#ffffff,#edf5ff)] p-6"
                >
                  <p className="text-sm font-semibold text-[var(--color-primary)]">
                    Album {index + 1}
                  </p>
                  <h3 className="mt-3 text-lg font-bold text-[var(--color-slate-900)]">
                    {item}
                  </h3>
                </article>
              ))}
            </div>
          </div>
          <div className="card-surface rounded-[2rem] p-8 md:p-10">
            <SectionHeading
              eyebrow="Program Unggulan"
              title="Arah akademik yang tegas, komunikatif, dan relevan."
              description="Website mendukung presentasi kurikulum, program unggulan, dan informasi akademik secara terstruktur."
            />
            <div className="mt-8 space-y-4">
              {academicPrograms.map((item) => (
                <div
                  key={item}
                  className="rounded-2xl border border-[var(--color-border)] bg-white px-5 py-4 text-[var(--color-slate-700)]"
                >
                  {item}
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      <section className="section-space">
        <div className="container-shell">
          <SectionHeading
            eyebrow="Prestasi & Testimoni"
            title="Citra sekolah dibangun dari pengalaman belajar yang terasa nyata."
            description="Bagian ini bisa dipakai untuk prestasi, testimoni alumni, atau capaian institusi yang ingin diangkat pada beranda."
          />
          <div className="mt-10 grid gap-5 md:grid-cols-2">
            {testimonials.map((item) => (
              <article key={item.name} className="card-surface rounded-[1.75rem] p-8">
                <p className="font-serif text-2xl leading-9 text-[var(--color-slate-900)]">
                  “{item.quote}”
                </p>
                <div className="mt-6 border-t border-[var(--color-border)] pt-4">
                  <p className="font-bold text-[var(--color-slate-900)]">{item.name}</p>
                  <p className="text-sm text-[var(--color-slate-500)]">{item.role}</p>
                </div>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section className="pb-16">
        <div className="container-shell">
          <div className="rounded-[2rem] bg-[linear-gradient(135deg,var(--color-primary-dark),var(--color-primary))] px-8 py-10 text-white md:px-12 md:py-12">
            <div className="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
              <div className="max-w-2xl">
                <p className="text-sm font-semibold uppercase tracking-[0.3em] text-white/70">
                  Call To Action
                </p>
                <h2 className="mt-3 font-serif text-3xl font-bold md:text-4xl">
                  Siap dikembangkan menjadi website sekolah resmi yang lengkap dengan dashboard admin.
                </h2>
              </div>
              <div className="flex flex-col gap-4 sm:flex-row">
                <Link
                  href="/kontak"
                  className="rounded-full bg-white px-6 py-3 text-sm font-semibold text-[var(--color-primary)]"
                >
                  Konsultasi Implementasi
                </Link>
                <a
                  href={publicApiHomeUrl}
                  className="rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white"
                >
                  Lihat Endpoint API
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </SiteShell>
  );
}
