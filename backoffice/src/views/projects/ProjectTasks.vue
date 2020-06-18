<template>
  <section class="section">
    <crud-wrapper
      ref="crudWrapper"
      :endpoint="endpoint"
    >
      <template slot-scope="{ loading, getAll, data, create }">
        <card title="Tasks">
          <template>
            <div>
              <slot
                :data="data"
                :loading="false"
              >

                <task-list :tasks="data" @create="create" @update="handleUpdate"/>

              </slot>
            </div>
          </template>
        </card>
      </template>
    </crud-wrapper>
  </section>
</template>

<script>
import CrudWrapper from '@/components/http/CrudWrapper'
import Card from '@/components/ui/Card.vue'
import QueryStringMixin from '@/components/http/QueryStringMixin.js'
import TaskList from '@/components/tasks/TaskList.vue'

export default {
  name: 'ProjectTasks',
  components: {
    CrudWrapper,
    Card,
    TaskList
  },
  mixins: [QueryStringMixin],
  computed: {
    endpoint () {
      return `projects/${this.$route.params.projectId}/tasks`
    }
  },
  mounted () {
    this.$refs.crudWrapper.getAll(this.getQueryStringFromUrl())
  },
  methods: {
    handleRouting ({ id }) {
      this.$router.push(`${this.$route.path}/${id}`)
    },
    handleUpdate (task) {
      this.$refs.crudWrapper.update(task, task.id)
    }
  }
}
</script>
