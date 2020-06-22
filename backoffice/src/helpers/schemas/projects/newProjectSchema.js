export default [
  {
    fieldType: 'InputField',
    name: 'title',
    type: 'text',
    placeholder: 'VVE van Woustraat',
    label: 'Title',
    rules: 'required'
  },
  {
    fieldType: 'SelectField',
    name: 'project_template',
    type: 'text',
    placeholder: 'Project template',
    label: 'Template',
    rules: 'required',
    options: [
      { label: 'Solar, flat roof', value: 'flat_roof_solar' },
      { label: 'Solar, pitched roof', value: 'pitched_roof_solar' }
    ]
  }
]
