export default [
  {
    component: 'b-menu-list',
    menuItems: [
      {
        icon: 'speedometer',
        label: 'Dashboard',
        tag: 'router-link',
        to: 'dashboard',
        exact: true
      },
      {
        icon: 'file-tree',
        label: 'Projects',
        tag: 'router-link',
        to: 'projects',
        exact: true
      }
    ]
  }
]
