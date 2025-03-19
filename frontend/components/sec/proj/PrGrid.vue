<template>
    <div class="PrGrid">
        <div class="PrGridWrap">
            <CompPrGridCard v-for="item in (projects)" :key="item.id" :project="item" />
        </div>
        <div class="pad-l-r">
            <p v-if="projects && !projects.length" class="h2 m-b-60">{{ $t('notFound') }}</p>
        </div>
    </div>
</template>
<script>
export default {
    name: 'PrGrid',
    props: {
        projects: {
            type: Array,
            required: true
        },
    },
}
</script>
<style lang="scss" scoped>
.PrGrid {}

.PrGridWrap {
    padding: var(--main-pad);
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(4, 1fr);

    @media (max-width: 950px) {}

    @media (max-width: 768.98px) {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
