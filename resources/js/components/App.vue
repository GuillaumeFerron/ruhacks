<template>
  <div class="col-12">
    <preloader></preloader>
    <medication-list></medication-list>
    <reminders-list class="mt-5"></reminders-list>
    <demo-c-t-a></demo-c-t-a>
  </div>
</template>

<script>
  import MedicationList from './MedicationList'
  import RemindersList from './RemindersList'
  import Preloader from './Preloader'
  import DemoCTA from './DemoCTA'

  export default {
    name: 'app',
    components: { DemoCTA, Preloader, RemindersList, MedicationList }
  }
</script>

<style scoped>

</style>
