<template>
  <div>
    <div v-swiper:mySwiper="swiperOption" class="AbTeam">
      <p class="h2 mp0 btnUL">{{ $t('about.tit') }}</p>
      <div class="swiper-wrapper">
        <div v-for="(item, key) in teamData" :key="key" class="swiper-slide">
          <div class="AbTeam__card">
            <button v-if="item.list.length" @click="openPopT(item)" class="teamCard">
              <div class="AbTeam__img">
                <img :src="item.img" alt="">
              </div>
              <p class="p1 mp0 mp0 -b-05r">{{ item.name }}</p>
              <p class="p1 mp0 op-05">{{ item.pos }}</p>
            </button>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
    <transition name="pop1">
      <CompPopTeam v-if="popT" :team="popT" @closePopT="closePopT()" />
    </transition>
  </div>
</template>
<script>

export default {
  name: 'componentSwiper',
  props: {
    teamData: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      popT: null,
      swiperOption: {
        slidesPerView: 1,
        spaceBetween: 30,
        allowTouchMove: true,
        clickable: true,
        init: true,
        mousewheel: {
          forceToAxis: true,
        },
        bulletClass: 'swiper-pagination-bullet',
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderFraction: function (currentClass, totalClass) {
            return '<span class="' + currentClass + '"></span>' + ' <small>/ ' + '<span class="' + totalClass + '"></span></small>';
          }
        },
        breakpoints: {
          1024.98: {
            slidesPerView: 4.1,
            spaceBetween: 20
          },
          768.98: {
            slidesPerView: 3.1,
            spaceBetween: 10
          },
          414.98: {
            slidesPerView: 2,
            spaceBetween: 10
          },
        }
      }
    }
  },
  methods: {
    openPopT(item) {
      this.popT = item
      console.log();
    },
    closePopT() {
      this.popT = null
    }
  },
  mounted() {
    this.mySwiper.destroy = () => { };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
}
</script>

<style scoped>
.AbTeam {
  padding: var(--main-pad);
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
  transition: all .65s ease-in-out;

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
