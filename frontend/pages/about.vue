<template>
  <div class="">
    <div class="AbPad AbFirst">
      <div class="row">
        <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md- col-20 offset- '>
          <h1 class="h1">{{ page[locale + '_tit'] }}</h1>
        </div>
      </div>
      <p class="h2" v-html="page[locale + '_tit_sm']"></p>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18'>
        <p class="p1 postContent">
          {{ stripAllTags(page[locale + '_val1']) }}
        </p>
      </div>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18'>
        <p class="p1 postContent">
          {{ stripAllTags(page[locale + '_val2']) }}
        </p>
      </div>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18'>
        <p class="p1 postContent">
          {{ stripAllTags(page[locale + '_val3']) }}
        </p>
      </div>
    </div>
    <ClientOnly>
      <CompTeamGal :teamData="page[locale + '_team']" />
    </ClientOnly>
    <div v-for="(itemL, key) in page[locale + '_inf']" class="AbPad">
      <p class="h2 mp0 btnUL">
        {{ itemL.name }}
      </p>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 '>
        <div class="p1 postContent -t-1r" v-html="itemL.pos"></div>
      </div>
    </div>
    <img v-if="page[locale + '_img_big0']" :src="page[locale + '_img_big0']" alt="" class="w-100">

    <div v-if="page[locale + '_aww_list'].length" class="AbPad">
      <div class="AbPad__title">
        <p class="h2">
          {{ page[locale + '_aww_tit'] }}
        </p>
        <sup>
          {{ page[locale + '_aww_list'].length }}
        </sup>
      </div>
      <div v-for="(item, key) in page[locale + '_aww_list'].slice(0, awwLCount)" class="awwI row position-relative">
        <div class="col-24 col-md-18 offset-md-6">
          <div class="line m-t-1r m-b-1r op-05"></div>
        </div>
        <div v-if="!(key % 2)"
          class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 position-static'>
          <a v-if="item.link" class="awwI__link p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name
          }}</a>
          <p v-else class="awwI__link p1 mp0">{{ item.name }}</p>
          <img v-if="item.img" class="awwI__img d-none d-lg-block" :src="item.img" alt="">
        </div>
        <div v-else
          class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18 offset-6 position-static'>
          <a v-if="item.link" class="awwI__link p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name
          }}</a>
          <p v-else class="awwI__link p1 mp0">{{ item.name }}</p>
          <img v-if="item.img" class="awwI__img d-none d-lg-block" :src="item.img" alt="">
        </div>
      </div>

      <div v-if="awwLCount < page[locale + '_aww_list'].length"
        class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 m-t-1r m-b-1r'>
        <div class="line op-05 m-b-1r"></div>
        <button @click="awwLCount = awwLCount + 10" class="p1 btnVM ">
          <span class="btnVM__txt">
            {{ $i('menu.more') }}
          </span>
          <span class="material-symbols-outlined">
            <svg width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom"
                transform="translate(0 24) rotate(-90)">
                <rect id="view-box" width="24" height="24" fill="none" />
                <path id="Shape"
                  d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z"
                  transform="translate(14.75 17.75) rotate(180)" fill="#141124" />
              </g>
            </svg>
          </span>
        </button>
      </div>

    </div>

    <div v-if="page[locale + '_pub_list'].length" class="AbPad">
      <div class="AbPad__title">
        <p class="h2" id="publication">
          {{ page[locale + '_pub_tit'] }}
        </p>
        <sup>
          {{ page[locale + '_pub_list'].length }}
        </sup>
      </div>

      <div class="row">
        <div class='col-xl-5 offset-xl-6 col-lg-5 offset-lg-6 col-md-5 offset-md-6 col-24 offset-1 '>
        </div>
        <div class='col-xl-11 offset-xl-1 col-lg-11 offset-lg-1 col-md-11 offset-md-1 col-18 offset-6 '>
          <!-- <a class="p1 mp0">{{ page[locale + '_pub_list'][0].name }}</a> -->
          <a v-if="page[locale + '_pub_list'][0].link" class="p1 mp0 abLink" target="_blank"
            :href="page[locale + '_pub_list'][0].link">
            {{ page[locale + '_pub_list'][0].name }}
          </a>
          <p v-else class="p1 mp0">{{ item.name }}</p>
        </div>
      </div>
      <div v-for="(item, key) in page[locale + '_pub_list'].slice(1, pubLCount)" class="row">
        <div class="col-24 col-md-18 offset-md-6">
          <div class="line m-t-1r m-b-1r op-05"></div>
        </div>
        <div v-if="!(key % 2)" class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 '>
          <a v-if="item.link" class="p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name }}</a>
          <p v-else class="p1 mp0">{{ item.name }}</p>
        </div>
        <div v-else class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18 offset-6 '>
          <a v-if="item.link" class="p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name }}</a>
          <p v-else class="p1 mp0">{{ item.name }}</p>
        </div>
      </div>
      <div v-if="pubLCount < page[locale + '_pub_list'].length"
        class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 m-t-1r m-b-1r'>
        <div class="line op-05 m-b-1r"></div>
        <button @click="pubLCount = pubLCount + 10" class="p1 btnVM ">
          <span class="btnVM__txt">
            {{ $i('menu.more') }}
          </span>
          <span class="material-symbols-outlined">
            <svg width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom"
                transform="translate(0 24) rotate(-90)">
                <rect id="view-box" width="24" height="24" fill="none" />
                <path id="Shape"
                  d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z"
                  transform="translate(14.75 17.75) rotate(180)" fill="#141124" />
              </g>
            </svg>
          </span>
        </button>
      </div>
    </div>


    <button @click="toggler = !toggler" v-if="page[locale + '_img_big2_vid'] && page[locale + '_img_big2']"
      class="openVid">
      <div class="wrapSvg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" height="48" viewBox="0 -960 960 960" width="48">
          <path d="M372-295v-372l292 186-292 186Zm22-186Zm0 145 230-145-230-145v290Z" />
        </svg>
      </div>
      <img :src="page[locale + '_img_big2']" alt="" class="w-100">
    </button>
    <img v-if="page[locale + '_img_big2'] && !page[locale + '_img_big2_vid']" :src="page[locale + '_img_big2']" alt=""
      class="w-100">
    <div v-if="page[locale + '_eve_list'].length" class="AbPad">
      <div class="AbPad__title">
        <p class="h2" id="event" v-html="page[locale + '_eve_tit']"></p>
        <sup>
          {{ page[locale + '_eve_list'].length }}
        </sup>
      </div>
      <div class="row">
        <div class='col-xl-5 offset-xl-6 col-lg-5 offset-lg-6 col-md-5 offset-md-6 col-24 offset-1 '>
        </div>
        <div class='col-xl-11 offset-xl-1 col-lg-11 offset-lg-1 col-md-11 offset-md-1 col-18 offset-6 '>
          <a v-if="page[locale + '_eve_list'][0].link" class="p1 mp0 abLink" target="_blank"
            :href="page[locale + '_eve_list'][0].link">
            {{ page[locale + '_eve_list'][0].name }}
          </a>
          <p v-else class="p1 mp0">{{ page[locale + '_eve_list'][0].name }}</p>
        </div>
      </div>
      <div v-for="(item, key) in page[locale + '_eve_list'].slice(1, eveLCount)" class="row">
        <div class="col-24 col-md-18 offset-md-6">
          <div class="line m-t-1r m-b-1r op-05"></div>
        </div>
        <div v-if="!(key % 2)" class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 '>
          <a v-if="item.link" class="p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name }}</a>
          <p v-else class="p1 mp0">{{ item.name }}</p>
        </div>
        <div v-else class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-18 offset-6 '>
          <a v-if="item.link" class="p1 mp0 abLink" target="_blank" :href="item.link">{{ item.name }}</a>
          <p v-else class="p1 mp0">{{ item.name }}</p>
        </div>
      </div>
      <div v-if="eveLCount < page[locale + '_eve_list'].length"
        class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0 m-t-1r m-b-1r'>
        <div class="line op-05 m-b-1r"></div>
        <button @click="eveLCount = eveLCount + 10" class="p1 btnVM ">
          <span class="btnVM__txt">
            {{ $i('menu.more') }}
          </span>
          <span class="material-symbols-outlined">
            <svg width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <g id="_24x24_On_Light_Arrow-Bottom" data-name="24x24/On Light/Arrow-Bottom"
                transform="translate(0 24) rotate(-90)">
                <rect id="view-box" width="24" height="24" fill="none" />
                <path id="Shape"
                  d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z"
                  transform="translate(14.75 17.75) rotate(180)" fill="#141124" />
              </g>
            </svg>
          </span>
        </button>
      </div>
    </div>

    <div v-if="page[locale + '_vac_list'].length" class="AbPad">
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md- col-20 offset- m-t-2r'>
        <p id="vacancy" class="h2 mp0 btnUL">{{ $i('vac') }}</p>
      </div>
      <p class="p1 op-05 mp0" v-html="page[locale + '_vac_tit']"></p>
      <div class="accordion-container accI">
        <div v-for="(item, key) in page[locale + '_vac_list']" :key="key" class="row ac m-b-2r">
          <div class="vacancy__field col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0">
            <div class="ac-trigger h2 m-b-05r d-flex align-items-center" @click="toggleAccordion(key)">
              <p class="h2 mp0 btnUL">{{ item.name }}</p>
              <span class="arrow" :class="{ open: openAccordions.includes(key) }">
                <span></span><span></span>
              </span>
            </div>
            <p class="p1 mp0">{{ stripAllTags(item.val) }}</p>
          </div>
          <div class="ac-panel-wrapper" ref="accordionPanels" :class="{ open: openAccordions.includes(key) }" :style="getPanelStyle(key)">
            <div class="ac-panel">
              <div class="w-100">
                <div v-for="(itemL, index) in item.list" :key="index">
                  <div class="col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset-0">
                    <p class="p1 mp0 btnUL">{{ itemL.name }}</p>
                  </div>
                  <div class="col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-20 offset-4">
                    <div class="p1 postContent p-t-1r" v-html="itemL.val"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <img v-if="page[locale + '_img_big3']" :src="page[locale + '_img_big3']" alt="" class="w-100">
    <ClientOnly>
      <transition name="pop1">
        <FsLightbox :exitFullscreenOnClose="true" v-if="page[locale + '_img_big2_vid']" :toggler="toggler" :sources="[
          page[locale + '_img_big2_vid']
        ]" />
      </transition>
    </ClientOnly>
    <transition name="pop1">
      <CompPopTeam v-if="popT" :team="popT" @closePopT="closePopT()" />
    </transition>

  </div>
