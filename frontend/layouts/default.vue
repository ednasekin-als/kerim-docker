<template>
    <div :data-theme="darkMode" v-bind:class="['wrap', { 'wrap_small': this.$store.state.openMenu }]">
        <SecTheHeader />
        <div class="wrap__r">
            <Nuxt class="wrapP" />
        </div>
        <CompScrollTop />
        <SecTheFooter />
    </div>
</template>
<script>

export default {
    name: "LayDef",
    mounted() {
        const isMenuOpen = this.getInitialIsMenuOpen();
        this.$store.dispatch("updateOpenMenu", isMenuOpen);
    },
    methods: {
        getInitialIsMenuOpen() {
            if (typeof localStorage !== 'undefined') {
                const storedValue = localStorage.getItem('isMenuOpen');
                return storedValue !== null ? storedValue === 'true' : false;
            }

            return false;
        },
    },
}

</script>


<script setup>
import { ref } from 'vue';

const getInitialDarkMode = () => {
    if (typeof localStorage !== 'undefined') {
        const storedValue = localStorage.getItem('darkMode');
        return storedValue !== null ? storedValue === 'true' : false;
    }
    return false;
};

const darkMode = ref(getInitialDarkMode());

const saveDarkModePreference = (isDarkMode) => {
    if (typeof localStorage !== 'undefined') {
        localStorage.setItem('darkMode', isDarkMode.toString());
    }
};

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
    saveDarkModePreference(darkMode.value);
};

if (typeof localStorage !== 'undefined') {
    window.addEventListener('beforeunload', () => {
        saveDarkModePreference(darkMode.value);
    });
}


</script>

<style lang="scss">
.wrapLang {
    padding: var(--main-pad);
    display: flex;
    align-items: flex-end;
    height: 100%;
}

.closeMenu {
    display: inline-block;
    padding: 0rem;

    svg {
        width: 3rem;
        height: auto;
    }
}

.wrap {
    height: 100vh;
    width: 100%;
    transition: 0.5s ease-in-out;

    @media (max-width: 950px) {
        grid-template-columns: 100%;
    }

}


.wrapP {
    margin-top: 48px;
    transform-origin: left;
    min-height: 100vh;
    display: flex;
    flex-direction: column;

    .h1 {
        color: var(--black) !important;
    }
}

.wrap__l {
    // position: fixed;
    // width: 50%;
    flex: 25%;
    height: 100%;
    z-index: 10;
    background: var(--white);
    box-shadow: 2px 0px 12px 0px rgba(0, 0, 0, .08);

    @media (max-width: 950px) {
        display: none;
    }

}

.wrap__lInner {
    position: sticky;
    top: 0;
    left: 0;
    height: 100vh;
    height: 100dvh;
    display: flex;
    flex-direction: column;
}

.wrap__lContW {
    flex: auto;
}


// .wrap__r {
//     position: fixed;
//     right: 0;
//     width: 50%;
//     height: 100vh;

// }
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
    opacity: 1;
    //   transform-origin: left;
}

.fade-enter,
.fade-leave-to {
    transition: opacity 0.3s;
    // filter: blur(1rem);
    opacity: 0;
    //   transform: scaleX(0);
    //   transform-origin: left;
}

.menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  height: 100dvh;
  overflow: auto;
  background: rgba(242, 242, 242, .8);
  backdrop-filter: saturate(180%) blur(20px);
  color: var(--black);
  z-index: 100;
}

.menuLogo {
  margin-top: 45px;

  svg {
      width: 80%;
      max-width: 350px;
      height: auto;
  }

  p {
      margin-bottom: 0px;
      font-size: 30px;
  }
}

.menu__head {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--white);
  box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.10);
  z-index: 10;
  opacity: 0;
  height: 2rem;
}

.menu__cont {
  padding: var(--main-pad);
  display: grid;
}

.menu__item {
  transform: translate3d(0, 0px, 0);
  transition-duration: 0.4s;
  // transition-delay: 1s;
  opacity: 1;
}

.menu-enter-active,
.menu-leave-active {
  transition: opacity 0.3s, clip-path 0.6s;
  opacity: 1;
  clip-path: inset(0 0 0% 0);

  // .menu__item {
  //     transform: translate3d(0, 0px, 0);
  //     transition-duration: 0.4s;
  //     // transition-delay: 1s;
  //     opacity: 1;
  // }
}

.menu-enter,
.menu-leave-to {
  transition: opacity 0.3s, clip-path 0.6s;
  opacity: 0;
  clip-path: inset(0 0 100% 0);

  .menu__item {
      transform: translate3d(0, -10px, 0);
      // transition-duration: 0.4s;
      // transition-delay: 1s;
      opacity: 0;
  }
}

.menu__item {
  will-change: transform;
}
</style>
