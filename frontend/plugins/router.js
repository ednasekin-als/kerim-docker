export default defineNuxtPlugin((nuxtApp) => {
  const router = useRouter();
  const { $i18n } = useNuxtApp();

  nuxtApp.hook("page:transition:before", () => {
    $i18n.finalizePendingLocaleChange();
  });

  router.options.scrollBehavior = async (to, from, savedPosition) => {
    if (to.name !== from.name) {
      await $i18n.waitForPendingLocaleChange();
    }

    return savedPosition || { top: 0 };
  };
});
