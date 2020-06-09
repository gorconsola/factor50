export default [
  {
    fieldType: 'InputField',
    name: 'email',
    type: 'text',
    placeholder: 'Je email',
    label: 'Email',
    rules: 'required|email',
    rounded: true
  },
  {
    fieldType: 'InputField',
    name: 'password',
    type: 'password',
    placeholder: '****',
    label: 'Wachtwoord',
    rules: 'required',
    rounded: true
  }
]
