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

        <b-icon
          class="toggle-icon"
          @click.native="isOpen = !isOpen"
          :icon="isOpen ? 'menu-down' : 'menu-up'">
        </b-icon>

      </div>
      <b-collapse :open="isOpen" :aria-id="`contentForTask-${task.id}`">
        <div class="notification">
          <div class="content">
            <p>{{ task.description }}</p>
          </div>
        </div>
      </b-collapse>
    </li>
</template>

<script>
export default {
  name: 'Task',
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
    }
  }
}
</script>

<style lang="scss" scoped>
 li {
    list-style-type: none;
    padding: 0;
    width: 100%;

    .header {
      width: 100%;
      display: flex;
      justify-content: space-between;
      margin-top: 1.5em;
    }

    .toggle-icon {
      cursor: pointer;
    }
 }
</style>
