<template>
  <div class="card p-3">
    <div class="card-title h2">Reminders</div>
    <div class="row" v-for="(reminder, index) in $store.state.reminders" :key="index"
         :class="`${reminder.status ? 'checked-task' : ''}`">
      <div class="col-10 mx-auto">
        <label class="input-container">
          Take {{ computedMedication(reminder.medication_id).name }} on {{ reminder.date_time | formattedDate }} at
          {{ reminder.date_time | formattedTime }}
          <input type="checkbox" :id="`input-${reminder.id}`" @click="changeReminderStatus(reminder.id)"
                 :checked="reminder.status">
          <span class="checkmark"></span>
        </label>
      </div>
    </div>
    <div v-if="$store.state.reminders.length === 0">
      <span class="h4">Add your first medication to see your first reminders !</span>
    </div>
  </div>
</template>

<script>
  import moment from 'moment'

  export default {
    name: 'RemindersList',
    mounted() {
      this.$store.dispatch('getReminders')
    },
    methods: {
      computedMedication(id) {
        return this.$store.state.medications.filter((elem) => {
          return elem.id === id
        })[0]
      },
      changeReminderStatus(id) {
        axios(
          {
            method: 'patch',
            url: '/reminders',
            data: {
              status: this.$el.querySelector('#input-' + id).checked
            }
          }
        )
          .then(response => {
            this.$store.dispatch('getReminders', false)
          })
      }
    },
    filters: {
      formattedDate(date) {
        return moment(date).format('MMMM Do')
      },
      formattedTime(date) {
        return moment(date).format('h:mm a')
      }
    }
  }
</script>

<style scoped>
  .row {
    transition: all 0.3s;
  }

  .checked-task {
    color: #CCC;
    text-decoration: line-through !important;
  }

  .input-container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* Hide the browser's default checkbox */
  .input-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  /* Create a custom checkbox */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 4px;
  }

  /* On mouse-over, add a grey background color */
  .input-container:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the checkbox is checked, add a blue background */
  .input-container input:checked ~ .checkmark {
    background-color: #2196F3;
  }

  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the checkmark when checked */
  .input-container input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the checkmark/indicator */
  .input-container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
</style>
