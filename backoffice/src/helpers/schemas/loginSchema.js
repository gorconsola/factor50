export default [
  {
    fieldType: 'InputField',
    name: 'email',
    type: 'text',
    placeholder: 'dinkie@spf50.com',
    label: 'Email',
    rules: 'required|email',
    class: 'is-full'
  },
  {
    fieldType: 'InputField',
    name: 'password',
    type: 'password',
    placeholder: '****',
    label: 'Password',
    rules: 'required',
    class: 'is-full'
  }
]
