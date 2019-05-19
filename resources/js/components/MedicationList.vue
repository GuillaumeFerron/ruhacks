<template>
  <div class="card p-3">
    <div class="card-title h2">Prescriptions</div>
    <table class="table table-striped" v-if="$store.state.medications.length > 0">
      <thead>
      <tr>
        <th>
          <b>Name</b>
        </th>
        <th>
          <b>Quantity</b>
        </th>
        <th>
          <b>Frequency</b>
        </th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(medication, index) in $store.state.medications" :key="index">
        <th>{{ medication.name }}</th>
        <th>{{ medication.quantity_amount }} {{ medication.quantity_type }}</th>
        <th>{{ medication.frequency }}</th>
      </tr>
      </tbody>
    </table>
    <div v-else>
      <span class="h4">Add your first medication by pressing the camera button !</span>
    </div>
    <div class="btn btn-primary col-1 ml-auto btn-large" style="border-radius: 25px; min-width: 64px;"
         @click="addNewMedication">
      <i class="fa fa-camera"></i>
    </div>
    <input type="file" accept="image/*" id="file-input" class="hidden" @change="triggerAsync">
    <div v-if="textFound" class="text-found-popup">
      <div class="card p-3 w-75 text-found-card">
        <div class="card-title h4">
          This is what we found:
        </div>
        {{ textFound }}
        <div class="btn" @click="textFound = ''">
          OK
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'MedicationList',
    data() {
      return {
        textFound: ''
      }
    },
    methods: {
      addNewMedication() {
        this.$el.querySelector('#file-input').click()
      },
      triggerAsync() {
        this.$store.commit('UPDATE_LOAD', true)
        window.sendDataToVAI(this.$store.state.addIndex, this.$store.state.textArrays)
          .then(response => {
            setTimeout(() => {
              this.textFound = this.$store.state.textArrays[this.$store.state.addIndex].text
              this.$store.commit('ADD_INDEX_INCREMENT')
              this.$store.dispatch('getMedications')
              this.$store.dispatch('getReminders')
            }, 3000)
          })
      }
    },
    mounted() {
      this.$store.dispatch('getMedications')
    }
  }
</script>

<style scoped>
  .hidden {
    z-index: -9999;
    top: -99999999px;
    left: -999999999px;
    position: absolute;
    display: none;
  }

  .text-found-popup {
    position: fixed;
    background-color: rgba(255, 255, 255, 0.8);
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 98;
  }

  .text-found-card {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
</style>
