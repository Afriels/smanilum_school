type PageHeroProps = {
  title: string;
  description: string;
};

export function PageHero({ title, description }: PageHeroProps) {
  return (
    <section className="pt-28">
      <div className="container-shell">
        <div className="card-surface overflow-hidden rounded-[2rem] border px-7 py-10 md:px-12 md:py-14">
          <p className="mb-4 text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">
            Halaman Informasi
          </p>
          <h1 className="max-w-3xl font-serif text-4xl font-bold text-[var(--color-slate-900)] md:text-5xl">
            {title}
          </h1>
          <p className="mt-5 max-w-2xl text-lg leading-8 text-[var(--color-slate-700)]">
            {description}
          </p>
        </div>
      </div>
    </section>
  );
}

