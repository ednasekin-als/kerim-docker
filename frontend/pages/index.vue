<template>
  <div class="main-projects">
    <div class="main-projects__content">
      <div class="main-projects__intro">
        <img v-if="page[$i18n.locale + '_m_img']" :src="page[$i18n.locale + '_m_img']" alt="">
        <div class="main-projects__info">
          <div class="main-projects__title">
            <h1 class="h1">Kerimov Architects</h1>
          </div>
          <div class="main-projects__descr">
            <span> {{ $t('main.tit1') }}</span>
          </div>
          <div class="main-projects__link">
            <NuxtLink :to="localePath('/projects')" class=" btn p1 d-inline-block ">
              {{ $t('main.btn.proj') }}
            </NuxtLink>
          </div>
        </div>
      </div>
      <div class="main-projects__intro" v-for="(item, key) in filteredProjects">
        <img :src="item.r_img1 || item[$i18n.locale + '_img1']" alt="">
        <div class="main-projects__info">
          <div class="main-projects__title">
            <h1 class="h1">{{ item[$i18n.locale + '_tit'] }}</h1>
            <span class="h1 ttu" style="padding-left: 1em;">
              {{ ((key + 1) > 9) ? (key + 1) : '0' + (key + 1) }}
            </span>
          </div>
          <div class="tagList">
            <span class="tag p1">
              {{cat?.find(el => el.id == item.cat[0])[$i18n.locale + '_tit']}}
            </span>
          </div>
          <div class="main-projects__link">
            <NuxtLink :to="localePath(`/projects/${item.slug}`)" class="btn p1 d-inline-block">
              {{ $t('main.btn.projD') }}
            </NuxtLink>
          </div>
        </div>
      </div>
      <div class="main-projects__miniature">
        <div class="main-projects__info">
          <h1 class="h1">Kerimov Architects</h1>
          <span> {{ $t('main.tit1') }}</span>
          <div class="main-projects__link">
            <NuxtLink :to="localePath('/about')" class=" btn btn_d p1 d-inline-block ">
              {{ $t('main.btn.about') }}
            </NuxtLink>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'index',

  async fetch({ store }) {
    await store.dispatch('getPage');
    await store.dispatch('getProjects');
    await store.dispatch('getCCatPr');
  },

  head() {
    const i18nHead = this.$nuxtI18nHead({ addSeoAttributes: true })
    return {
      title: this.page[this.$i18n.locale + '_seo_tit'],
      htmlAttrs: {
        ...i18nHead.htmlAttrs
      },
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.page[this.$i18n.locale + '_seo_des'],
        },
        { rel: "canonical", href: "https://kerimovarchitects.com" + (this.$i18n.locale == "en" ? "/en" : '') },
        { rel: "alternate", hreflang: "ru-RU", href: "https://kerimovarchitects.com" },
        {
          rel: "alternate",
          hreflang: "en-US",
          href: "https://kerimovarchitects.com/en",
        },
      ],
    }
  },

  computed: {
    ...mapState({
      pages: 'pages',
      cat: 'CCatPr',
      projects: 'projects'
    }),

    page() {
      return this.pages.find((el) => el.id === 21)
    },

    filteredProjects() {
      return this.projects.slice(0, 4);
    },
  },

  mounted() {
    window.scrollTo(0, 0);
  },
}
</script>


<style scoped lang="scss">
.main-projects {
  margin-top: 0px;
  display: flex;
  flex-direction: column;

  &__content {
    height: 100%;
  }

  &__miniature,
  &__intro {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100vh;
  }

  &__intro {

    img {
      z-index: 1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
      height: 100vh;
      object-fit: cover;
    }

    &:first-child {
      @media (max-width: 767.98px) {
        .main-projects__title {
          margin-top: 45px;
        }

        .main-projects__link {
          margin-bottom: 65px;
        }
      }
    }
  }


  &__info {
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 2;
    height: 100%;
    padding: var(--main-pad);

    .tag {
      color: #fff !important;
    }
  }

  &__miniature {
    h1 {
      margin-top: 30px;

      @media (max-width: 950px) {
        margin-top: 45px;
      }
    }

    @media (max-width: 767.98px) {
      height: 100vh;

      .main-projects__link {
        margin-bottom: 60px;
      }
    }
  }

  &__descr {
    span {
      color: #fff !important;
    }
  }

  &__title {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;

    @media (max-width: 950px) {
      margin-top: 45px;
    }

    span,
    h1 {
      color: #fff !important;
    }
  }

  &__link {
    margin-top: auto;

    @media (max-width: 950px) {
      margin-bottom: 45px;
    }
  }
}

body {
  overflow: hidden !important;
}

.phoneLogo {
  svg {
    width: 80%;
    max-width: 550px;
    height: auto;
    margin-bottom: var(--main-pad);
  }
}
</style>
