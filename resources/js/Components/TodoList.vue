<template>
  <div>
    <div>
      <form @submit.prevent="submit">
        <label for="text">Task:</label>
        <input id="text" v-model="form.text" />
        <button type="submit">Create</button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  setup () {
    const form = reactive({
      text: null
    })

    function submit() {
      Inertia.post('/todo', form)
    }

    return { form, submit }
  },
}
</script>

<style>
</style>