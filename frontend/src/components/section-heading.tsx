type SectionHeadingProps = {
  eyebrow: string;
  title: string;
  description: string;
};

export function SectionHeading({
  eyebrow,
  title,
  description,
}: SectionHeadingProps) {
  return (
    <div className="max-w-2xl">
      <p className="mb-4 inline-flex rounded-full bg-[var(--color-primary-soft)] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)]">
        {eyebrow}
      </p>
      <h2 className="text-balance font-serif text-3xl font-bold text-[var(--color-slate-900)] md:text-4xl">
        {title}
      </h2>
      <p className="mt-4 text-lg leading-8 text-[var(--color-slate-700)]">
        {description}
      </p>
    </div>
  );
}

