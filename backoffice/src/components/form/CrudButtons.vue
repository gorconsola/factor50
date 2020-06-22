<template>
  <div
    class="buttons-container"
    :class="{'flex-end': showDelete}"
  >
    <b-button
      v-if="showDelete"
      tag="button"
      native-type="button"
      tabindex="2"
      class="button is-danger"
      :loading="recentClick === 'remove' && loading"
      @click.prevent="confirmDelete"
    >
      Delete
    </b-button>

    <div class="button-group">
      <b-button
        tag="button"
        native-type="button"
        tabindex="1"
        type="is-light"
        :loading="recentClick === 'reset' && loading"
        @click.prevent="resetChanges"
      >
        Reset
      </b-button>

      <b-button
        tabindex="0"
        type="is-primary"
        tag="input"
        native-type="submit"
        :loading="recentClick === 'submit' && loading"
        @click="$emit('submit')"
      >
        Opslaan
      </b-button>
    </div>
  </div>
</template>

<script>

export default {
  name: 'CrudButtons',
  props: {
    loading: {
      type: Boolean,
      default: false
    },
    showDelete: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      recentClick: undefined
    }
  },
  methods: {
    confirmDelete () {
      this.$buefy.dialog.confirm({
        title: 'Deleting',
        message: 'Are you sure you want to <b>delete</b>? This action cannot be undone.',
        confirmText: 'Delete',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => this.$emit('remove')
      })
    },
    resetChanges () {
      this.$emit('reset')
    },
    handleSubmit () {
      this.$emit('submit', 'update')
    }
  }
}
</script>

<style lang="scss" scoped>
  .buttons-container {
    display: flex;
    justify-content: space-between;
    width: 100%;

    .button-group {
      width: 100%;
      display: flex;
      justify-content: flex-end;
      button {
        margin-left: 8px;
      }
    }
  }
</style>
