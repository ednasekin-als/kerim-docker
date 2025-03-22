<template>
  <div class="PrList">
    <div class="PrListWrap">
      <CompPrListCard v-for="item in projects" :key="item.id" :project="item" />
    </div>
    <div class="pad-l-r">
      <p v-if="projects && !projects.length" class="h2 m-b-60">{{ $t('notFound') }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  projects: {
    type: Array,
    required: true,
  },
});
</script>
<style lang="scss" scoped>
.PrList {}

.PrListWrap {
  padding: var(--main-pad);
  display: block;

  @media (max-width: 950px) {}

  @media (max-width: 768.98px) {
    grid-template-columns: repeat(2, 1fr);
  }
}
</style>
