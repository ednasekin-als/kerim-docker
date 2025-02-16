<template>
    <div class="menuBg" @click="closeMenu()">
        <h1 class="h1 menuBg__tit">{{ $t('menu.menu') }}</h1>

    </div>
</template>
<script>

export default ({
    name: 'MenuBg',
    props: {

    },
    methods: {
        closeMenu() {
            this.$store.dispatch("updateOpenMenu", false);
        }
    }
})
</script>
<style scoped lang="scss">
.menuBg {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 998;
    background-color: var(--black);
    overflow: hidden;
    cursor: pointer;
    filter: blur(3px);
}

.menuBg__tit {
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: auto;
    font-size: 52vw;
}
</style>