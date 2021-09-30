<template>
    <app-layout title="To Do">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                To Do
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <TodoList :tasks="tasks"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import TodoList from '@/Components/TodoList.vue'

    export default defineComponent({
        props: {
            tasks: Array
        },
        components: {
            AppLayout,
            TodoList
        },
    })
</script>
