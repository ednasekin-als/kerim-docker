<template>
    <div class="PopTeam">
        <button class="PopTeam__close z-2" @click="closePopT()">
            <svg width="800px" height="800px" viewBox="0 0 24 24" id="_24x24_On_Light_Cross"
                data-name="24x24/On Light/Cross" xmlns="http://www.w3.org/2000/svg">
                <rect id="view-box" width="24" height="24" fill="none" />
                <path id="Shape"
                    d="M9.291,10.352l-4-4-4.005,4A.75.75,0,1,1,.22,9.291l4.005-4L.22,1.281A.75.75,0,0,1,1.281.22L5.286,4.225l4-4.005a.75.75,0,1,1,1.061,1.061l-4,4.005,4,4a.75.75,0,0,1-1.061,1.061Z"
                    transform="translate(6.629 6.8)" fill="#141124" />
            </svg>
        </button>
        <div class="row m-b-1r">
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md- col-20 offset- '>
                <h5 class="h1">{{ team.name }}</h5>
            </div>
            <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-18 offset-md- col-20 offset- '>
                <p class="h2">{{ team.pos }}</p>
            </div>
        </div>
        <div class="row">
            <div class='col-xl- offset-xl- col-lg-6 offset-lg- col-md-6 offset-md- col-24 offset- pad-r m-b-2r'>
                <img v-if="team.img" :src="team.img" alt="" class="w-100">
            </div>
            <div class='col-xl- offset-xl- col-lg-18 offset-lg- col-md-18 offset-md- col-24 offset- listWrap'>
                <div v-for="item in team.list" class="row">
                    <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-7 offset-md- col-24 offset- m-b-1r'>
                        <p class="p1 op-05 mp0">{{ item.name }}</p>
                    </div>
                    <div class='col-xl- offset-xl- col-lg- offset-lg- col-md-16 offset-md-1 col-24 offset- '>
                        <span class="p1 postContent mp0" v-html="item.val"></span>
                    </div>
                    <div class="col-24 m-t-1r m-b-1r">
                        <div class="line op-05"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'PopTeam',
    props: {
        team: {
            type: Object,
        },
    },
    methods: {
        closePopT() {
            this.$emit('closePopT')
        }
    },
    mounted() {
        document.body.classList.add('overflow-hidden')
    },
    beforeUnmount() {
        document.body.classList.remove('overflow-hidden')
    },
};
</script>
<style lang="scss" scoped>
.PopTeam {
    position: fixed;
    overflow: auto;
    top: 0;
    height: 100vh;
    right: 0;
    width: 100%;
    padding: var(--main-pad);
    z-index: 1000;
    background-color: var(--white);

    @media (max-width: 950px) {
        width: 100%;
        padding-top: 2.5rem;
    }
}

.PopTeam__close {
    position: absolute;
    top: var(--main-pad);
    right: var(--main-pad);

    @media (max-width: 950px) {
        top: 2.5rem;
    }

    svg {
        width: 3rem;
        height: auto;
        transition: 0.4s;
    }
}

.listWrap {
    padding-left: 1rem;

    @media (max-width: 767.98px) {
        padding-left: 0;
    }

}
</style>
