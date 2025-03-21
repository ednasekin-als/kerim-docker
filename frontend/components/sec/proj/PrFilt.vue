<template>
    <div class="PrFilt">
        <div class="padO">
            <div class="tagList">
                <button v-for="(item, cat) in cat" :key="item.id"
                    :class="`tag tag_d p1 ${(item.id == localCat?.id) ? 'active' : ''}`"
                    v-html="item[$i18n.locale + '_tit'] || item.name" @click="clickCat(item)"></button>
            </div>
        </div>
        <!-- <div class="padO">
            <client-only>
                <div class="wrapFilt">
                    <v-select :filterable="false" :searchable="false" :options="country" :label="$i18n.locale + '_tit'"
                        :placeholder="$i('proj.btn.country')" v-model="localCountry" @input="changeFilter">

                        <template #open-indicator="{ attributes }">
                            <span class="arrow">
                                <span></span><span></span>
                            </span>
                        </template>

                    </v-select>
                </div>
            </client-only>
        </div> -->
    </div>
</template>
<script>
export default {
    name: "SFilter",

    props: {
        type: {
            type: String,
        },
        cat: {
            type: Array,
            required: true
        },
        country: {
            type: Array,
            required: true
        },
        year: {
            type: Array,
            required: true
        },
    },

    data() {
        return {
            localCat: null,
            localCountry: null,
        };
    },

    mounted() {
        if (typeof localStorage !== 'undefined') {
            const activeCat = localStorage.getItem('activeCat');
            const savedTime = localStorage.getItem('savedTime');
            const now = new Date().getTime();

            if (activeCat && savedTime) {
                const elapsedTime = now - savedTime;
                const timeLimit = 24 * 60 * 60 * 1000; // 24 часа

                if (elapsedTime < timeLimit) {
                    this.localCat = JSON.parse(activeCat);
                } else {
                    localStorage.removeItem('activeCat');
                    localStorage.removeItem('savedTime');
                }
            }
        }
    },

    methods: {
        clickCat(cat) {
            if (this.localCat && this.localCat.id == cat.id) {
                this.localCat = null;
            } else {
                this.localCat = cat;
            }

            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('activeCat', JSON.stringify(this.localCat));
                localStorage.setItem('savedTime', new Date().getTime());
            }

            this.changeFilter();
        },

        changeFilter() {
            let arrFilt = {};
            if (this.localCat) {
                arrFilt.cat = this.localCat.id;
            }
            if (this.year) {
                arrFilt.year = this.year.id;
            }
            if (this.localCountry) {
                arrFilt.country = this.localCountry.id;
            }

            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('activeFilter', JSON.stringify(arrFilt));
            }

            this.$emit('changeFilter', arrFilt);
        },

        loadActiveCat() {
            if (typeof localStorage !== 'undefined') {
                const storedCat = localStorage.getItem('activeCat');
                return storedCat ? JSON.parse(storedCat) : null;
            }
            return null;
        },
    }
}
</script>
<style lang="scss" scoped>
.arrow {
    width: 4px;
    height: 1.25rem;
    display: inline-block;
    position: relative;
    margin: 0 1rem;
    cursor: pointer;

    @media (max-width: 767.98px) {
        width: 5px;
    }
}

.arrow span {
    top: 0.5rem;
    position: absolute;
    width: 9px;
    height: 2px;
    background-color: #000;
    display: inline-block;
    transition: all 0.2s ease;
    border-radius: 25px;

    @media (max-width: 767.98px) {
        width: 12px;
        height: 2px;
    }
}

.arrow span:first-of-type {
    left: 0;
    transform: rotate(-45deg);
}

.arrow span:last-of-type {
    right: 0;
    transform: rotate(45deg);
}

.vs--open .arrow span:first-of-type {
    transform: rotate(45deg);
}

.vs--open .arrow span:last-of-type {
    transform: rotate(-45deg);
}

.wrapFilt {
    --vs-dropdown-option--active-bg: var(--black);
}


.vs__dropdown-option--highlight {
    background: var(--black);
}

.filtTit {
    margin-bottom: 2rem;
}

.wrapFilt {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;

    @media (max-width: 768.98px) {
        grid-template-columns: 1fr;
    }

}

.padO {
    margin: var(--main-pad);
}

.PrFilt {
    background: var(--white);
}

.tagList {}

.arrowSel {
    font-size: 40px;
    transition: 0.4s;
}

.vs--open {
    .arrowSel {
        transform: rotate(180deg);
    }
}
</style>