</template>

<script setup>
import FsLightbox from "fslightbox-vue";
import { useMain } from '~/store/main';

const store = useMain();
const { locale } = useI18n()

const toggler = ref(false);
const awwLCount = ref(10);
const pubLCount = ref(10);
const eveLCount = ref(10);
const popT = ref(null);
const openAccordions = ref([]);
const accordionPanels = ref([]);

await store.getPage();

const getPanelStyle = (index) => {
  const panel = accordionPanels.value[index];
  if (!panel) return {};

  return openAccordions.value.includes(index)
    ? { maxHeight: panel.scrollHeight + 'px', opacity: 1 }
    : { maxHeight: '0', opacity: 0 };
};

const stripAllTags = (html) => {
  if (!html) return "";
  let text = html.replace(/<\/?[a-z][^>]*>/g, "");
  text = text.replace(/&nbsp;/g, " ");
  text = text.replace(/\s+/g, ' ').trim();

  return text;
};

const toggleAccordion = (index) => {
  if (openAccordions.value.includes(index)) {
    openAccordions.value = openAccordions.value.filter((i) => i !== index);
  } else {
    openAccordions.value.push(index);
  }
};

const page = computed(() => store.pages.find(el => el.id === 24));
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

const pageSSR = computed(() => pageInfo.value?.pages.find(el => el.id === 24));
const seoTitle = computed(() => pageSSR.value?.[locale.value + "_seo_tit"]);
const seoDescription = computed(() => pageSSR.value?.[locale.value + "_seo_des"]);
const canonicalUrl = computed(() => `https://kerimovarchitects.com${locale.value === "en" ? "/en" : ""}/about`);

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
    { rel: "alternate", hreflang: "ru-RU", href: "https://kerimovarchitects.com/about" },
    { rel: "alternate", hreflang: "en-US", href: "https://kerimovarchitects.com/en/about" },
  ],
});
</script>

