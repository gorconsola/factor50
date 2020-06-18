<template>
  <ul class="task-list">

    <task
      v-for="task in tasks"
      :key="task.id"
      :task="task"
      @update="updateTask" />

    <create-task
      @create="createTask" />

  </ul>
</template>

<script>
import Task from '@/components/tasks/Task.vue'
import CreateTask from '@/components/tasks/CreateTask.vue'

export default {
  name: 'TaskList',
  components: { Task, CreateTask },
  props: {
    tasks: {
      type: Array,
      required: true
    }
  },
  methods: {
    updateTask (task) {
      this.$emit('update', task)
    },
    createTask (task) {
      this.$emit('create', task)
    }
  }
}
</script>

<style lang="scss" scoped>
  .content {
    .task-list {
      margin: 0;
      width: 100%;
    }
  }
</style>
