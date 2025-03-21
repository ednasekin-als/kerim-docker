<template>
    <div class="p404">
        <div class="row">
            <div class="col-24">
                <NuxtLink class="h1" to="/">404</NuxtLink>
                <p class="h2">{{ $i('error.descr') }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['error'],
    beforeMount() {
        // this.$store.dispatch("getPage");
    }
}
</script>

<style lang="scss" scoped>
.p404 {
    padding: var(--main-pad);
}
</style>
