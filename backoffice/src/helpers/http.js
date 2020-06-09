import services from './../services/index.js'

export const getEndpoint = (endpointString) => {
  const keyValue = endpointString.split('.')

  // Check if given string has the right format
  if (keyValue.length !== 2) {
    // eslint-disable-next-line
    throw "The endpoint should be consisting of a key value pair separated by a '.', eg: 'filename.function'"
  }

  const fileName = keyValue[0]
  const functionName = keyValue[1]

  const service = services[fileName]

  // Check if service exists
  // eslint-disable-next-line
  if (!service) throw `Could not find service ${fileName}.`

  const endpoint = service[functionName]

  // Check if function exists
  // eslint-disable-next-line
  if (!endpoint) throw `Could not find service function ${functionName}.`

  return endpoint
}
