<template>
  <button @click="scrollToTop" class="goTop" :class="{ show: isVisible }">
    <svg width="18px" height="10px" viewBox="0 0 18 10" xmlns="http://www.w3.org/2000/svg">
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
  </button>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isVisible = ref(false);

const checkScroll = () => {
  isVisible.value = window.scrollY > 200;
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

onMounted(() => window.addEventListener('scroll', checkScroll));
onUnmounted(() => window.removeEventListener('scroll', checkScroll));
</script>

<style scoped>
.goTop {
  position: fixed;
  bottom: 50px;
  right: 50px;
  width: 50px;
  height: 50px;
  background: rgba(242, 242, 242, 0.65);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease, transform 0.5s ease;
  pointer-events: none;
}

.goTop.show {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.goTop svg {
  width: 25px;
  height: 25px;
}

.goTop:hover {
  transform: scale(1.1);
}

@media (max-width: 950px) {
  .goTop {
    bottom: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
  }

  .goTop svg {
    width: 20px;
    height: 20px;
  }
}
</style>
