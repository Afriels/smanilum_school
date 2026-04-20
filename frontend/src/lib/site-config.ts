const fallbackSiteUrl = "https://smanilum.vercel.app";

function trimTrailingSlash(value: string) {
  return value.replace(/\/+$/, "");
}

function readUrl(value: string | undefined, fallback: string) {
  if (!value) {
    return fallback;
  }

  return trimTrailingSlash(value);
}

export const frontendSiteUrl = readUrl(
  process.env.NEXT_PUBLIC_SITE_URL,
  fallbackSiteUrl,
);

export const backendBaseUrl = readUrl(
  process.env.NEXT_PUBLIC_BACKEND_URL,
  "http://localhost/smanilum/backend/public",
);

export const adminLoginUrl = `${backendBaseUrl}/admin/login`;
export const publicApiHomeUrl = `${backendBaseUrl}/api/v1/public/home`;
