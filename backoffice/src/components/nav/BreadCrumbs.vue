<template>
  <breadcrumbs-wrapper base-crumb="dashboard">
    <template #default="{ breadcrumbs }">
      <section class="section is-title-bar">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <nav
                class="breadcrumb is-left-mobile"
                aria-label="breadcrumbs"
              >
                <ul>
                  <router-link
                    v-for="(crumb, index) in breadcrumbs"
                    :key="index"
                    :to="{ name: crumb.route }"
                    :class="{'is-primary': index === breadcrumbs.length - 1}"
                    tag="li"
                  >
                    {{ crumb.label | title }}
                  </router-link>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </section>
    </template>
  </breadcrumbs-wrapper>
</template>

<script>
import BreadcrumbsWrapper from '@/components/nav/breadcrumbs/BreadcrumbsWrapper'

export default {
  name: 'BreadCrumbs',
  components: { BreadcrumbsWrapper }
}
</script>

<style lang="scss" scoped>
@import "@/assets/scss/buefy-config.scss";

.section {
  padding: 1rem 1.5rem !important;

  @include from($tablet) {
    padding: 3rem 2.5rem 0 !important;
  }

  li {
    font-size: 0.75rem;
    font-weight: 600;
    padding-right: 3px;
    text-transform: uppercase;
    letter-spacing: 0.5px;

    &:before {
      margin-right: 3px;
    }

    &:last-of-type {
      pointer-events: none;
    }
  }
}
</style>
