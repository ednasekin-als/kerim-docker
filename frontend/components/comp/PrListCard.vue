<template>
    <NuxtLink :to="localePath(`/projects/${project.slug}`)" class="PrListCard">
        <div class="PrListCard__content">
            <p class="PrListCard__title p1 mp0">{{ project[locale + '_tit'] }}</p>
            <sup v-if="project.cat[0]">
                {{ cat.find(el => el.id == project.cat[0])[locale + '_tit'] }}
            </sup>
            <div :class="`PrListCard__img ${(showImg2 && project['r_img2'])}`">
                <img :src="project['r_img1']">
            </div>
        </div>
    </NuxtLink>
</template>
<script setup>
import { useMain } from '~/store/main';

const store = useMain();
const { locale } = useI18n();
const localePath = useLocalePath();

const props = defineProps({
  project: {
    type: Object,
    required: true,
  },
});

const cat = computed(() => store.CCatPr);
const showImg2 = ref(false);
let interval = null; // Используем обычную переменную, а не ref

onMounted(() => {
  interval = setInterval(() => {
    if (Math.random() < 0.1) {
      showImg2.value = !showImg2.value;
    }
  }, 3000 + Math.random() * 3000);
});

onBeforeUnmount(() => {
  if (interval) {
    clearInterval(interval);
  }
});
</script>

<style lang="scss" scoped>
.PrListCard {
    position: relative;

    &__content {
        display: flex;
        max-width: 75%;
        margin-left: 25%;
        border-bottom: 1px solid var(--black);
        padding-bottom: 1rem;
        margin-bottom: 1rem;

        @media (max-width: 768px) {
            max-width: 100%;
            margin-left: 0%;
        }

        sup {
            opacity: 0.5;
            color: var(--black);
            top: 5px;
            left: 5px;
            font-size: 10px;

            @media (max-width: 768px) {
                font-size: 16px;
            }
        }

        p {
            font-size: 16px;
            opacity: 0.5;
            color: var(--black);

            @media (max-width: 768px) {
                font-size: inherit;
            }
        }
    }

    &:nth-child(odd) {
        .PrListCard__content {
            justify-content: center;
        }
    }


    &:hover {
        .PrListCard__title {
            opacity: 1;
            transition: 0.2s;
        }

        .PrListCard__img {
            img {
                opacity: 1;
                transition: 0.2s;
            }
        }
    }

    &__img {
        position: absolute;
        top: 0;
        left: 0;

        @media (max-width: 768px) {
            display: none;
        }

        img {
            width: 300px;
            height: auto;
            object-fit: contain;
            opacity: 0;
            transition: 0.7s;
        }
    }
}
</style>
