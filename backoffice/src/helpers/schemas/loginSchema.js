export default [
  {
    fieldType: 'InputField',
    name: 'email',
    type: 'text',
    placeholder: 'dinkie@spf50.com',
    label: 'Email',
    rules: 'required|email',
    rounded: true
  },
  {
    fieldType: 'InputField',
    name: 'password',
    type: 'password',
    placeholder: '****',
    label: 'Password',
    rules: 'required',
    rounded: true
  }
]
