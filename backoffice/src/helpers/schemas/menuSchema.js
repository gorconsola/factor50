export default [
  {
    component: 'b-menu-list',
    menuItems: [
      {
        icon: 'monitor-dashboard',
        label: 'Dashboard',
        tag: 'router-link',
        to: 'dashboard',
        exact: true
      },
      {
        icon: 'flask-outline',
        label: 'Projects',
        tag: 'router-link',
        to: 'projects'
      }
    ]
  }
]
