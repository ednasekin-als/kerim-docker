<template>
  <section class="PrSlider">
    <swiper
      :modules="modules"
      :slides-per-view="1"
      :navigation="swiperOptions.navigation"
      class="mySwiper"
    >
      <swiper-slide v-for="project in projects" :key="project.id">
        <div class="PrSlider__slide" :style="{ backgroundImage: `url(${project.r_img1})` }">
          <p class="h1">{{ project[$i18n.locale + '_tit'] }}</p>
          <NuxtLink :to="`/projects/${project.slug}`" class="p1 btn">
            {{ $i('main.btn.projD') }}
          </NuxtLink>
        </div>
      </swiper-slide>
    </swiper>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import 'swiper/swiper-bundle.css';

defineProps({
  projects: {
    type: Array,
    required: true
  }
});

const modules = ref([Navigation]);

const swiperOptions = ref({
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  }
});
</script>

<style scoped lang="scss">
.PrSlider {
  position: relative;
  &__slide {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    position: relative;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 50vh;
    padding: var(--main-pad);

    p {
      color: var(--white) !important;
      position: relative;
      z-index: 2;
    }

    .btn {
      width: fit-content;
    }
  }
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

}


.swiper-button-prev {
  right: 170px !important;
  left: auto;
  top: 90%;

  @media (max-width: 768px) {
    top: 85%;
    right: 110px !important;
  }

  @media (max-width: 414.98px) {
    top: 90%;
    right: 90px !important;
  }

  @media (max-width: 368.98px) {
    top: 91%;
  }


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
  top: 90%;
  right: 110px !important;

  @media (max-width: 768px) {
    top: 85%;
    right: 50px !important;
  }

  @media (max-width: 414.98px) {
    top: 90%;
    right: 30px !important;
  }

  @media (max-width: 368.98px) {
    top: 91%;
  }


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
</style>
