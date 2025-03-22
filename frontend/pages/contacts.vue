<template>
  <div class="">
    <div class="contH">
      <div class="row">
        <div class='col-xl- offset-xl- col-lg- offset-lg- offset-md- col-24 offset- '>
          <h1 class="h1">{{ $i('cont.tit') }}</h1>
        </div>
      </div>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md- offset-md- col-18 offset-6 '>
        <p class="h2">{{ page[locale + '_tit'] }}</p>
      </div>
      <div v-if="page[locale + '_addres_l'].length" class="">
        <div v-for="item in page[locale + '_addres_l']">
          <div class="row">
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-5 offset-md-6 col-8 offset- '>
              <p class="p1 op-05 mp0">{{ item.name }}</p>
            </div>
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-10 offset-md-1 col-15 offset-1 '>
              <p class="p1 op-05 contH__btn mp0 socBtn">{{ item.link }}</p>
            </div>
          </div>
        </div>
      </div>
      <div v-if="page[locale + '_tel_l'].length" class="">
        <div v-for="(item, key) in page[locale + '_tel_l']">
          <div class="row">
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-5 offset-md-6 col-8 offset- '>
              <p class="p1 op-05 mp0">{{ item.name }}</p>
            </div>
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-1 col-15 offset-1 '>
              <a :href="`tel:${item.link}`" class="p1 contH__btn mp0 socBtn">{{ item.link }}</a>
            </div>
          </div>
        </div>
      </div>
      <div v-if="page[locale + '_email_l'].length" class="">
        <div v-for="item in page[locale + '_email_l']">
          <div class="row">
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-5 offset-md-6 col-8 offset- '>
              <p class="p1 op-05 mp0">{{ item.name }}</p>
            </div>
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-1 col-15 offset-1 '>
              <a :href="`mailto:${item.link}`" class="p1 mp0 contH__btn socBtn">{{ item.link }}</a>
            </div>
          </div>
        </div>
      </div>

      <div v-if="page[locale + '_soc'].length" class="row contH__links">
        <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-5 offset-md-6 col-8 offset- '>
          <p class="p1 op-05 mp0">{{ $i('cont.soc') }}</p>
        </div>
        <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-10 offset-md-1 col-15 offset-1 socW'>
          <a v-for="item in page[locale + '_soc']" :href="item.link" class="p1 mp0 socBtn">
            {{ item.name }}
          </a>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { useMain } from '~/store/main';

const store = useMain();

const { locale } = useI18n();

await store.getPage();

const page = computed(() => store.pages.find(el => el.id === 27));

const { data: pageInfo } = useAsyncData('pages',
  async () => {
    const [pages] = await Promise.all([
      $fetch('/wp-json/wp/v2/pages?per_page=100'),
    ]);

    return {
      pages,
    };
  },
  {
    lazy: false,
  }
);

const pageSSR = computed(() => pageInfo.value?.pages.find(el => el.id === 27));
const seoTitle = computed(() => {
  const key = locale.value + "_seo_tit";
  return pageSSR.value?.[key];
});

const seoDescription = computed(() => {
  const key = locale.value + "_seo_des";
  return pageSSR.value?.[key];
});

const canonicalUrl = computed(() => {
  return "https://kerimovarchitects.com" + (locale.value === "en" ? "/en/contacts" : "/contacts");
});

useSeoMeta({
  title: seoTitle,
  description: seoDescription,
  ogTitle: seoTitle,
  ogDescription: seoDescription,
  ogUrl: canonicalUrl,
  canonical: canonicalUrl,
});

useHead({
  link: [
    { rel: "alternate", hreflang: "ru-RU", href: "https://kerimovarchitects.com/contacts" },
    { rel: "alternate", hreflang: "en-US", href: "https://kerimovarchitects.com/en/contacts" },
  ]
});
</script>

<style lang="scss" scoped>
.socW {
  display: flex;
  flex-wrap: wrap;
  gap: 0 1rem;
}

.socBtn {
  text-decoration: none;
}

.btnOp {
  transition: 0.4s;

  &:hover {
    opacity: 0.5;
  }
}

.contH {
  margin-bottom: auto;
  height: calc(100vh - 158px);

  a {
    color: #9c9c9c;
    transition: 0.3s;

    &:hover {
      color: var(--black);
    }
  }

  &__btn {
    display: block;
    padding-bottom: 5px;
    margin-bottom: 10px;
    width: 100%;
  }

  padding: var(--main-pad);

  p {
    color: var(--black) !important;
  }

  h1 {
    @media (max-width: 767.98px) {
      font-weight: 500;
    }
  }
}

.contImgW {
  position: relative;
  width: 100%;
  height: 100%;

  img {

    top: 0;
    left: 0;
    width: 100%;
    height: auto;
    object-fit: cover;
  }
}
</style>
