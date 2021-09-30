<template>
  <li :class="{ 'line-through': is_done }">
    <input type="checkbox" :id="id" /> 
    <label :for="id">
      <slot></slot>
    </label>
  </li>
</template>

<script>
import Label from "../Jetstream/Label.vue";
export default {
  name: "TodoItem",
  props: {
    id: Number,
    is_done: Boolean,
  },
};
</script>

<style>
</style>
