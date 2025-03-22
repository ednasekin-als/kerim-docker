<template>
  <div>
    <section class="AbTeam">
      <p class="h2 mp0 btnUL">{{ $i('about.tit') }}</p>

      <swiper :modules="modules" :slides-per-view="1" :space-between="30" :mousewheel="swiperOptions.mousewheel"
        :pagination="swiperOptions.pagination" :breakpoints="{
          1025: { slidesPerView: 4.1, spaceBetween: 20 },
          769: { slidesPerView: 3.1, spaceBetween: 10 },
          415: { slidesPerView: 2, spaceBetween: 10 }
        }" class="mySwiper">

        <swiper-slide v-for="(item, key) in teamData" :key="key">
          <div class="AbTeam__card">
            <button v-if="item.list.length" @click="openPopT(item)" class="teamCard">
              <div class="AbTeam__img">
                <img :src="item.img" alt="" />
              </div>
              <p class="p1 mp0 -b-05r">{{ item.name }}</p>
              <p class="p1 mp0 op-05">{{ item.pos }}</p>
            </button>
          </div>
        </swiper-slide>
      </swiper>

      <div class="swiper-pagination"></div>
    </section>

    <transition name="pop1">
      <CompPopTeam v-if="popT" :team="popT" @closePopT="closePopT()" />
    </transition>
  </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Mousewheel } from 'swiper/modules';
import 'swiper/swiper-bundle.css'

const popT = ref(null);

defineProps({
  teamData: {
    type: Array,
    required: true
  }
});

const openPopT = (item) => {
  popT.value = item;
};

const closePopT = () => {
  popT.value = null;
};

const modules = ref([Pagination, Mousewheel]);
const swiperOptions = ref({
  slidesPerView: 1,
  spaceBetween: 30,
  mousewheel: {
    forceToAxis: true
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderFraction: (currentClass, totalClass) => {
      return `<span class="${currentClass}"></span> <small>/ <span class="${totalClass}"></span></small>`;
    }
  }
});
</script>

<style scoped>
.AbTeam {
  padding: var(--main-pad);
  position: relative;
}

.AbTeam .h2 {
  margin-bottom: 0.5rem;
}

@media (max-width: 767.98px) {
  .AbTeam .h2 {
    font-weight: 500;
  }
}

.AbTeam__card {
  text-align: left;
  margin-bottom: 40px;
  width: fit-content;
}

.AbTeam__img {
  margin-bottom: 10px;
}

.AbTeam__card p {
  text-align: left;
}

.AbTeam__img img {
  width: 100%;
  height: auto;
  object-fit: cover;
  transition: all 0.65s ease-in-out;
}

@media (min-width: 2200.98px) {
  .AbTeam__img img {
    width: 100%;
    height: 30rem;
  }
}

@media (min-width: 1300.98px) {
  .AbTeam__img img {
    height: 25rem;
  }
}

@media (max-width: 767.98px) {
  .AbTeam__img img {
    height: 15rem;
  }

  .AbTeam__card p {
    font-size: 16px;
  }
}

@media (max-width: 414.98px) {
  .AbTeam__img img {
    height: auto;
  }
}
</style>
