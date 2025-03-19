<template>
  <div v-if="post" class="PrDet">
    <div class="PrDet__head">
      <div class="row">
        <div class='col-12'>
          <h1 class="h1 tt">{{ post[$i18n.locale + '_tit'] }}</h1>
        </div>
        <div class='col-12'>
          <span class="h1 number-project">{{ ((postIndex + 1) > 9) ? (postIndex + 1) : '0' + (postIndex + 1)
            }}</span>
        </div>
      </div>
      <p class="h2">
        {{ post[$i18n.locale + '_tit1'] }}
      </p>
      <div class=''>
        <div v-for="item in post[$i18n.locale + '_list']">
          <div class="row align-items-baseline">
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-5 offset-md-6 col-12 offset- '>
              <p class="p1 op-05 mp0">{{ item.name }}</p>
            </div>
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-10 offset-md-1 col-11 offset-1 '>
              <span class="p1 PrDet__descr postContent mp0" v-html="item.det"></span>
            </div>
          </div>
          <div class="col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md-6 col-24 offset- ">
            <div class="line op-05 m-t-05r m-b-05r"></div>
          </div>
        </div>
      </div>
      <div v-if="post[$i18n.locale + '_img_l']" class="PrDet__aww row align-items-center offset-6">
        <div class="col-lg-2 col-4 achievements">
          <img :src="post[$i18n.locale + '_img_l']" alt="">
        </div>
        <div class="col-lg-21 offset-lg-1 col-19 offset-1">
          <p class="h2">
            {{ post[$i18n.locale + '_tit2'] }}
          </p>
        </div>
      </div>
      <p v-else class="h2">
        {{ post[$i18n.locale + '_tit2'] }}
      </p>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md- offset-md- col-18 offset-6 PrDet__text'>
        <p class="p1 postContent" v-html="post[$i18n.locale + '_val1']"></p>
      </div>
      <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-12 offset-md-12 col-24 offset- '>
        <p class="p1 postContent" v-html="post[$i18n.locale + '_val2']"></p>
      </div>

    </div>
    <div class="PrDet__gal">
      <div v-for="(item, key) in post['gal']" :key="key" class="PrDet__img" :style="`${(item.width)}`">
        <span class="p1 pad-l-r m-b-05r d-block" v-html="item[$i18n.locale + '_name']"></span>
        <div class="PrDet__imgW position-relative">
          <div v-if="item.vid" class="PrDet__svgW">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M100 50C100 77.6142 77.6142 100 50 100C22.3858 100 0 77.6142 0 50C0 22.3858 22.3858 0 50 0C77.6142 0 100 22.3858 100 50Z"
                fill="#EBEAEF" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M40 38.2849C40 34.2037 44.4347 31.6673 47.9524 33.7366L67.3985 45.1755C70.8672 47.2158 70.8672 52.2319 67.3985 54.2721L47.9524 65.7111C44.4347 67.7803 40 65.2439 40 61.1627V38.2849Z"
                fill="#79797B" />
            </svg>
          </div>
          <img @click="clickImg(key)" :src="item.img" loading="lazy" alt="" class="">
        </div>
      </div>
      <div v-for="(item, key) in post['gal_m']" class="PrDet__img">
        <img @click="clickImg(post['gal'].length + key || key)" :src="item" loading="lazy" alt="" class="">
      </div>

    </div>
    <div class="PrSlider">
      <SecProjPrSlider :projects="filteredProjects" />
    </div>
    <ClientOnly>
      <transition name="pop1">
        <div v-if="toggler" class="modal" @click="closeModal">
          <div class="modal-content" @click.stop>
            <!-- Slider -->
            <div v-swiper="swiperOption" class="PrDet__slider">
              <div class="swiper-wrapper">
                <div v-for="(item, key) in allGal" :key="key" class="swiper-slide">
                  <template v-if="item && isYouTubeVideo(item)">
                    <div class="PrDet__slide">
                      <iframe width="90%" height="400" :src="embedYouTubeURL(item)" frameborder="0"
                        allowfullscreen></iframe>
                    </div>
                  </template>
                  <template v-else>
                    <div class="PrDet__slide">
                      <img :src="item" alt="">
                    </div>
                  </template>
                </div>
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-pagination"></div>
              <button class="PrDet__close" @click="closeModal">
                <svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Cross"
                  data-name="24x24/On Light/Cross" xmlns="http://www.w3.org/2000/svg">
                  <rect id="view-box" width="24" height="24" fill="none" />
                  <path id="Shape"
                    d="M9.291,10.352l-4-4-4.005,4A.75.75,0,1,1,.22,9.291l4.005-4L.22,1.281A.75.75,0,0,1,1.281.22L5.286,4.225l4-4.005a.75.75,0,1,1,1.061,1.061l-4,4.005,4,4a.75.75,0,0,1-1.061,1.061Z"
                    transform="translate(6.629 6.8)" fill="#141124" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </transition>
    </ClientOnly>

  </div>
