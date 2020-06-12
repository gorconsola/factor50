import axios from 'axios'
import { API_URL } from '@/config/config'

const JWT_TOKEN_HEADER_NAME = 'AUTHORIZATION'
const JWT_TOKEN_LOCALSTORAGE_KEY = 'x-auth-token'
const API_VERSION = '1.0'

export const isAuthenticated = () => {
  return !!localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)
}

export default class HttpBaseService {
  constructor (secure = true) {
    this.JWT_TOKEN_HEADER_NAME = JWT_TOKEN_HEADER_NAME
    this.JWT_TOKEN_LOCALSTORAGE_KEY = JWT_TOKEN_LOCALSTORAGE_KEY
    this.API_URL = API_URL
    this.API_VERSION = API_VERSION

    this.lastRequestResponseHeaders = {}

    if (this.constructor === HttpBaseService) {
      throw new TypeError('Cannot construct Abstract instances directly')
    }
    this.secure = secure
  }

  executeRequest (url, method, data, secure = this.secure, requestedResponseType = 'json') {
    const options = {
      headers: {
        Accept: `application/${this.API_VERSION}+json`,
        'Content-Type': 'application/json'
      },
      method: method,
      responseType: requestedResponseType
    }
    if (secure) {
      options.headers[JWT_TOKEN_HEADER_NAME] = 'Bearer ' + this.getAuthToken()
    }

    if (data) {
      if (method.toLowerCase() === 'get') {
        url = url + '?' + Object.keys(data).reduce((acc, cur) => {
          acc.push(`${cur}=${data[cur]}`)
          return acc
        }, []).join('&')
      } else {
        options.data = JSON.stringify(data)
      }
    }

    return axios({ ...options, url: this._getUrl(url) })
      .then(response => {
        if (response.status > 199 && response.status < 300) {
          return response.data
        }
        if (secure && response.status === 401) {
          this.handleUnAuthorizedRequest()
        }

        // eslint-disable-next-line
        return Promise.reject({
          status: response.status,
          statusText: response.statusText,
          data: response.data
        })
      }).catch(error => {
        if (secure && error && error.response && error.response.status && error.response.status === 401) {
          this.handleUnAuthorizedRequest()
        }
        // eslint-disable-next-line
        return Promise.reject({
          status: error.response.status,
          statusText: error.response.statusText,
          data: error.response.data,
          error: error
        })
      })
  }

  handleUnAuthorizedRequest () {
    this.deleteAuthToken()
    // Reload the page to force default action (redirect to login)
    window.location.reload()
  }

  getResponseHeader (headerName) {
    // eslint-disable-next-line
    if (this.lastRequestResponseHeaders.hasOwnProperty(headerName)) {
      return this.lastRequestResponseHeaders[headerName]
    }
    console.error(`Could not find header: ${headerName} in lastRequestResponseHeaders.`, this.lastRequestResponseHeaders)
    return null
    // return this.lastRequestResponseHeaders.get(headerName);
  }

  storeTokenFromRequest () {
    const token = this.getResponseHeader(this.JWT_TOKEN_HEADER_NAME)

    if (!token) {
      return false
    }
    this.saveAuthToken(token)
    return true
  }

  isAuthenticated () {
    if (this.getAuthToken()) {
      return true
    }
    return false
  }

  getAuthToken () {
    return localStorage.getItem(this.JWT_TOKEN_LOCALSTORAGE_KEY)
  }

  saveAuthToken (token) {
    localStorage.setItem(this.JWT_TOKEN_LOCALSTORAGE_KEY, token)
  }

  deleteAuthToken () {
    localStorage.removeItem(this.JWT_TOKEN_LOCALSTORAGE_KEY)
  }

  _getUrl (url) {
    if (url.indexOf('://') > -1) {
      return url
    }
    return this.API_URL + url
  }
}
