export default ({ app }) => {
  app.nuxt.defaultTransition.beforeEnter = () => {
    app.i18n.finalizePendingLocaleChange();
  };

  // Optional: wait for locale before scrolling for a smoother transition
  app.router.options.scrollBehavior = async (to, from, savedPosition) => {
    // Make sure the route has changed
    if (to.name !== from.name) {
      await app.i18n.waitForPendingLocaleChange();
    }
    let position = { // default, mimics the top position on navigation
      x: 0,
      y: 0,
    };

    if (savedPosition) {
      position = savedPosition;
    }
  };
};
