"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { mainNav, siteConfig } from "@/data/site-content";
import { adminLoginUrl } from "@/lib/site-config";

export function SiteHeader() {
  const pathname = usePathname();

  return (
    <header className="fixed inset-x-0 top-0 z-50">
      <div className="container-shell pt-4">
        <div className="card-surface flex items-center justify-between rounded-full px-4 py-3 md:px-6">
          <Link href="/" className="flex items-center gap-3">
            <div className="flex h-11 w-11 items-center justify-center rounded-full bg-[linear-gradient(135deg,var(--color-primary),#4f8cff)] text-sm font-bold text-white">
              SI
            </div>
            <div>
              <p className="text-xs font-semibold uppercase tracking-[0.26em] text-[var(--color-primary)]">
                Website Profil
              </p>
              <p className="text-sm font-bold text-[var(--color-slate-900)] md:text-base">
                {siteConfig.schoolName}
              </p>
            </div>
          </Link>

          <nav className="hidden items-center gap-2 lg:flex">
            {mainNav.map((item) => {
              const active = pathname === item.href;

              return (
                <Link
                  key={item.href}
                  href={item.href}
                  className={`rounded-full px-4 py-2 text-sm font-semibold transition ${
                    active
                      ? "bg-[var(--color-primary)] text-white"
                      : "text-[var(--color-slate-700)] hover:bg-[var(--color-primary-soft)]"
                  }`}
                >
                  {item.label}
                </Link>
              );
            })}
          </nav>

          <div className="hidden items-center gap-3 md:flex">
            <Link
              href="/kontak"
              className="rounded-full border border-[var(--color-border)] px-4 py-2 text-sm font-semibold text-[var(--color-slate-700)]"
            >
              Hubungi Kami
            </Link>
            <a
              href={adminLoginUrl}
              className="rounded-full bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white"
            >
              Admin Login
            </a>
          </div>
        </div>
      </div>
    </header>
  );
}
