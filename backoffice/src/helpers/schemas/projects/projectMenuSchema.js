export default [
  {
    component: 'b-menu-list',
    menuItems: [
      {
        icon: 'information-outline',
        label: 'Details',
        tag: 'router-link',
        to: 'details',
        exact: true
      },
      {
        icon: 'file-tree',
        label: 'Tasks',
        tag: 'router-link',
        to: 'tasks',
        exact: true
      },
      {
        icon: 'file-multiple-outline',
        label: 'Documents',
        tag: 'router-link',
        to: 'documents',
        exact: true
      },
      {
        icon: 'cloud-upload-outline',
        label: 'Publishing',
        tag: 'router-link',
        to: 'project-publishing',
        exact: true
      }
    ]
  }
]
