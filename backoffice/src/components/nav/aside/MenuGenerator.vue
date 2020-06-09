<template>
  <body class="menu-container">
    <b-menu>
      <b-menu-list
        v-for="(menuList, listIndex) in schema"
        :key="`${menuList.label}-${listIndex}`"
        :label="menuList.label || undefined"
      >
        <b-menu-item
          v-for="(item, index) in menuList.menuItems"
          :key="`${item.label}-${index}`"
          :icon="item.icon"
          :label="!item.menuItems ? item.label : undefined"
          :tag="item.tag ? item.tag : 'a'"
          :expanded="!item.tag"
          :exact="item.exact"
          :to="item.tag
            ? {
              name: item.to,
              params: { ...item.params }
            }
            : undefined"
        >
          <template
            v-if="item.menuItems"
            slot="label"
            slot-scope="props"
          >
            {{ item.label }}

            <b-icon
              class="chevron is-pulled-right"
              :class="props.expanded ? 'active' : ''"
              :icon="'chevron-right'"
              type="is-grey"
              size="is-small"
            />
          </template>

          <b-menu-item
            v-for="(nestedItem, index) in item.menuItems"
            :key="`${item.label}-${nestedItem.label}-${index}`"
            :icon="nestedItem.icon"
            :label="nestedItem.label"
            :tag="nestedItem.tag"
            :to="nestedItem.tag
              ? {
                name: nestedItem.to,
                params: { ...nestedItem.params }
              }
              : undefined"
          />
        </b-menu-item>
      </b-menu-list>
    </b-menu>
  </body>
</template>

<script>
export default {
  name: 'MenuGenerator',
  props: {
    schema: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="scss">
@import "@/assets/scss/buefy-config.scss";

.menu-container {
  padding: 0;

  .icon {
    margin-right: 1em;
  }

  .menu-label {
    margin-left: 1.5em;
    margin-bottom: 1.5em;
  }

  .menu-list {
    font-weight: 400;
    color: $darkest-grey;
    letter-spacing: 0.2px;

    li {
      position: relative;

      .chevron {
        font-size: 12px;
        font-weight: 100;
        transition: 125ms;

        &.active {
          transform: rotate(90deg);
        }
      }

      li {
        &:before {
          position: absolute;
          content: '↳';
          width: 1em;
          height: 1em;
          left: 0;
          top: 50%;
          transform: translateY(-50%);
          color: $dark-grey;
        }

        a {
          color: $dark-grey;
          font-weight: 400;
          padding-left: 2em;

          &:after {
            content: '';
          }
        }
      }

      a {
        padding: 0.5em 1.25em;
      }

    }
    .router-link-active {
      font-weight: 600;
      i {
        color: #EF5850;
      }
    }
  }
}
</style>
