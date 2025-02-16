<template>
  <div class="pPr">
    <div class="pPr__head">
      <div class="row">
        <div class='col-12'>
          <h1 class="h1">{{ $t('proj.tit') }}</h1>
        </div>
        <div class='col-12'>
          <span class="h1">{{ (type == 'grid') ? projects.length : (type == 'list') ? filtPrCount : ''
            }}</span>
        </div>
      </div>
      <div class="tagList d-none d-lg-block">
        <button :class="`tag tag_d p1 ${(type == 'grid' ? 'active' : '')}`" @click="changeType('grid')">
          {{ $t('proj.btn.grid') }}
        </button>
        <button :class="`tag tag_d p1 ${(type == 'list' ? 'active' : '')}`" @click="changeType('list')">
          {{ $t('proj.btn.list') }}
        </button>
        <button :class="`tag tag_d p1 ${(type == 'map' ? 'active' : '')}`" @click="changeType('map')">
          {{ $t('proj.btn.map') }}
        </button>
      </div>
    </div>
    <SecProjPrFilt :cat="cat" :country="country" :year="year" @changeFilter="changeFilter" />
    <SecProjPrList :projects="filtPr || projects" v-if="type == 'list'" />
    <SecProjPrMap :projects="filtPr || projects" v-if="type == 'map'" />
    <SecProjPrGrid :projects="filtPr || projects" @changeFilt='changeFilt' v-if="type == 'grid'" />
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'projects',

  head() {
    const i18nHead = this.$nuxtI18nHead({ addSeoAttributes: true })
    return {
      title: this.$t('proj.tit'),
      htmlAttrs: {
        ...i18nHead.htmlAttrs
      },
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.$t('proj.tit'),
        },
        { rel: "canonical", href: "https://kerimovarchitects.com" + (this.$i18n.locale == "en" ? "/en" : '') + "/projects" },
        { rel: "alternate", hreflang: "ru-RU", href: "https://kerimovarchitects.com/projects" },
        {
          rel: "alternate",
          hreflang: "en-US",
          href: "https://kerimovarchitects.com/en/projects",
        },
      ],
    }
  },
  data: () => ({
    type: 'grid',
    filtPrCount: 0,
    filtCat: null,
    filtPr: null,
  }),

  async fetch({ store }) {
    await store.dispatch("getCCatPr");
    await store.dispatch("getCYearPr");
    await store.dispatch("getCCountryPr");
    await store.dispatch("getProjects");
  },

  computed: {
    ...mapState({
      cat: 'CCatPr',
      country: 'CCountryPr',
      year: 'CYearPr',
      projects: 'projects',
    }),
  },

  mounted() {
    window.scrollTo(0, 0);
    this.filtPrCount = this.projects.length;

    if (typeof localStorage !== 'undefined') {
      const savedType = localStorage.getItem('displayType');
      if (savedType) {
        this.type = savedType;
      }
    }
  },
  methods: {
    changeFilter(filter) {
      this.filtCat = filter
      this.filtPl()
    },
    filtPl() {
      let pr = this.projects;
      if (this.filtCat.cat) {
        pr = pr.filter(el => el.cat.find(el => el === this.filtCat.cat))
      }
      if (this.filtCat.year) {
        pr = pr.filter(el => el.year.find(el => el === this.filtCat.year))
      }
      if (this.filtCat.country) {
        pr = pr.filter(el => el.country.find(el => el === this.filtCat.country))
      }
      this.filtPr = pr;
    },
    changeFilt(count) {
      this.filtPrCount = count;
      if (this.filtPrCount <= 9) {
        this.filtPrCount = '0' + this.filtPrCount;
      }
    },
    changeType(type) {
      this.$store.dispatch('updateActivePr', null);
      this.type = type;

      if (typeof localStorage !== 'undefined') {
        localStorage.setItem('displayType', type);
      }
    },
  },
}

</script>
<style lang="scss" scoped>
.pPr__head {
  background: var(--white);
  padding: var(--main-pad);

  span {
    display: block;
    text-align: right;
  }

  span,
  h1 {
    @media (max-width: 767.98px) {
      font-weight: 500;
    }
  }
}
</style>
