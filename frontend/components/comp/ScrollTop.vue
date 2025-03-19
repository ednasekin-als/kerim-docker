<template>
  <go-top v-if="GoTop" class="goTop" :bg-color="bgColor" :size="size" :maxWidth="maxWidth" :src="src"
      :bottom="bottom" :weight="weight"></go-top>
</template>

<script>
export default {
  data() {
      return {
          GoTop: null,
      };
  },
  async created() {
      if (process.client) {
          const module = await import('@inotom/vue-go-top');
          this.GoTop = module.default;
      }
  },
  props: {
      bgColor: {
          type: String,
          default: 'rgba(242, 242, 242, .65)',
      },
      size: {
          type: Number,
          default: 50,
      },
      maxWidth: {
          type: Number,
          default: 0,
      },
      weight: {
          type: String,
          default: ''
      },
      src: {
          type: String,
          default: 'http://api.kerimovarchitects.com/wp-content/uploads/2024/03/arrow-go-top.svg',
      },
      bottom: {
          type: Number,
          default: 50,
      }
  },
};
</script>
<style lang="scss" scoped>
.goTop {
    background-size: 40px !important;
    z-index: 999 !important;
}

@media (max-width: 950px) {
    .goTop {
        bottom: 20px !important;
        right: 20px !important;
    }
}
</style>