<style lang="scss" scoped>
.arrow {
  width: 4px;
  height: 1.25rem;
  display: inline-block;
  position: relative;
  margin: 0 1rem;
  cursor: pointer;
}

.arrow span {
  top: 0.5rem;
  position: absolute;
  width: 10px;
  height: 2px;
  background-color: #000;
  display: inline-block;
  transition: all 0.2s ease;
  border-radius: 25px;

}

.arrow span:first-of-type {
  left: 0;
  transform: rotate(-45deg);
}

.arrow span:last-of-type {
  right: 0;
  transform: rotate(45deg);
}

.is-active .arrow span:first-of-type {
  transform: rotate(45deg);
}

.is-active .arrow span:last-of-type {
  transform: rotate(-45deg);
}

.awwI__img {
  position: absolute;
  top: 0;
  left: 0;
  width: 9vw;
  height: 9vw;
  object-fit: contain;
  opacity: 0;
  transition: 0.7s;
}


.vacancy {
  &__field {
    margin-top: 0rem;
    margin-bottom: 1rem;
    border-bottom: 1px solid #828282;

    p {
      margin-bottom: 0;
    }

    .p1 {
      margin-bottom: 1rem;
    }

    svg {
      height: 30px;
      width: 30px;
    }
  }
}


.awwI__link {
  &:hover {
    &+.awwI__img {
      opacity: 1;
    }
  }
}

