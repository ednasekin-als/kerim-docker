import axios from "axios";

export const state = () => ({
  prel: 1,
  openMenu: true,
  pages: [],
  activePr: null,
  projects: [],
  CCatPr: [],
  CYearPr: [],
  CCountryPr: [],
  size: "small",
});

export const mutations = {
  updateSize(state, size) {
    state.size = size;
  },
  updatePrel(state, prel) {
    state.prel = prel;
  },
  updateOpenMenu(state, openMenu) {
    state.openMenu = openMenu;

    if (typeof localStorage !== 'undefined') {
      localStorage.setItem('isMenuOpen', openMenu);
    }
  },
  updatePage(state, pages) {
    state.pages = pages;
  },
  updateActivePr(state, activePr) {
    state.activePr = activePr;
  },
  updateProjects(state, projects) {
    state.projects = projects;
  },
  updateCCatPr(state, CCatPr) {
    state.CCatPr = CCatPr;
  },
  updateCYearPr(state, CYearPr) {
    state.CYearPr = CYearPr;
  },
  updateCCountryPr(state, CCountryPr) {
    state.CCountryPr = CCountryPr;
  },
};

export const actions = {
  updateOpenMenu({ state, commit }, open) {
    commit("updateOpenMenu", open);
  },
  updateActivePr({ state, commit }, activePr) {
    commit("updateActivePr", activePr);
  },
  updateSize({ state, commit }, size) {
    commit("updateSize", size);
  },
  updatePrel({ state, commit }, prel) {
    commit("updatePrel", prel);
  },

  async getPage({ commit }) {
    const { data } = await this.$axios.get('/wp-json/wp/v2/pages?per_page=100');
    commit('updatePage', data.filter((el) => el.status === 'publish'));
  },

  async getProjects({ commit }) {
    const { data } = await this.$axios.get('/wp-json/wp/v2/projects?per_page=100');
    commit("updateProjects", data.filter((el) => el.status === "publish"));
  },

  async getCCatPr({ commit }) {
    const { data } = await this.$axios.get('wp-json/wp/v2/cat?per_page=100');
    const filteredCatPr = data.filter((el) => el.count).sort((a, b) => {
      if (a.order > b.order) return -1;
      if (a.order < b.order) return 1;
      return 0;
    });
    commit("updateCCatPr", filteredCatPr);
  },

  async getCYearPr({ commit }) {
    const { data } = await this.$axios.get('/wp-json/wp/v2/year?per_page=100');
    const filteredYearPr = data.filter((el) => el.count).sort((a, b) => {
      if (a.order > b.order) return -1;
      if (a.order < b.order) return 1;
      return 0;
    });
    commit("updateCYearPr", filteredYearPr);
  },
  async getCCountryPr({ commit }) {
    const { data } = await this.$axios.get('/wp-json/wp/v2/country?per_page=100');
    const filteredCountryPr = data.filter((el) => el.count).sort((a, b) => {
      if (a.order > b.order) return -1;
      if (a.order < b.order) return 1;
      return 0;
    });
    commit("updateCCountryPr", filteredCountryPr);
  }
};


