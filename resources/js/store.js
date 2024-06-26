Statamic.$store.registerModule(['publish', 'fontAwesome'], {

    namespaced: true,

    state: {
        icons: null,
    },

    getters: {
        icons: state => state.icons,
    },

    actions: {
        fetchIcons({ commit }) {
            return Statamic.$request.get(`/!/font-awesome/icons`)
                .then(response => commit('setIcons', response.data))
                .catch(function (error) {
                    console.log(error);
                });
        },
    },

    mutations: {
        setIcons(state, icons) {
            state.icons = icons;
        },
    }

})
