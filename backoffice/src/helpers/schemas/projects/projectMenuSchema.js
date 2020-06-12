export default [
  {
    component: 'b-menu-list',
    menuItems: [
      {
        icon: 'information-outline',
        label: 'Details',
        tag: 'router-link',
        to: 'project-details',
        exact: true
      },
      {
        icon: 'file-tree',
        label: 'Tasks',
        tag: 'router-link',
        to: 'new-product-documents'
      },
      {
        icon: 'file-multiple-outline',
        label: 'Documents',
        tag: 'router-link',
        to: 'new-product-documents'
      },
      {
        icon: 'cloud-upload-outline',
        label: 'Publishing',
        tag: 'router-link',
        to: 'new-product-publishing'
      }
    ]
  }
]
