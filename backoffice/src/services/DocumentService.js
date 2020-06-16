import HttpBaseService from './http/HttpBaseService'

class DocumentService extends HttpBaseService {
  upload = (payload) => {
    this.secure = true

    if (!payload.folder) {
      throw new Error('Please provide a folder name in the payload object. (eg. payload.folder = foldername)')
    }

    return this.executeRequest('/documents/upload', 'POST', payload)
  }

  getBase64 (file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader()
      reader.readAsDataURL(file)
      reader.onload = () => resolve(reader.result)
      reader.onerror = error => reject(error)
    })
  }

  downloadDocument (url) {
    return this.executeRequest(url, 'GET', null, true, 'arraybuffer')
  }
}

export default new DocumentService()
