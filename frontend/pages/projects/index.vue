<template>
  <div class="pPr">
    <div class="pPr__head">
      <div class="row">
        <div class='col-12'>
          <h1 class="h1">{{ $i('proj.tit') }}</h1>
        </div>
        <div class='col-12'>
          <span class="h1">{{ type === 'grid' ? projectsSSR.length : type === 'list' ? filtPrCount : '' }}</span>
        </div>
      </div>
      <div class="tagList d-none d-lg-block">
        <button :class="`tag tag_d p1 ${type === 'grid' ? 'active' : ''}`" @click="changeType('grid')">
          {{ $i('proj.btn.grid') }}
        </button>
        <button :class="`tag tag_d p1 ${type === 'list' ? 'active' : ''}`" @click="changeType('list')">
          {{ $i('proj.btn.list') }}
        </button>
        <button :class="`tag tag_d p1 ${type === 'map' ? 'active' : ''}`" @click="changeType('map')">
          {{ $i('proj.btn.map') }}
        </button>
      </div>
    </div>
    <SecProjPrFilt :cat="cat" :country="country" :year="year" @changeFilter="changeFilter" />
    <SecProjPrList :projects="filtPr || projectsSSR" v-if="type === 'list'" />
    <SecProjPrMap :projects="filtPr || projectsSSR" v-if="type === 'map'" />
    <SecProjPrGrid :projects="filtPr || projectsSSR" @changeFilt="changeFilt" v-if="type === 'grid'" />
  </div>
</template>

<script setup>
import { useMain } from '~/store/main';

const store = useMain();

const { locale } = useI18n()

const { data: pageInfo } = useAsyncData('projectsData', async () => {
  try {
    const [projects, categories, years, countries] = await Promise.all([
      $fetch('/wp-json/wp/v2/projects?per_page=100'),
      $fetch('/wp-json/wp/v2/cat?per_page=100'),
      $fetch('/wp-json/wp/v2/year?per_page=100'),
      $fetch('/wp-json/wp/v2/country?per_page=100')
    ]);

    return {
      projects: projects?.filter(el => el.status === 'publish') ?? [],
      categories: categories?.filter(el => el.count).sort((a, b) => b.order - a.order) ?? [],
      years: years?.filter(el => el.count).sort((a, b) => b.order - a.order) ?? [],
      countries: countries?.filter(el => el.count).sort((a, b) => b.order - a.order) ?? []
    };
  } catch (error) {
    console.error("Ошибка загрузки данных:", error);
    return { projects: [], categories: [], years: [], countries: [] };
  }
});

const projectsSSR = computed(() => pageInfo.value?.projects ?? []);
const cat = computed(() => pageInfo.value?.categories ?? []);
const country = computed(() => pageInfo.value?.countries ?? []);
const year = computed(() => pageInfo.value?.years ?? []);

const type = ref('grid');
const filtPrCount = ref(projectsSSR.value.length);
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
  let pr = [...projectsSSR.value];
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

const { $i } = useNuxtApp()
const seoTitle = computed(() => $i('proj.tit'));
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