</template>
<script>

export default {
  name: "ProjectsItem",
  head() {
    const i18nHead = this.$nuxtI18nHead({ addSeoAttributes: true })
    return {
      title: this.post[this.$i18n.locale + '_seo_tit'] || this.post[this.$i18n.locale + '_tit'],
      htmlAttrs: {
        ...i18nHead.htmlAttrs
      },
      meta: [
        {
          hid: 'description',
          name: 'description',
          content: this.post[this.$i18n.locale + '_seo_des'],
        },
        { rel: "canonical", href: "https://hookahplace.ru" + (this.$i18n.locale == "en" ? "/en" : '') + "/projects/" + this.slug },
        { rel: "alternate", hreflang: "ru-RU", href: "https://hookahplace.ru/projects/" + this.slug },
        {
          rel: "alternate",
          hreflang: "en-US",
          href: "https://hookahplace.ru/en/projects/" + this.slug,
        },
      ],
    }
  },
  data() {
    return {
      slug: this.$route.params.slug,
      toggler: false,
      slide: 1,
      allGal: [],
      swiperOption: {
        slidesPerView: 1,
        allowTouchMove: true,
        clickable: true,
        mousewheel: {
          forceToAxis: true,
        },
        bulletClass: 'swiper-pagination-bullet',
        keyboard: {
          enabled: true,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderFraction: function (currentClass, totalClass) {
            return '<span class="' + currentClass + '"></span>' + ' <small>/ ' + '<span class="' + totalClass + '"></span></small>';
          }
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      }
    }
  },
  computed: {
    projects() {
      // return this.$store.state.projects;
    },
    filteredProjects() {
      return this.projects.filter(project => project.slug !== this.slug);
    },
    posts() {
      // return this.$store.state.projects;
    },
    post() {
      return this.posts.find(el => el.slug === this.slug);
    },
    postIndex() {
      return this.posts.findIndex(el => el.slug === this.slug);
    },
    nextPost() {
      const nextIndex = this.postIndex + 1;
      return nextIndex < this.posts.length ? this.posts[nextIndex] : null;
    }
  },
  mounted() {
    // Прокрутка страницы вверх после полной загрузки

    this.$nextTick(() => {
      window.scrollBy(0, 1);
    });
    this.$nextTick(() => {
      window.scrollTo({ top: 1, behavior: 'smooth' });

      // В Safari smooth scrolling не всегда работает, поэтому добавим задержку
      setTimeout(() => {
        window.scrollBy(0, 1);
        window.scrollTo(0, 1);
      }, 300);
    });
    // Задержка вызова window.scrollTo для Safari
    setTimeout(() => {
      window.scrollBy(0, 1);
      window.scrollTo(0, 1);
    }, 0);
    this.post?.gal?.forEach(el => {
      if (typeof el.vid === 'string') {
        this.allGal.push(el.vid);
      } else if (typeof el.img === 'string') {
        this.allGal.push(el.img);
      }
    })
    this.post?.gal_m?.forEach(el => {
      if (typeof el === 'string') {
        this.allGal.push(el);
      }
    })
    // this.$store.dispatch('updateActivePr', this.post);
  },
  beforeDestroy() {
    // this.$store.dispatch('updateActivePr', null)
  },
  methods: {
    // Проверяет, является ли ссылка на YouTube видео
    isYouTubeVideo(url) {
      return typeof url === 'string' && (url.includes("youtu.be") || url.includes("youtube.com"));
    },
    // Возвращает URL для вставки видео YouTube
    embedYouTubeURL(url) {
      // Если ссылка содержит youtu.be, то берем последнюю часть после /
      if (url.includes("youtu.be")) {
        const videoId = url.split("/").pop();
        return `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1`;
      } else if (url.includes("youtube.com")) { // Если ссылка содержит youtube.com
        // Парсим параметры из URL
        const urlParams = new URLSearchParams(new URL(url).search);
        const videoId = urlParams.get("v");
        return `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1`;
      } else {
        return url; // Если не YouTube ссылка, возвращаем как есть
      }
    },
    clickImg(key) {
      this.toggler = true;
      this.slide = key + 1;
      this.swiperOption.initialSlide = key;
    },
    closeModal() {
      this.toggler = false;
    },
  },
  async asyncData({ app }) {
    await app.store.dispatch("getProjects");
    await app.store.dispatch("getPage");
  }
}
</script>
<style lang="scss" scoped>
.number-project {
  text-align: right;
  display: block;
}

.swiper-button-prev:after,
.swiper-container-rtl .swiper-button-next:after,
.swiper-button-next:after,
.swiper-container-rtl .swiper-button-prev:after {
  content: "";
}

.swiper-button-next,
.swiper-button-prev {
  height: 50px;
  width: 50px;

  @media (max-width: 950px) {
    display: none;
  }
}


.swiper-button-prev {
  &:after {
    background: no-repeat 50%/95% url('data:image/svg+xml,<%3Fxml version="1.0" encoding="utf-8"%3F><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --><svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Arrow-Left" data-name="24x24/On Light/Arrow-Left" xmlns="http://www.w3.org/2000/svg"><rect id="view-box" width="24" height="24" fill="none"/><path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="%23141124"/></svg>'), rgba(242, 242, 242, .65) !important;
    border-radius: 50%;
    height: 50px;
    transition: all .3s ease-in-out;
    width: 50px;
    backdrop-filter: saturate(180%) blur(20px);
  }

  &:hover {
    &:after {
      background: no-repeat 50%/95% url('data:image/svg+xml,<%3Fxml version="1.0" encoding="utf-8"%3F><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --><svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Arrow-Left" data-name="24x24/On Light/Arrow-Left" xmlns="http://www.w3.org/2000/svg"><rect id="view-box" width="24" height="24" fill="none"/><path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(14.75 17.75) rotate(180)" fill="%23141124"/></svg>'), rgba(242, 242, 242, .65) !important;
      transform: scale(1.3);
    }
  }
}

.swiper-button-next {
  &:after {
    background: no-repeat 50%/95% url('data:image/svg+xml,<%3Fxml version="1.0" encoding="utf-8"%3F><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --><svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Arrow-Right" data-name="24x24/On Light/Arrow-Right" xmlns="http://www.w3.org/2000/svg"><rect id="view-box" width="24" height="24" fill="none"/><path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(9.25 6.25)" fill="%23141124"/></svg>'), rgba(242, 242, 242, .65) !important;
    border-radius: 50%;
    height: 50px;
    transition: all .3s ease-in-out;
    width: 50px;
    backdrop-filter: saturate(180%) blur(20px);
  }

  &:hover {
    &:after {
      background: no-repeat 50%/95% url('data:image/svg+xml,<%3Fxml version="1.0" encoding="utf-8"%3F><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools --><svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Arrow-Right" data-name="24x24/On Light/Arrow-Right" xmlns="http://www.w3.org/2000/svg"><rect id="view-box" width="24" height="24" fill="none"/><path id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(9.25 6.25)" fill="%23141124"/></svg>'), rgba(242, 242, 242, 0.65) !important;
      transform: scale(1.3);
    }
  }

}


.PrDet__slide {
  height: 100vh;
  text-align: center;
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  justify-content: center;
  align-items: center;

  img {
    height: 100%;
    width: 90%;
    object-fit: contain;

    @media (max-width: 950px) {
      width: 100%;
    }
  }
}

.PrDet__aww {
  @media (max-width: 768px) {
    display: flex;
    margin-top: 40px;
    flex-direction: column;
    margin-left: 0px !important;
    align-items: flex-start !important;

    .offset-1 {
      max-width: 100% !important;
      margin-left: 0 !important;
    }

    .achievements {
      justify-content: left;
      display: flex;
      flex: 100%;
      text-align: center;
      max-width: 100%;
      margin-bottom: 10px;

      img {
        width: 150px;
        height: auto;
      }
    }
  }
}

.PrDet__close {
  height: 50px;
  width: 50px;
  position: absolute;
  top: 5px;
  right: 5px;
  margin: 0px;
  z-index: 1000;
  background: rgba(242, 242, 242, .65);
  backdrop-filter: saturate(180%) blur(20px);
  border-radius: 50%;
  margin: var(--btn-rad);
  fill: #ddd !important;

  @media (max-width: 950px) {
    top: 20px;
  }

  @media (max-width: 414.98px) {
    width: 40px;
    height: 40px;
  }

  svg {
    height: 40px;
    width: 40px;

    @media (max-width: 414.98px) {
      width: 30px;
      height: 30px;
    }
  }

}

.modal {
  backdrop-filter: blur(10px);
  background: linear-gradient(hsla(0, 0%, 100%, .7), #fff 1810%) !important;
  display: block;
  width: 100%;
  height: 100%;
  z-index: 1000 !important;
  position: fixed;
  top: 0;
  left: 0;
  user-select: none;
  touch-action: none;
}

.PrNext {
  position: relative;
  // aspect-ratio: 16/9;
  min-height: 50vh;

  img {
    position: absolute;
    object-fit: cover;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    filter: brightness(0.8);
  }

  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: var(--main-pad);
}

.PrNext__title {
  position: relative;
  z-index: 2;
  color: var(--white);
}

.PrNext__btn {
  display: inline-block;
  position: relative;
  z-index: 2;
  padding: 1rem;

  transition: 0.4s;

  &:hover {
    border: 1px solid transparent;
    color: var(--bg);
    background: rgba(242, 242, 242, .65);
    backdrop-filter: saturate(180%) blur(20px);
  }
}

.PrDet {
  background: var(--white);
  color: var(--black);
}

@media (max-width: 950px) {
  .PrDet__text {
    max-width: 100% !important;
    margin-left: 0px !important;
  }
}



.PrDet__head {
  padding: var(--main-pad);

  .h2,
  span,
  h1 {
    @media (max-width: 767.98px) {
      font-weight: 500;
    }
  }

  .p1 {
    @media (max-width: 767.98px) {
      font-weight: 400 !important;
    }
  }
}

.PrDet__gal {
  display: flex;
  flex-wrap: wrap;
}

.PrDet__img {
  width: 50%;

  img {
    cursor: pointer;
    max-height: 100vh;
    width: 100%;
    object-fit: cover;
    // border: 1px solid #aaa;
  }

  margin-bottom: 5rem;

  @media (max-width: 950px) {
    margin: 0px auto 2rem auto !important;
    width: 100% !important;

    .pad-l-r {
      display: none !important;
    }
  }

  &:nth-of-type(8n+1) {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
  }

  &:nth-of-type(8n+2) {
    margin: 0 auto 5rem auto;
    width: 60%;

  }

  &:nth-of-type(8n+3) {
    margin-right: auto;
    width: 55%;
    display: flex;
    align-items: center;
  }

  &:nth-of-type(8n+4) {
    width: 40%;
    display: flex;
    align-items: center;
  }

  &:nth-of-type(8n+5) {
    width: 75%;
    margin-right: auto;
    margin-left: auto;
  }

  &:nth-of-type(8n+6) {
    width: 75%;
    margin-right: auto;
  }

  &:nth-of-type(8n+7) {
    margin-left: auto;
    width: 75%;
  }

  &:nth-of-type(8n+8) {
    margin-right: auto;
    margin-left: auto;
    width: 75%;
  }
}

.achievements {
  img {
    width: 120px;
    height: auto;

    @media (max-width: 767.98px) {
      width: 100%;
      height: auto;
    }
  }
}

.PrDet__svgW {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 50px;
  height: 50px;
  transform: translate(-50%, -50%);
  pointer-events: none;

  svg {
    transition: 0.5s;
    width: 50px;
    height: 50px;
  }
}

.PrDet__img:hover {
  svg {
    transform: scale(1.2);
  }
}
</style>
