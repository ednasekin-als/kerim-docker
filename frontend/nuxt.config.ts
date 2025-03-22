const backend = 'http://backend:80'

// @ts-ignore
export default defineNuxtConfig({
  ssr: true,

  app: {
    pageTransition: {
      name: "page",
      mode: "out-in",
    },
    errorHandler: "~/layouts/error.vue",
  },

  nitro: {
    routeRules: {
      '/wp-json/**': { proxy: `${backend}/wp-json/**` },
    },
    devProxy: {
      '/wp-json/': {
        target: `${backend}/wp-json`,
        secure: false,
        changeOrigin: true,
        prependPath: true,
      },
    },
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    "dropzone/dist/dropzone.css",
    "@splidejs/splide/dist/css/splide-core.min.css",
    "@/assets/css/main.css",
    "@/assets/css/style.scss",
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ["@pinia/nuxt", "@nuxtjs/i18n", "@nuxtjs/sitemap"],

  i18n: {
    defaultLocale: "ru",
    lazy: true,
    langDir: "locales/",
    locales: [
      {
        code: "en",
        iso: "en-US",
        file: "en.json",
        name: "English",
      },
      {
        code: "ru",
        iso: "ru-RU",
        file: "ru.json",
        name: "Русский",
      },
    ],
    detectBrowserLanguage: false, // Выключаем автоопределение языка
  },


  compatibilityDate: "2025-03-19",
});
