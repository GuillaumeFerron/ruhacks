<template>
  <div class="card p-3 mt-5">
    <div class="card-title-h4">
      Demo CTAs
    </div>
    <div class="btn btn-primary" @click="sendReminders">
      Mimic a Reminder Round
    </div>
    <div class="btn btn-primary mt-2" @click="followUpReminders">
      Mimic a Refill Round
    </div>
    <div class="btn btn-primary mt-2" @click="clearData">
      Clear Medications & Reminders
    </div>
  </div>
</template>

<script>
  export default {
    name: 'DemoCTA',
    methods: {
      sendReminders() {
        axios(
          {
            method: 'post',
            url: '/users/send-reminders'
          }
        )
      },
      followUpReminders() {
        axios(
          {
            method: 'post',
            url: '/users/followup-reminders'
          }
        )
      },
      clearData() {
        axios(
          {
            method: 'post',
            url: '/data/clear'
          }
        )
          .then(response => {
            this.$store.dispatch('getMedications')
            this.$store.dispatch('getReminders')
          })
      }
    }
  }
</script>

<style scoped>

</style>
