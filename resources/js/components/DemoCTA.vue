<template>
  <div class="card p-3 mt-5">
    <div class="card-title-h4">
      Demo CTAs
    </div>
    <div class="btn btn-primary" @click="sendReminders">
      Mimic a reminder round
    </div>
    <div class="btn btn-primary mt-2" @click="followUpReminders">
      Mimic a refill round
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
      }
    }
  }
</script>

<style scoped>

</style>
