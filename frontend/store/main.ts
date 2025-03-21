import { useFetch } from "nuxt/app";
import { defineStore } from "pinia";
import { ref } from "vue";

interface Page {
  status: string;
  [key: string]: any;
}

export const useMain = defineStore("main", () => {
  const prel = ref(1);
  const openMenu = ref(true);
  const pages = ref<Page[]>([]);
  const activePr = ref(null);
  const projects = ref<any[]>([]);
  const CCatPr = ref<any[]>([]);
  const CYearPr = ref<any[]>([]);
  const CCountryPr = ref<any[]>([]);
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

  const updateActivePr = (newActivePr: any | null) => {
    activePr.value = newActivePr;
  };

  const updateProjects = (newProjects: any[]) => {
    projects.value = newProjects;
  };

  const updateCCatPr = (newCCatPr: any[]) => {
    CCatPr.value = newCCatPr;
  };

  const updateCYearPr = (newCYearPr: any[]) => {
    CYearPr.value = newCYearPr;
  };

  const updateCCountryPr = (newCCountryPr: any[]) => {
    CCountryPr.value = newCCountryPr;
  };

  const getPage = async () => {
    try {
      const data = await $fetch<Page[]>('/wp-json/wp/v2/pages?per_page=100');
      updatePages(data);
    } catch (error) {
      console.error("Failed to fetch pages:", error);
    }
  };

  const getProjects = async () => {
    try {
      const data: any[] = await $fetch('/wp-json/wp/v2/projects?per_page=100');
      updateProjects(data.filter((el) => el.status === "publish"));
    } catch (error) {
      console.error("Failed to fetch projects:", error);
    }
  };

  const getCCatPr = async () => {
    try {
      const data: any[] = await $fetch('/wp-json/wp/v2/cat?per_page=100');
      if (data) {
        const filteredCatPr = data
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
      const data: any[] = await $fetch('/wp-json/wp/v2/year?per_page=100');
      if (data) {
        const filteredYearPr = data
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
      const data: any[] = await $fetch('/wp-json/wp/v2/country?per_page=100');
      if (data) {
        const filteredCountryPr = data
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
