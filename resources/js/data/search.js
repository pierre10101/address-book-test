export default {
    namespaced: true,
    root:true,
    /**
     *  State variables
     * 
     *  @param { object } searchData
     */
    state: {
        searchData: {},
    },
    getters: {

    },
    /**
     *  Update state in Module
     * 
     *  @param { [type: string]: Function } state
     *  @param { array } data 
     */
    mutations: {
        updateSearch(state, data) {
            state.searchData = data;
        },
    },

    /**
     *  Setup of crud store mimicking calls to api
     * 
     *  @param { [type: string]: Function } context 
     *  @param { array } data 
     */

    actions: {

    }
}