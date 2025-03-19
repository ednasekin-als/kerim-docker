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

<script setup>
import { useMain } from '~/store/main';

const store = useMain();
const { $i18n } = useNuxtApp();

const locale = computed(() => $i18n.locale);

await store.getProjects();
await store.getCCatPr();
await store.getCYearPr();
await store.getCCountryPr();

const projects = computed(() => store.projects);
const cat = computed(() => store.CCatPr);
const country = computed(() => store.CCountryPr);
const year = computed(() => store.CYearPr);

const type = ref('grid');
const filtPrCount = ref(projects.value.length);
const filtCat = ref(null);
const filtPr = ref(null);

onMounted(() => {
  window.scrollTo(0, 0);
  if (typeof localStorage !== 'undefined') {
    const savedType = localStorage.getItem('displayType');
    if (savedType) {
      type.value = savedType;
    }
  }
});

const changeFilter = (filter) => {
  filtCat.value = filter;
  filtPl();
};

const filtPl = () => {
  let pr = projects.value;
  if (filtCat.value?.cat) {
    pr = pr.filter(el => el.cat.includes(filtCat.value.cat));
  }
  if (filtCat.value?.year) {
    pr = pr.filter(el => el.year.includes(filtCat.value.year));
  }
  if (filtCat.value?.country) {
    pr = pr.filter(el => el.country.includes(filtCat.value.country));
  }
  filtPr.value = pr;
};

const changeFilt = (count) => {
  filtPrCount.value = count < 10 ? '0' + count : count;
};

const changeType = (newType) => {
  store.updateActivePr(null);
  type.value = newType;
  if (typeof localStorage !== 'undefined') {
    localStorage.setItem('displayType', newType);
  }
};

const seoTitle = computed(() => $i18n.t('proj.tit'));
const canonicalUrl = computed(() => `https://kerimovarchitects.com${locale.value === 'en' ? '/en/projects' : '/projects'}`);

useSeoMeta({
  title: seoTitle,
  description: seoTitle,
  ogTitle: seoTitle,
  ogDescription: seoTitle,
  ogUrl: canonicalUrl,
  canonical: canonicalUrl,
});

useHead({
  link: [
    { rel: 'alternate', hreflang: 'ru-RU', href: 'https://kerimovarchitects.com/projects' },
    { rel: 'alternate', hreflang: 'en-US', href: 'https://kerimovarchitects.com/en/projects' },
  ],
});
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
