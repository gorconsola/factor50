<template>
    <li>
      <div class="header">
        <div class="field">
          <b-checkbox
            :value="task.status"
            true-value="closed"
            false-value="open"
            type="is-primary"
            @input="handleToggle"
          >

            {{ task.title }}

          </b-checkbox>
        </div>

        <div>
          <b-icon
            class="icon trash"
            type="is-small"
            @click.native="deleteTask"
            icon="trash-can-outline">
          </b-icon>

          <b-icon
            class="icon"
            @click.native="isOpen = !isOpen"
            :icon="isOpen ? 'menu-down' : 'menu-up'">
          </b-icon>
        </div>

      </div>
      <b-collapse :open="isOpen" :aria-id="`contentForTask-${task.id}`">
        <div class="notification">
          <div class="content">
            <task-details :task="task" />
          </div>
        </div>
      </b-collapse>
    </li>
</template>

<script>
import TaskDetails from '@/components/tasks/TaskDetails.vue'

export default {
  name: 'Task',
  components: { TaskDetails },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isOpen: false
    }
  },
  methods: {
    handleToggle (value) {
      const updatedTask = this.task
      updatedTask.status = value

      this.$emit('update', updatedTask)
    },
    deleteTask () {
      this.$emit('delete', this.task.id)
    }
  }
}
</script>

<style lang="scss" scoped>
 li {
    list-style-type: none;
    padding: 0;
    width: 100%;

    &:hover {
      background: whitesmoke;
    }

    .header {
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5em;

      .field {
        margin: 0;
      }
    }

    .icon {
      cursor: pointer;

      &.trash {
        &:hover {
          color: tomato;
        }
      }
    }
 }
</style>
