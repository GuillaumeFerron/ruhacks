<template>
  <div class="card">
    <div class="card-title-h4">
      Demo CTAs
    </div>
    <div class="btn btn-primary" @click="sendReminders">
      Mimic a reminder round
    </div>
    <!--    <div class="btn">-->
    <!--      Mimic a refill round-->
    <!--    </div>-->
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
      }
    }
  }
</script>

<style scoped>

</style>
