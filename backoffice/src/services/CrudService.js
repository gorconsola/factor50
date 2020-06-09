import HttpBaseService from './http/HttpBaseService'

class CrudService extends HttpBaseService {
  getAll = (uri, payload) => {
    return this.executeRequest(`/${uri}`, 'GET', payload)
  }

  create = (uri, payload) => {
    return this.executeRequest(`/${uri}`, 'POST', payload)
  }

  read = (uri, payload) => {
    return this.executeRequest(`/${uri}`, 'GET', payload)
  }

  update = (uri, payload) => {
    return this.executeRequest(`/${uri}`, 'PATCH', payload)
  }

  remove = (uri, payload) => {
    return this.executeRequest(`/${uri}`, 'DELETE', payload)
  }
}

export default new CrudService()
