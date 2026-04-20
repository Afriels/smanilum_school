const fallbackSiteUrl = "https://smanilum.vercel.app";
const localBackendUrl = "http://localhost/smanilum/backend/public";

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

const configuredBackendUrl = process.env.NEXT_PUBLIC_BACKEND_URL;
export const backendBaseUrl = configuredBackendUrl
  ? readUrl(configuredBackendUrl, localBackendUrl)
  : process.env.NODE_ENV === "development"
    ? localBackendUrl
    : "";

export const adminLoginUrl = backendBaseUrl
  ? `${backendBaseUrl}/admin/login`
  : "/admin";

export const publicApiHomeUrl = backendBaseUrl
  ? `${backendBaseUrl}/api/v1/public/home`
  : "/admin";
