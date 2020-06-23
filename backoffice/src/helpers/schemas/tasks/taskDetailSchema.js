export default [
  {
    fieldType: 'InputField',
    name: 'title',
    type: 'text',
    placeholder: 'Call Bob',
    label: 'Title',
    rules: 'required',
    class: 'is-full'
  },
  {
    fieldType: 'InputField',
    name: 'description',
    type: 'textarea',
    placeholder: 'Lorem ipsum dolor sit amet...',
    label: 'Description',
    rules: '',
    class: 'is-full'
  },
  {
    fieldType: 'DatePicker',
    name: 'start_date',
    label: 'Start date',
    type: 'is-primary',
    inline: false,
    rounded: true,
    rules: ''
  },
  {
    fieldType: 'DatePicker',
    name: 'end_date',
    label: 'End date',
    type: 'is-primary',
    inline: false,
    rounded: true,
    rules: ''
  }
]
