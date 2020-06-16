import { COUNTRIES } from '@/helpers/countryCodes.js'

export default [
  {
    fieldType: 'InputField',
    name: 'name',
    type: 'text',
    placeholder: 'VVE van Woustraat',
    label: 'Title',
    rules: 'required',
    class: 'is-full'
  },
  {
    fieldType: 'Divider',
    title: 'Location'
  },
  {
    fieldType: 'InputField',
    name: 'first_name',
    type: 'text',
    placeholder: 'Bob',
    label: 'First name',
    rules: 'required',
    class: 'is-half'
  },
  {
    fieldType: 'InputField',
    name: 'last_name',
    type: 'text',
    placeholder: 'Ross',
    label: 'Last name',
    rules: 'required',
    class: 'is-half'
  },
  {
    fieldType: 'InputField',
    name: 'email',
    type: 'text',
    placeholder: 'bob@ross.com',
    label: 'Email',
    rules: 'required|email',
    class: 'is-two-thirds'
  },
  {
    fieldType: 'InputField',
    name: 'phone',
    type: 'text',
    placeholder: '+31 6 12 34 56 78',
    label: 'Phone',
    rules: 'required'
  },
  {
    fieldType: 'InputField',
    name: 'street',
    type: 'text',
    placeholder: 'B. Ross lane',
    label: 'Street',
    rules: 'required',
    class: 'is-two-thirds'
  },
  {
    fieldType: 'InputField',
    name: 'house_number',
    type: 'text',
    placeholder: '16',
    label: 'Number',
    rules: 'required'
  },
  {
    fieldType: 'InputField',
    name: 'house_number_addition',
    type: 'text',
    placeholder: 'III',
    label: 'Addition',
    rules: ''
  },
  {
    fieldType: 'InputField',
    name: 'postal_code',
    type: 'text',
    placeholder: '1023 LV',
    label: 'Postal code',
    rules: 'required',
    class: 'is-one-fifth'
  },
  {
    fieldType: 'InputField',
    name: 'city',
    type: 'text',
    placeholder: 'Amsterdam',
    label: 'City',
    rules: 'required'
  },
  {
    fieldType: 'SelectField',
    name: 'country',
    type: 'text',
    placeholder: 'NL',
    label: 'Country',
    rules: 'required',
    options: COUNTRIES
  }
]