.openVid {
  position: relative;

  .wrapSvg {
    position: absolute;
    width: 200px;
    height: 200px;
    min-width: 13vw;
    min-height: 13vw;
    top: 50%;
    left: 50%;
    height: auto;
    transform: translate(-50%, -50%);

    svg {
      width: 200px;
      height: 200px;
      min-width: 13vw;
      min-height: 13vw;
      transition: 0.5s;
      transform-origin: center;
      transform: scale(1);
    }

  }

  &:hover {
    svg {
      transform: scale(1.3);
    }
  }
}

.AbPad {
  padding: var(--main-pad);

  .h2 {
    margin-bottom: 0.5rem;

    @media (max-width: 767.98px) {
      font-weight: 500;
      font-size: 3.8888888889vw;
    }
  }

  p {
    opacity: 1;
    color: var(--black);
  }

  sup {
    top: 7px;
    font-size: 18px;
    left: 7px;

    @media (max-width: 767.98px) {
      font-weight: 500;
    }
  }

  &__title {
    display: flex;
  }
}

.abLink {
  opacity: 0.5;
  color: var(--black);
  text-decoration: none;
  transition: 0.3s;

  &:hover {
    opacity: 1;
  }
}

.btnVM {
  display: flex;
  align-items: center;
  color: var(--black);

  &__txt {
    text-decoration: none;

  }

  .material-symbols-outlined {
    font-size: 1.4em;

    svg {
      height: 1.5rem;
      width: 1.5rem;
    }
  }
}
</style>

<style lang="scss">
.splide {
  display: flex;
  flex-direction: column-reverse;
}

.splide__slide {
  cursor: grab;
}

.splide__arrows {
  padding: var(--main-pad);
  display: flex;
  justify-content: center;
}

.splide__arrow {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 30px;
  height: 30px;
  // background-color: rgba(0, 0, 0, 0.8);
  color: var(--black);
  fill: currentColor;
  transition: 0.3s;
  // border-radius: var(--btn-rad);
  margin: var(--btn-rad);

  svg {
    width: 40%;
    height: auto;
  }

  &:disabled {
    opacity: 0.5;
  }
}

.splide__arrow--prev {
  svg {
    transform: rotate(180deg);
  }
}

.AbTeam {
  .swiper-pagination-bullet-active {
    background: var(--black);
  }

  .swiper-pagination-bullet {
    background-color: var(--black) !important;
  }
}
</style>
