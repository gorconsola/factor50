<template>
  <pagination-wrapper
    :meta="meta"
    @updatePage="payload => $emit('update', payload)"
  >
    <template #default="{ next, updatePageCount, updatePage }">
      <div class="pagination-container">
        <b-select
          v-if="pageCount"
          name="per_page"
          :value="meta.per_page"
          class="per-page"
          @input="updatePageCount"
          rounded
        >
          <option
            v-for="option in perPageOptions"
            :key="option"
            :value="option"
          >
            {{ option }}
          </option>
        </b-select>

        <div class="current-items">
          {{ meta.from }} - {{ meta.to }} from {{ meta.total }}
        </div>

        <ul class="pages">
          <li
            v-if="hasPrev"
            @click="updatePage(meta.current_page - 1)"
          >
            <!-- eslint-disable-next-line -->
            < Previous
          </li>

          <li
            v-if="showBeginPage"
            @click="updatePage(1)"
          >
            1
          </li>

          <li
            v-if="showFirstDots"
            @click="updatePage(meta.current_page - (extraButtons + 1))"
          >
            ...
          </li>

          <template v-for="(page, index) in currentRange">
            <li
              v-if="page > 0 && page <= meta.last_page"
              :key="index"
              :class="{active: meta.current_page === page}"
              @click="updatePage(page)"
            >
              {{ page }}
            </li>
          </template>

          <li
            v-if="showLastDots"
            @click="updatePage(meta.current_page + (extraButtons + 1))"
          >
            ...
          </li>

          <li
            v-if="showLastPage"
            @click="updatePage(meta.last_page)"
          >
            {{ meta.last_page }}
          </li>

          <li
            v-if="hasNext"
            @click="updatePage(meta.current_page + 1)"
          >
            Next >
          </li>
        </ul>
      </div>
    </template>
  </pagination-wrapper>
</template>

<script>
import PaginationWrapper from '@/components/nav/pagination/PaginationWrapper'

export default {
  name: 'Pagination',
  components: {
    PaginationWrapper
  },
  props: {
    meta: {
      type: Object,
      required: true
    },
    numPageButtons: {
      type: Number,
      default: 3
    },
    perPageOptions: {
      type: Array,
      default: () => [
        15,
        30,
        60,
        120,
        240
      ]
    },
    pageCount: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    hasPrev () {
      return this.meta.current_page > 1
    },
    hasNext () {
      return this.meta.current_page < this.meta.last_page
    },
    extraButtons () {
      return (this.numPageButtons - 1) / 2
    },
    currentRange () {
      const leftButtons = this.meta.current_page - this.extraButtons
      const rightButtons = this.meta.current_page + this.extraButtons + 1

      const result = []

      for (let i = leftButtons; i < rightButtons; i++) {
        result.push(i)
      }

      return result
    },
    showBeginPage () {
      return this.meta.current_page - this.extraButtons > 1
    },
    showLastPage () {
      return (this.meta.current_page + this.extraButtons) < (this.meta.last_page)
    },
    showLastDots () {
      return (this.meta.current_page + this.extraButtons) < (this.meta.last_page - 1)
    },
    showFirstDots () {
      return (this.meta.current_page - this.extraButtons) > 2
    }
  }
}
</script>

<style lang="scss" scoped>
  .pagination-container {
    display: flex;
    align-items: center;

  .per-page, .current-items {
    padding: 0 10px;
  }

  .pages {
    margin: 0;
    padding: 0 10px;
    display: flex;

    li {
      padding: 0 10px;
      list-style-type: none;
      margin: 0;
      cursor: pointer;
      color: rgba(0,0,0,0.1);

      &:hover {
        color: #00d1b2;
      }

      &.active {
        color: #00d1b2;
      }
    }
  }
}
</style>
