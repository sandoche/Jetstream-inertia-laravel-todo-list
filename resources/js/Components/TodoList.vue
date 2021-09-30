<template>
  <div class="p-5">
    <div class="mb-3">
      <form @submit.prevent="submit" class="flex flex-1">
        <input
          id="text"
          class="
            border-gray-300
            focus:border-indigo-300
            focus:ring focus:ring-indigo-200 focus:ring-opacity-50
            rounded-md
            shadow-sm
            px-4
            py-2
          "
          v-model="form.text"
          placeholder="What do you have to do?"
        />
        <button
          class="
            nline-flex
            items-center
            px-4
            py-2
            bg-gray-800
            border border-transparent
            rounded-md
            font-semibold
            text-xs text-white
            uppercase
            tracking-widest
            hover:bg-gray-700
            active:bg-gray-900
            focus:outline-none
            focus:border-gray-900
            focus:ring focus:ring-gray-300
            disabled:opacity-25
            transition
          "
          type="submit"
        >
          Create
        </button>
        <div v-if="form.errors.text">{{ form.errors.text }}</div>
      </form>
    </div>
    <div class="mb-3" v-if="tasks.length > 0">
      <span
        @click="setFilter('all')"
        :class="[
          'inline-flex rounded-full h-6 px-3 justify-center items-center cursor-pointer',
          {
            'bg-indigo-600 text-white': filterBy === 'all',
          },
        ]"
        >All</span
      >
      <span
        @click="setFilter('todo')"
        :class="[
          'inline-flex rounded-full h-6 px-3 justify-center items-center cursor-pointer',
          {
            'bg-indigo-600 text-white': filterBy === 'todo',
          },
        ]"
        >To do</span
      >
      <span
        @click="setFilter('done')"
        :class="[
          'inline-flex rounded-full h-6 px-3 justify-center items-center cursor-pointer',
          {
            'bg-indigo-600 text-white': filterBy === 'done',
          },
        ]"
        >Done</span
      >
    </div>
    <ul class="list-none">
      <todo-item
        v-for="task in filteredTasks"
        :key="task.id"
        :id="task.id"
        :is-done="task.is_done"
        >{{ task.text }}</todo-item
      >
    </ul>
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
      if (this.filterBy === "all") {
        return this.tasks;
      } else {
        return this.tasks.filter((task) => {
          return (
            (task.is_done && this.filterBy === "done") ||
            (!task.is_done && this.filterBy === "todo")
          );
        });
      }
    },
  },
};
</script>

<style>
</style>