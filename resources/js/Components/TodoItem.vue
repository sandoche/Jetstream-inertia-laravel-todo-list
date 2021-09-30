<template>
  <li :class="['mb-1', { 'line-through': isDone }]">
    <input
      ref="input"
      type="checkbox"
      :id="`check-${id}`"
      v-model="form.is_done"
      @change="markAsDone"
      :value="form.is_done"
    />&nbsp;
    <label :for="`check-${id}`">
      <slot></slot>
    </label>
  </li>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

export default {
  name: "TodoItem",
  props: {
    id: Number,
    isDone: Number,
  },
  setup(props, { emit }) {
    const form = useForm({
      id: props.id,
      is_done: props.isDone,
    });

    onMounted(() => {
      if (form.is_done) {
        document.querySelector(`#check-${props.id}`).checked = true;
      }
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
