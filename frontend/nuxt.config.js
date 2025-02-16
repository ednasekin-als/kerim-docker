import ru from "./i18n/ru.json";
import en from "./i18n/en.json";
const lang = {
  ru,
  en,
};

const backend = 'http://backend:80'

export default {
  ssr: true,
  target: "server",

  axios: {
    proxy: true,
  },

  proxy: {
    '/wp-json/': {
      target: backend,
    },
  },

  server: {
    port: 3000,
    host: '0.0.0.0',
  },


  head: {
    title: "Kerimov",
    // htmlAttrs: {
    //   lang: "ru",
    // },

    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1, viewport-fit=cover" },
      { name: "p:domain_verify", content: "035b3120729cebc8cf517e99dcc25e99" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" },
      {
        "http-equiv": "Content-Security-Policy",
        content: "upgrade-insecure-requests",
      },
      { name: "robots", content: "index, follow" },
    ],
    link: [
      { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
      { rel: "stylesheet", href: "https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css" }
      // { rel: "alternate", hreflang: "ru", href: "https://kerimovarchitects.com/" },
      // { rel: "alternate", hreflang: "en", href: "https://kerimovarchitects.com/en/" },
    ],
    script: [
      {
        innerHTML: `(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(97429270, "init", {
             clickmap:true,
             trackLinks:true,
             accurateTrackBounce:true,
             webvisor:true
        });`,
        type: "text/javascript",
        charset: "utf-8"
      },
    ],
    noscript: [
      {
        innerHTML: '<div><img src="https://mc.yandex.ru/watch/97429270" style="position:absolute; left:-9999px;" alt="" /></div>',
        body: true,
      },
    ],
    __dangerouslyDisableSanitizersByTagID: {
      'yandex-metrika': ['innerHTML'],
    },
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    "dropzone/dist/dropzone.css",
    "@splidejs/splide/dist/css/splide-core.min.css",
    "@/assets/css/main.css",
    "@/assets/css/style.scss",
    "swiper/css/swiper.min.css"
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: "~/plugins/google-maps", ssr: true },
    { src: "@/plugins/splide", mode: "client" },
    { src: "@/plugins/router" },
    { src: '~/plugins/vue-awesome-swiper', mode: "client", ssr: false },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: ["@/modules/sitemapRouteGenerator"],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ["@nuxtjs/axios", "nuxt-i18n", "@nuxtjs/sitemap", "nuxt-vue-select"],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    publicPath: '/_nuxt/',
    transpile: ["dom7", "ssr-window", "vue2-google-maps"],
    extend(config, ctx) {
      config.module.rules.push({
        test: /\.(ogg|mp3|wav|mpe?g)$/i,
        loader: "file-loader",
        options: {
          name: "[path][name].[ext]",
        },
      });
      config.module.rules.push({
        test: /\.js$/,
        exclude: /node_modules\/(?!mapbox-gl)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-transform-object-rest-spread']
          }
        }
      });
    },
  },
  i18n: {
    locales: [
      {
        name: "ru",
        code: "ru",
        iso: "ru-RU",
      },
      {
        name: "en",
        code: "en",
        iso: "en",
      },
    ],
    defaultLocale: "ru",
    vueI18n: {
      messages: Object.assign(lang),
    },
    detectBrowserLanguage: {
      useCookie: true,
      cookieKey: 'i18n_redirected',
      onlyOnRoot: true,
      alwaysRedirect: true,
    },
    // skipSettingLocaleOnNavigate: true,
  },
  pageTransition: {
    name: "page",
    mode: "out-in",
    duration: 500,
  },
  sitemap: {
    // options
    hostname: "https://kerimovarchitects.com/",
    i18n: {
      locales: ["en"],
      routesNameSeparator: "___",
    },
  },
};
