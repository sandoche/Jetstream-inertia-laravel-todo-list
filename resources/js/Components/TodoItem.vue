<template>
  <li :class="{ 'line-through': is_done }">
    <input
      type="checkbox"
      :id="id"
      v-model="form.is_done"
      @change="markAsDone"
    />&nbsp;
    <label :for="id">
      <slot></slot>
    </label>
  </li>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  name: "TodoItem",
  props: {
    id: Number,
    is_done: Boolean,
  },
  setup(props) {
    const form = useForm({
      id: props.id,
      is_done: props.is_done
    });

    function markAsDone() {
      form.put(`/todo/${props.id}`);
    }

    return { form, markAsDone };
  },
};
</script>

<style>
</style>
