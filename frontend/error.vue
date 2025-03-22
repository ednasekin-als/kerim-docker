<template>
  <div class="p404">
    <div class="row">
      <div class="col-24">
        <NuxtLink class="h1" to="/">Error {{ error.statusCode }}</NuxtLink>
        <p class="h2">{{ error.message || $i('error.descr') }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  error: Object,
});
</script>

<style lang="scss" scoped>
.p404 {
  padding: var(--main-pad);
}
</style>
