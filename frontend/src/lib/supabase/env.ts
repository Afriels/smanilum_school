const supabaseUrl = process.env.NEXT_PUBLIC_SUPABASE_URL;
const supabasePublishableKey =
  process.env.NEXT_PUBLIC_SUPABASE_PUBLISHABLE_KEY;

export function hasSupabaseEnv() {
  return Boolean(supabaseUrl && supabasePublishableKey);
}

export function getSupabaseUrl() {
  if (!supabaseUrl) {
    throw new Error("NEXT_PUBLIC_SUPABASE_URL is not configured.");
  }

  return supabaseUrl;
}

export function getSupabasePublishableKey() {
  if (!supabasePublishableKey) {
    throw new Error("NEXT_PUBLIC_SUPABASE_PUBLISHABLE_KEY is not configured.");
  }

  return supabasePublishableKey;
}
