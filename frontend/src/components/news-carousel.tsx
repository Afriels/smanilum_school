"use client";

import { useEffect, useState } from "react";
import Link from "next/link";

type NewsSlide = {
  title: string;
  category: string;
  date: string;
  excerpt: string;
};

type NewsCarouselProps = {
  items: NewsSlide[];
};

export function NewsCarousel({ items }: NewsCarouselProps) {
  const [activeIndex, setActiveIndex] = useState(0);

  useEffect(() => {
    if (items.length <= 1) {
      return;
    }

    const interval = window.setInterval(() => {
      setActiveIndex((current) => (current + 1) % items.length);
    }, 5000);

    return () => window.clearInterval(interval);
  }, [items.length]);

  if (items.length === 0) {
    return null;
  }

  const activeItem = items[activeIndex];

  return (
    <section className="pt-28">
      <div className="container-shell">
        <div className="overflow-hidden rounded-[2rem] bg-[linear-gradient(135deg,#0a387f,#0f4fbf,#72a8ff)] px-7 py-8 text-white shadow-[0_24px_70px_rgba(15,79,191,0.28)] md:px-12 md:py-10">
          <div className="grid gap-8 lg:grid-cols-[minmax(0,1fr)_220px] lg:items-end">
            <div>
              <p className="inline-flex rounded-full bg-white/12 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-white/86">
                Berita Terbaru
              </p>
              <p className="mt-5 text-sm font-semibold uppercase tracking-[0.24em] text-white/72">
                {activeItem.category} • {activeItem.date}
              </p>
              <h2 className="mt-3 max-w-3xl font-serif text-3xl font-bold leading-tight md:text-5xl">
                {activeItem.title}
              </h2>
              <p className="mt-5 max-w-2xl text-base leading-8 text-white/84 md:text-lg">
                {activeItem.excerpt}
              </p>
              <div className="mt-8 flex flex-col gap-4 sm:flex-row">
                <Link
                  href="/berita"
                  className="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-[var(--color-primary)]"
                >
                  Baca Berita
                </Link>
                <Link
                  href="/kontak"
                  className="inline-flex items-center justify-center rounded-full border border-white/28 px-6 py-3 text-sm font-semibold text-white"
                >
                  Hubungi Humas
                </Link>
              </div>
            </div>

            <div className="grid gap-3">
              {items.map((item, index) => {
                const active = index === activeIndex;

                return (
                  <button
                    key={item.title}
                    type="button"
                    onClick={() => setActiveIndex(index)}
                    className={`rounded-[1.5rem] border p-4 text-left transition ${
                      active
                        ? "border-white/40 bg-white/18"
                        : "border-white/12 bg-white/8 hover:bg-white/12"
                    }`}
                    aria-pressed={active}
                  >
                    <p className="text-xs font-semibold uppercase tracking-[0.24em] text-white/72">
                      Slide {index + 1}
                    </p>
                    <p className="mt-2 line-clamp-3 text-sm font-semibold leading-6 text-white">
                      {item.title}
                    </p>
                  </button>
                );
              })}
            </div>
          </div>

          <div className="mt-8 flex items-center gap-3">
            {items.map((item, index) => {
              const active = index === activeIndex;

              return (
                <button
                  key={`${item.title}-indicator`}
                  type="button"
                  onClick={() => setActiveIndex(index)}
                  className={`h-2.5 rounded-full transition-all ${
                    active ? "w-12 bg-white" : "w-2.5 bg-white/40"
                  }`}
                  aria-label={`Buka slide berita ${index + 1}`}
                />
              );
            })}
          </div>
        </div>
      </div>
    </section>
  );
}

