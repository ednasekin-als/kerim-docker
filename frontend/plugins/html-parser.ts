export default defineNuxtPlugin((nuxtApp) => {
  const html = (rawHtml: string): string[] => {
    if (!rawHtml) return [];

    return rawHtml
      .replace(/<p>\s*&nbsp;\s*<\/p>/g, "")
      .replace(/<br\s*\/?>/g, "\n") 
      .replace(/<\/?span.*?>/g, "")
      .split(/<\/p>\s*<p>/) 
      .map((p) => p.replace(/<\/?p>/g, "").trim())
      .filter((p) => p.length > 0);
  };

  nuxtApp.provide("html", html);
});
