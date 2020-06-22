<template>
  <ul class="task-list">

    <task
      v-for="task in tasks"
      :key="task.id"
      :task="task"
      @update="updateTask"
      @delete="deleteTask" />

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
      required: true,
      validate: (value) => ['array', 'undefined'].find(typeof value)
    }
  },
  methods: {
    createTask (task) {
      this.$emit('create', task)
    },
    updateTask (task) {
      this.$emit('update', task)
    },
    deleteTask (taskId) {
      this.$emit('delete', taskId)
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
