import { useFetch } from "nuxt/app";
import { defineStore } from "pinia";
import { ref } from "vue";

interface Page {
  status: string;
  [key: string]: any;
}

interface Project extends Page { }

interface Category {
  count: number;
  order: number;
  [key: string]: any;
}

interface Year extends Category { }

interface Country extends Category { }

export const useMain = defineStore("main", () => {
  const prel = ref(1);
  const openMenu = ref(true);
  const pages = ref<Page[]>([]);
  const activePr = ref<Project | null>(null);
  const projects = ref<Project[]>([]);
  const CCatPr = ref<Category[]>([]);
  const CYearPr = ref<Year[]>([]);
  const CCountryPr = ref<Country[]>([]);
  const size = ref<"small" | "medium" | "large">("small");

  const updateSize = (newSize: "small" | "medium" | "large") => {
    size.value = newSize;
  };

  const updatePrel = (newPrel: number) => {
    prel.value = newPrel;
  };

  const updateOpenMenu = (isOpen: boolean) => {
    openMenu.value = isOpen;
    if (typeof localStorage !== "undefined") {
      localStorage.setItem("isMenuOpen", JSON.stringify(isOpen));
    }
  };

  const updatePages = (newPages: Page[]) => {
    pages.value = newPages;
  };

  const updateActivePr = (newActivePr: Project | null) => {
    activePr.value = newActivePr;
  };

  const updateProjects = (newProjects: Project[]) => {
    projects.value = newProjects;
  };

  const updateCCatPr = (newCCatPr: Category[]) => {
    CCatPr.value = newCCatPr;
  };

  const updateCYearPr = (newCYearPr: Year[]) => {
    CYearPr.value = newCYearPr;
  };

  const updateCCountryPr = (newCCountryPr: Country[]) => {
    CCountryPr.value = newCCountryPr;
  };

  // 🌐 Async Actions
  const getPage = async () => {
    try {
      const { data } = await useFetch<Page[]>('/wp-json/wp/v2/pages?per_page=100');
      if (data.value) {
        updatePages(data.value.filter((el) => el.status === 'publish'));
      }
    } catch (error) {
      console.error("Failed to fetch pages:", error);
    }
  };

  const getProjects = async () => {
    try {
      const { data } = await useFetch<Project[]>('/wp-json/wp/v2/projects?per_page=100');
      if (data.value) {
        updateProjects(data.value.filter((el) => el.status === "publish"));
      }
    } catch (error) {
      console.error("Failed to fetch projects:", error);
    }
  };

  const getCCatPr = async () => {
    try {
      const { data } = await useFetch<Category[]>('wp-json/wp/v2/cat?per_page=100');
      if (data.value) {
        const filteredCatPr = data.value
          .filter((el) => el.count) // Фильтрация
          .sort((a, b) => b.order - a.order); // Сортировка
        updateCCatPr(filteredCatPr);
      }
    } catch (error) {
      console.error("Failed to fetch categories:", error);
    }
  };

  const getCYearPr = async () => {
    try {
      const { data } = await useFetch<Year[]>('/wp-json/wp/v2/year?per_page=100');
      if (data.value) {
        const filteredYearPr = data.value
          .filter((el) => el.count) // Фильтрация
          .sort((a, b) => b.order - a.order); // Сортировка
        updateCYearPr(filteredYearPr);
      }
    } catch (error) {
      console.error("Failed to fetch years:", error);
    }
  };

  const getCCountryPr = async () => {
    try {
      const { data } = await useFetch<Country[]>('/wp-json/wp/v2/country?per_page=100');
      if (data.value) {
        const filteredCountryPr = data.value
          .filter((el) => el.count) // Фильтрация
          .sort((a, b) => b.order - a.order); // Сортировка
        updateCCountryPr(filteredCountryPr);
      }
    } catch (error) {
      console.error("Failed to fetch countries:", error);
    }
  };

  return {
    prel,
    openMenu,
    pages,
    activePr,
    projects,
    CCatPr,
    CYearPr,
    CCountryPr,
    size,
    updateSize,
    updatePrel,
    updateOpenMenu,
    updatePages,
    updateActivePr,
    updateProjects,
    updateCCatPr,
    updateCYearPr,
    updateCCountryPr,
    getPage,
    getProjects,
    getCCatPr,
    getCYearPr,
    getCCountryPr,
  };
});
