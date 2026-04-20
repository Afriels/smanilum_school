"use client";

import { useMemo } from "react";
import { createSupabaseBrowserClient } from "@/lib/supabase/browser";
import { hasSupabaseEnv } from "@/lib/supabase/env";

export function SupabaseStatusCard() {
  const supabase = useMemo(() => {
    if (!hasSupabaseEnv()) {
      return null;
    }

    return createSupabaseBrowserClient();
  }, []);

  const demoPublicUrl = supabase
    ? supabase.storage.from("posts").getPublicUrl("thumbnails/demo.jpg").data
        .publicUrl
    : null;

  return (
    <article className="mt-6 rounded-[1.5rem] border border-[var(--color-border)] bg-[var(--color-surface-soft)] p-6">
      <p className="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-primary)]">
        Supabase Frontend
      </p>
      <h3 className="mt-3 text-xl font-bold text-[var(--color-slate-900)]">
        {supabase ? "Client terhubung" : "Environment belum lengkap"}
      </h3>
      <p className="mt-3 leading-7 text-[var(--color-slate-700)]">
        {supabase
          ? "Frontend Next.js sudah membuat browser client Supabase yang siap dipakai untuk auth, storage URL, atau pembacaan data publik."
          : "Isi NEXT_PUBLIC_SUPABASE_URL dan NEXT_PUBLIC_SUPABASE_PUBLISHABLE_KEY di Vercel agar client Supabase aktif di frontend."}
      </p>
      {demoPublicUrl ? (
        <p className="mt-4 break-all text-sm text-[var(--color-slate-500)]">
          Contoh public URL bucket `posts`: {demoPublicUrl}
        </p>
      ) : null}
    </article>
  );
}
