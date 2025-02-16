<template>
    <div ref="prel" v-if="prel" class="prel">
        <img class="prel__img" :src="require('@/assets/img/prel.gif')" alt="">
    </div>
</template>
<script>

export default ({
    name: 'ThePrel',
    data: () => ({
        prel: true,
    }),
    mounted() {
        setTimeout(() => {
            this.$refs.prel.style.opacity = 0;
        }, 1500);
        setTimeout(() => {
            this.$refs.prel.style.display = 'none';
        }, 2300);
    }
})
</script>
<style scoped lang="scss">
.prel {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100000;
    transition: 0.8s;
}

.prel__img {
    width: 250px;
    min-width: 15vw;
    height: auto;
    max-width: 50%;
    // aspect-ratio: 3/2;
    // background: tomato;
}
</style>