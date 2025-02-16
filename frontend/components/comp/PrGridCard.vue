<template>
    <NuxtLink :to="localePath(`/projects/${project.slug}`)" class="PrCard">
        <div :class="`PrCard__img ${(this.showImg2 && project['r_img2']) ? 'PrCard__img_img2' : ''}`">
            <img :src="project['r_img1']">
            <img loading="lazy" v-if="project['r_img2']" :src="project['r_img2']">
        </div>
        <p class="PrCard__title p1 mp0">{{ project[locale + '_tit'] }}</p>
        <p class="p1 mp0 op-05">
            {{ cat.find(el => el.id == project.cat[0]) ? cat.find(el => el.id == project.cat[0])[locale + '_tit'] : '' }}
        </p>
    </NuxtLink>
</template>
<script>


export default {
    name: 'PrGridCard',

    async asyncData({ store }) {
      return { cat: await store.dispatch("getCCatPr") };
    },

    data() {
        return {
            cat: [],
            showImg2: false,
        }
    },
    props: {
        project: {
            type: Object,
            required: true
        },
    },
    computed: {
      locale() {
        return this.$i18n.locale;
      },
    },
    mounted() {
        this.interval = setInterval(() => {
            if (Math.random() < 0.1) {
                this.showImg2 = !this.showImg2
            }
        }, 3000 + Math.random() * 3000);
    },

    beforeDestroy() {
        console.log("bD")
        clearInterval(this.interval)
    },
}
</script>
<style lang="scss" scoped>
.PrCard {

    p {
        color: var(--black);
    }

    &:hover {
        .PrCard__title {
            opacity: 0.7;
            transition: 0.2s;
        }
    }

}

.PrCard__img {
    position: relative;
    max-width: 100%;
    aspect-ratio: 4/3;
    display: flex;

    img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: 2s ease-in-out;

        &:last-of-type {
            opacity: 0;
        }

        &:first-of-type {
            opacity: 1;
        }

    }
}


.PrCard__img_img2 {
    img:first-of-type {
        opacity: 0;
    }

    img:last-of-type {
        opacity: 1;
    }
}
</style>
