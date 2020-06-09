<template>
  <api-wrapper
    ref="apiWrapper"
    endpoint="accountService.logout"
  >
    <template #default>
      <div class="user">
        <div class="user__profile">
          <div class="pf">
            {{ user.name.charAt(0) }}
          </div>
          <div class="user__profile__info">
            <span>
              {{ user.name }}
            </span>
            <span class="is-uppercase role">
              Administrator
            </span>
          </div>
          <b-icon
            class="chevron"
            :icon="'chevron-right'"
            type="is-grey"
            size="is-small"
          />
        </div>
        <div
          class="user__logout"
          :class="{'visible': showLogout}"
          @click="logout"
        >
          <span class="icon m-r-24">
            <i class="mdi mdi-logout default" />
          </span>
          <span>
            Log out
          </span>
        </div>
      </div>
    </template>
  </api-wrapper>
</template>

<script>
import ApiWrapper from '@/components/http/ApiWrapper.js'

export default {
  name: 'UserComponent',
  components: {
    ApiWrapper
  },
  data () {
    return {
      showLogout: false
    }
  },
  computed: {
    user () {
      return this.$store.state.authentication.user
    }
  },
  methods: {
    logout () {
      this.$refs.apiWrapper.sendRequest()
        .finally(() => {
          this.$router.push({ name: 'login' })
        })
    }
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/scss/buefy-config.scss';

.user {
  display: flex;
  flex-direction: column;
  position: absolute;
  top: 0;
  right: 0;
  cursor: pointer;

  .user__profile {
    background-color: #2A2D2E;
    padding: 0 1.5em;
    width: 240px;
    height: 3.5em;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-grow: 1;
    position: relative;
    z-index: 1;

    .pf {
      width: 2em;
      height: 2em;
      background-color: $negative;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      margin-right: 1em;
    }

    .user__profile__info {
      display: flex;
      flex-direction: column;
      font-size: 14px;

      .role {
        opacity: .5;
        font-size: 10px;
      }
    }

    .chevron {
      color: #fff;
      font-size: 10px;
      transform-origin: center;
      transition: 125ms transform;
    }
  }

  .user__logout {
    height: 3.5em;
    background-color: #1F2223;
    display: flex;
    align-items: center;
    padding: 0 1.5em;
    transform: translateY(-100%);
    z-index: 0;
    transition: 125ms transform;
  }

  &:hover {
    .chevron {
      transform: rotate(90deg);
    }
    .user__logout {
      transform: translateY(0%);
    }
  }
}
</style>
