# BreadcrumbsWrapper Component

#### Props

|Name|Description|Type|Required|Default|
|---|---|---|---|---|
|baseCrumb|Sets the name of the home route '/'|`String`|`false`|'Home'|



#### Slots

|Name|Description|Slot Props|
|---|---|---|---|---|
|default|Default slot|`breadcrumbs`|



#### Description

The BreadcrumbsWrapper sets breadcrumbs in 3 different ways:

1. Automatic, based on the `$route.path`
2. Through meta tags in the router object.

3. Trough the *Vuex*-store in *BreadcrumbsModule*.



#### Usage 

Import BreadcrumbsWrapper-component. Wrap your breadcrumbs implementation with the `breadcrumb-wrapper` -tag and expose the breadcrumbs throught the the slot scope, like so: 

```vue
<breadcrumbs-wrapper baseCrumb="dashboard">
  <template #default="{ breadcrumbs }">
    {{ breadcrumbs }}
  </template>
</breadcrumbs-wrapper>
```



**Automatic breadcrumb generation**

If nothing is specified breadcrumbs will automatically be generated based on the route path. It will pick the last part of the path to use it as the route name. Eg. the path  `/users`  will result in the following route object: `{label: 'users', route: 'users'}`. So make sure to name your routes like the last part of the path:

``` js
{
  path: '/users',
  name: 'users'
}
```



**Breadcrumbs meta-tag in route object**

```js
 {
  path: '/example-path',
  name: 'example',
  component: () => import(/* webpackChunkName: "users" */ './views/Example.vue'),
  meta: {
    breadcrumbs: [createBreadcrumb('Upload documents', 'documents')]
  }
}
```



By setting a meta-tag for breadcrumbs in the route object of a route you can overwrite the automatically generated breadcrumbs. You can import and use the helper functions to create the breadcrumbs in the right format.



**Vuex store module**

For dynamic routes breadcrumbs can be dynamically set through the *Breadcrumbs* store module. Import the module in your index store file, like so: 

```js
import { BreadcrumbsModule } from '@/components/nav/breadcrumbs/BreadcrumbsModule'

export default new Vuex.Store({
  modules: {
    breadcrumbs: BreadcrumbsModule()
  }
})
```

No you can use the mutations to set the breadcrumbs dynamically. Eg.:

```js
setBreadcrumbs () {
	const breadcrumbs = [
 		['Users', 'users'],
    [this.formData.name, 'userDetail']
 ]

  this.$store.commit('breadcrumbs/SET_BREADCRUMBS', breadcrumbs)
}
```

Make sure to reset the breadcrumbs beforeRouteLeave:

```js
beforeRouteLeave (to, from, next) {
  this.$store.commit('breadcrumbs/RESET_BREADCRUMBS')
  next()
}
```

