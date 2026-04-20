import type { Metadata } from "next";
import { Merriweather, Plus_Jakarta_Sans } from "next/font/google";
import { frontendSiteUrl } from "@/lib/site-config";
import "./globals.css";

const plusJakartaSans = Plus_Jakarta_Sans({
  variable: "--font-plus-jakarta-sans",
  subsets: ["latin"],
});

const merriweather = Merriweather({
  variable: "--font-merriweather",
  subsets: ["latin"],
  weight: ["400", "700"],
});

export const metadata: Metadata = {
  metadataBase: new URL(frontendSiteUrl),
  title: {
    default: "SMAN Ilum Modern",
    template: "%s | SMAN Ilum Modern",
  },
  description:
    "Website profil sekolah modern yang formal, cepat, responsif, dan mudah dikelola.",
  keywords: ["website sekolah", "profil sekolah", "berita sekolah", "akademik"],
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html
      lang="id"
      className={`${plusJakartaSans.variable} ${merriweather.variable} h-full scroll-smooth`}
    >
      <body className="min-h-full bg-[var(--color-bg)] font-sans text-[var(--color-slate-900)] antialiased">
        {children}
      </body>
    </html>
  );
}
