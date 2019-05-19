<template>
  <div class="col-12">
    <preloader></preloader>
    <medication-list></medication-list>
    <reminders-list class="mt-5"></reminders-list>
  </div>
</template>

<script>
  import MedicationList from './MedicationList'
  import RemindersList from './RemindersList'
  import Preloader from './Preloader'

  export default {
    name: 'app',
    components: { Preloader, RemindersList, MedicationList }
  }
</script>

<style scoped>

</style>
