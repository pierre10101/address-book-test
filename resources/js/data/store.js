import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

/**
 * Modules
 */
import search from './search';
export default new Vuex.Store({
  modules: {
    search
  },
})
