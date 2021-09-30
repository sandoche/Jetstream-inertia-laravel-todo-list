<template>
  <div>
    <div>
      <form @submit.prevent="submit">
        <label for="text">Task:</label>
        <input id="text" v-model="form.text" />
        <button type="submit">Create</button>
        <div v-if="form.errors.text">{{ form.errors.text }}</div>
      </form>
    </div>
    <div>
      Filters: <span @click="setFilter('all')">All</span> |
      <span @click="setFilter('todo')">To do</span> |
      <span @click="setFilter('done')">Done</span>
    </div>
    <div>
      <todo-item
        v-for="task in filteredTasks"
        :key="task.id"
        :id="task.id"
        :is-done="task.is_done"
        >{{ task.text }}</todo-item
      >
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import TodoItem from "@/Components/TodoItem.vue";

export default {
  name: "TodoList",
  components: {
    TodoItem,
  },
  props: {
    tasks: Array,
  },
  setup() {
    const form = useForm({
      text: null,
    });

    function submit() {
      form.post("/todo", {
        onSuccess: () => {
          form.reset("text");
        },
      });
    }

    return { form, submit };
  },
  data() {
    return {
      filterBy: "all",
    };
  },
  methods: {
    setFilter(newFilter) {
      this.filterBy = newFilter;
    },
  },
  computed: {
    filteredTasks() {
      if (this.filterBy === 'all') {
        return this.tasks
      } else {
        return this.tasks.filter(task => {
          return task.is_done && this.filterBy === 'done' || !task.is_done && this.filterBy === 'todo'
        })
      }
    },
  },
};
</script>

<style>
</style>