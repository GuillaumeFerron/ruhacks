import Vuex from 'vuex'
import Vue from 'vue'
import { textArrays } from './demoData'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    addIndex: 0,
    medications: [],
    reminders: [],
    load: false,
    textArrays: textArrays
  },
  mutations: {
    ADD_INDEX_INCREMENT(state) {
      state.addIndex = (state.addIndex + 1) % state.textArrays.length
    },
    UPDATE_MEDICATIONS(state, payload) {
      state.medications = payload.slice(0)
    },
    UPDATE_REMINDERS(state, payload) {
      state.reminders = payload.slice(0)
    },
    UPDATE_LOAD(state, value) {
      state.load = value
    }
  },
  actions: {
    getMedications({ state, commit }) {
      commit('UPDATE_LOAD', true)
      axios({
        method: 'get',
        url: '/medications'
      })
        .then(response => {
          commit('UPDATE_MEDICATIONS', response.data.data)
          commit('UPDATE_LOAD', false)
        })
    },
    getReminders({ state, commit }, payload = true) {
      payload ? commit('UPDATE_LOAD', true) : ''
      axios({
        method: 'get',
        url: '/users/' + window.user.id + '/reminders'
      })
        .then(response => {
          commit('UPDATE_REMINDERS', response.data.data)
          payload ? commit('UPDATE_LOAD', false) : ''
        })
    }
  }
})
