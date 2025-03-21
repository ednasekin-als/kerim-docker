<template>
  <header :class="['header row', { 'header__opacity': menu }]">
    <div :class="`wrap__head d-lg-none ${(menu) ? 'wrap__head_openMenu' : ''}`">
      <button :class="`openMenu ${(menu) ? 'active' : ''} `" @click="toggleMenu()" :menu="menu">
      </button>
    </div>
    <div class='header__logo'>
      <NuxtLink :to="'/'" class="headerLogo">
        <p class="p1">Kerimov Architects</p>
      </NuxtLink>
    </div>
    <div class="header__nav">
      <ul class="header__menu">
        <li>
          <nuxt-link class="p1 headLink" :class="{ headLink__active: isLinkActive('/projects') }" :to="localePath('/projects')">{{ $i('head.proj') }}</nuxt-link>
        </li>
        <li>
          <nuxt-link class="p1 headLink" :class="{ headLink__active: isLinkActive('/about') }" :to="localePath('/about')">{{ $i('head.about') }}</nuxt-link>
        </li>
        <li>
          <nuxt-link class="p1 headLink" :class="{ headLink__active: isLinkActive('/contacts') }" :to="localePath('/contacts')">{{ $i('head.cont') }}</nuxt-link>
        </li>
      </ul>
    </div>
    <div class="header__switch">
      <NuxtLink :to="switchLocalePath(locale == 'ru' ? 'en' : 'ru')" class="headLink p1 mp0">
        <span :class="(locale == 'ru' ? 'active' : '')">Ru</span>
        /
        <span :class="(locale == 'en' ? 'active' : '')">En</span>
      </NuxtLink>
    </div>
    <Transition name="menu">
      <div v-if="menu" @toggleMenu="toggleMenu()" class="menu d-lg-none">
        <div class="menu__cont">
          <NuxtLink :to="localePath('/')" @click.native="toggleMenu()" class="menuLogo">
            <h3 class="h1">Kerimov Architects</h3>
          </NuxtLink>

          <NuxtLink class="h1m m-b-1r menu__item" @click.native="toggleMenu()" :to="localePath('/projects')">
            {{ $i('head.proj') }}
          </NuxtLink>
          <NuxtLink class="h1m m-b-1r menu__item" @click.native="toggleMenu()"  :to="localePath('/about')">
            {{ $i('head.about') }}
          </NuxtLink>
          <NuxtLink class="h1m m-b-1r menu__item" @click.native="toggleMenu()" :to="localePath('/contacts')">
            {{ $i('head.cont') }}
          </NuxtLink>

          <div class="d-flex flex-column menu__item">
            <div class="" style="width: 100%;">
              <div class="line w-100 m-t-1r m-b-2r"></div>
            </div>
            <NuxtLink @click.native="toggleMenu()" :to="switchLocalePath(locale == 'ru' ? 'en' : 'ru')"
              class="h1m m-b-1r">
              <span :class="(locale == 'ru' ? 'active' : '')">Ru</span>
              /
              <span :class="(locale == 'en' ? 'active' : '')">En</span>
            </NuxtLink>
          </div>
        </div>
      </div>
    </Transition>
  </header>
</template>

<script setup>
const menu = ref(false);

const route = useRoute();
const { locale } = useI18n();
const localePath = useLocalePath();
const switchLocalePath = useSwitchLocalePath();

const toggleMenu = () => {
  menu.value = !menu.value;
};

const isLinkActive = (path) => {
  return route.path.includes(localePath(path));
};

console.log('localePath /projects:', localePath('/projects'));
console.log('localePath /about:', localePath('/about'));

</script>

<style scoped lang="scss">
.btnOpenMenu {
  transition: 0.3s;

  svg {
    height: 0.5rem;
    width: auto;
  }

  &:hover {
    opacity: 0.6;
  }
}

.header {
  justify-content: space-between;
  align-items: center;
  position: fixed;
  width: 100%;
  top: 0;
  height: 48px;
  left: 0;
  padding: 0px var(--main-pad) 0px var(--main-pad);
  backdrop-filter: saturate(180%) blur(20px);
  background: rgba(242, 242, 242, .65);
  z-index: 5;

  &__opacity {
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
  }

  &__nav {
    flex: max-content;
    justify-content: left;
    display: flex;
    margin-left: 14.2rem;


    @media (max-width: 950px) {
      display: none;
    }
  }

  &__switch,
  &__logo {
    @media (max-width: 950px) {
      display: none;
    }
  }

  &__menu {
    display: flex;
    justify-content: end;
    margin: 0px;

    li {
      padding-right: 1.3rem;

      &:last-child {
        padding-right: 0;
      }
    }
  }
}

.header__burger {
  display: flex;
  justify-content: flex-end;
}


.headerLogo {
  display: block;

  p {
    margin-bottom: 0;
  }
}

.headLink {
  transition: 0.5s;
  color: var(--black);
  opacity: 0.5;

  &:hover {
    opacity: 1;
  }

  &__active {
    opacity: 1;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
  opacity: 1;
  transition-delay: 0.3s;
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


.openMenu {
  display: inline-block;
  position: relative;
  width: 30px;
  height: 20px;

  &::before {
    content: '';
    position: absolute;
    top: 4px;
    left: 0;
    width: 100%;
    height: 3px;
    border-radius: 10px;
    background: #000;
    transform-origin: center;
    transition: top 0.4s 0.4s, transform 0.4s 0s;
  }

  &::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 0;
    width: 100%;
    height: 3px;
    border-radius: 10px;
    background: #000;
    transform-origin: center;
    transition: 0.4s;
    transition: bottom 0.4s 0.4s, transform 0.4s 0s;
  }



  &.active {
    &::before {
      top: 9px;
      transform: rotate(135deg);
      transition: top 0.4s 0s, transform 0.4s 0.4s;
    }

    &::after {
      transform: rotate(-135deg);
      bottom: 8px;
      transition: bottom 0.4s 0s, transform 0.4s 0.4s;
    }
  }
}

.wrap__head {
  position: fixed;
  right: 0;
  left: 0;
  top: 0;
  display: flex;
  padding-right: 1.2rem;
  align-items: center;
  justify-content: right;
  background: rgba(242, 242, 242, .65);
  backdrop-filter: saturate(180%) blur(20px);
  z-index: 1000;
  height: 48px;

  &_openMenu {
    background: transparent;
    backdrop-filter: none !important;
  }
}
</style>
