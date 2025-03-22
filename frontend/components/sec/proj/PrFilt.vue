<template>
  <div class="PrFilt">
    <div class="padO">
      <div class="tagList">
        <button v-for="item in cat" :key="item.id" :class="`tag tag_d p1 ${item.id === localCat?.id ? 'active' : ''}`"
          v-html="item[$i18n.locale + '_tit'] || item.name" @click="clickCat(item)"></button>
      </div>
    </div>

    <div class="padO">
      <div class="wrapFilt">
        <div class="custom-select" @click="toggleDropdown" @keydown.prevent="handleKeydown" tabindex="0">
          <span>{{ localCountry ? localCountry[$i18n.locale + '_tit'] : $i('proj.btn.country') }}</span>
          <div class="custom-select__setting">
            <span v-if="localCountry" class="clear-btn" @click.stop="clearSelection">✕</span>
            <svg class="arrow" :class="{ open: dropdownOpen }"  width="18px" height="10px" viewBox="0 0 18 10" xmlns="http://www.w3.org/2000/svg">
              <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                stroke-linejoin="round">
                <g id="24-px-Icons" transform="translate(-267.000000, -79.000000)" stroke="#000000">
                  <g id="ic_up" transform="translate(264.000000, 72.000000)">
                    <g transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)">
                      <g stroke-width="1.5">
                        <g id="back" transform="translate(8.000000, 4.000000)">
                          <path d="M8,0 L0,8"></path>
                          <path d="M0,8 L8,16"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <ul v-if="dropdownOpen" class="dropdown">
            <li v-for="(item, index) in country" :key="item.id" :class="{ active: index === highlightedIndex }"
              @click="selectCountry(item)" @mouseover="highlightedIndex = index">
              {{ item[$i18n.locale + '_tit'] }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

const props = defineProps({
  cat: Array,
  country: Array,
  year: Array,
});

const emit = defineEmits(['changeFilter']);

const localCat = ref(null);
const localCountry = ref(null);
const dropdownOpen = ref(false);
const highlightedIndex = ref(-1);

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value;
  if (dropdownOpen.value) {
    highlightedIndex.value = -1;
  }
};

const selectCountry = (item) => {
  localCountry.value = item;
  dropdownOpen.value = false;
  changeFilter();
};

const clearSelection = () => {
  localCountry.value = null;
  changeFilter();
};

const clickCat = (cat) => {
  localCat.value = localCat.value?.id === cat.id ? null : cat;
  changeFilter();
};

const changeFilter = () => {
  let arrFilt = {
    cat: localCat.value?.id,
    year: props.year?.id,
    country: localCountry.value?.id,
  };
  emit('changeFilter', arrFilt);
};

const handleKeydown = (event) => {
  if (!dropdownOpen.value) {
    toggleDropdown();
    return;
  }

  switch (event.key) {
    case 'ArrowDown':
      if (highlightedIndex.value < props.country.length - 1) {
        highlightedIndex.value++;
      }
      break;
    case 'ArrowUp':
      if (highlightedIndex.value > 0) {
        highlightedIndex.value--;
      }
      break;
    case 'Enter':
      if (highlightedIndex.value !== -1) {
        selectCountry(props.country[highlightedIndex.value]);
      }
      break;
    case 'Escape':
      dropdownOpen.value = false;
      break;
  }
};

watch(dropdownOpen, (newVal) => {
  if (newVal) {
    document.addEventListener('click', closeOnClickOutside);
  } else {
    document.removeEventListener('click', closeOnClickOutside);
  }
});

const closeOnClickOutside = (event) => {
  if (!event.target.closest('.wrapFilt')) {
    dropdownOpen.value = false;
  }
};
</script>

<style scoped>
.PrFilt {
  background: var(--white);
}

.padO {
  margin: var(--main-pad);
}

.tag.active {
  background-color: #000;
  color: #fff;
}

.wrapFilt {
  position: relative;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.custom-select {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: var(--white);
  border: 1px solid #000;
  border-radius: 2rem;
  cursor: pointer;
  padding: 0.5rem 15px;
  user-select: none;
  position: relative;
}

.custom-select__setting {
  display: flex;
  align-items: center;
  gap: 20px;
}

.clear-btn {
  cursor: pointer;
  font-size: 18px;
  color: #888;
}

.clear-btn:hover {
  color: #000;
}

/* Список */
.dropdown {
  position: absolute;
  width: 100%;
  background: white;
  border-radius: 2rem;
  cursor: pointer;
  border: 1px solid #000;
  list-style: none;
  margin: 0;
  padding: 0;
  height: auto;
  overflow-y: auto;
  z-index: 10;
  left: 0px;
  top: 3rem;
}

.dropdown li {
  padding: 0.5rem 15px;
  cursor: pointer;
}

.dropdown li:hover,
.dropdown li.active {
  background: #f0f0f0;
}
</style>
