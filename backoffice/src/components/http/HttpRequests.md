# HTTP requests

Describes how to handle HTTP requests in Chimp Backoffice. Each HTTP-call will follow the following steps.

1. Use HTTP wrapper component.
2. Get HTTP service from 
3. Use HTTP service that extends the HttpBaseService class.
4. Handle response and errors in wrapper component.
5. Expose results through HTTP wrapper slot props. 





## ApiWrapper Component

### Props

|Name|Description|Type|Required|Default|
|---|---|---|---|---|
|endpoint|[serviceName].[methodName]|`String`|`true`|-|



### Slot Scope

| Name    | Type   | Description |
| ------- | ------------ | -------- |
| sendRequest | Method | Calls method defined by *endpoint* prop |
| loading | Boolean | Is call still executing? |
| error | Error | What went wrong? |



### Description

The ApiWrapper component handles requests that are defined in HttpService classes that extend the *HttpBaseService*. These classes are defined by the user himself and exposed to the ApiWrapper component by importing them into the `services/index.js`  file. The request can be simply made by passing the method as a prop to the ApiWrapper component and calling the exposed sendRequest method. 



### Usage

1. Create HTTP service that extends *HttpBaseService*:

```js
import HttpBaseService from './http/HttpBaseService'

class AccountService extends HttpBaseService {
  login = (payload) => {
    return this.executeRequest(`/auth/login`, 'POST',
      {
        email: payload.email,
        password: payload.password
      })
  }
}

export default new AccountService()
```



2. Import service into  `services/index.js` file: 

```js
import accountService from './AccountService'

export default {
  accountService: accountService
}

```



3. Import *ApiWrapper* component and use in view / component:

```vue
<api-wrapper
  endpoint="accountService.login"
  @success="handleRouting">
    
    <template slot-scope="{ loading, sendRequest }">
			
			// rest of component			

		</template>
</api-wrapper>
```



4. Call *sendRequest* method as soon as you need it:

```vue
<api-wrapper
  endpoint="accountService.login"
  @success="handleRouting">
    
  <template slot-scope="{ loading, sendRequest }">
	  <form @submit="sendRequest">
      // form
    </form>
  </template>
</api-wrapper>
```



5. Handle success by listening to @success-event.

 



## CrudWrapper Component

### Props

| Name     | Description    | Type     | Required | Default |
| -------- | -------------- | -------- | -------- | ------- |
| endpoint | [resourceName] | `String` | `true`   | -       |


### Slot Scope

|Name|Type|Description|
|---|---|---|
|data|Array|Exposes the results of the HTTP calls|
|getAll|Method|Gets all instances of specified resource|
|create|Method|Creates new resource|
|read|Method|Get resource by ID (specified by route param)|
|update|Method|Update resource with ID (specified by route param)|
|remove|Method|Delete resource withID (specified by route param)|
|loading|Boolean|Is call still executing?|
|Error|Error|What went wrong?|

### Description

For HTTP-requests that follow the CRUD standards the CrudWrapper component can be used. If the CrudWrapper is used, you don't have to create a new HTTP-service. The endpoint prop excepts the resource name and automatically exposes the all CRUD methods for the resource.



### Usage

1. Import *CrudWrapper* component and use in view / component:

   ```vue
   <crud-wrapper
     endpoint="users"
     @success="handleRouting">
     
       <template slot-scope="{ loading, create, read, update, remove, data }">
   
         // Rest of component
   
       </template>
   </crud-wrapper>
   ```

   

2. Call exposed method when needed:

   ``` vue
   <crud-wrapper
     endpoint="users"
     @success="handleRouting">
     
       <template slot-scope="{ loading, create, read, update, remove, data }">
   
   			<form @submit="update">
           // form
         </form>
   
       </template>
   </crud-wrapper>
   ```

   

3. Handle success by listening to @success-event.


