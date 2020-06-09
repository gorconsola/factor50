export const createBreadcrumb = (label, route = '$route.name') => ({
  label: label,
  route: route
})

export const createBreadcrumbs = (breadcrumbs) => {
  return breadcrumbs.map(crumb => {
    const label = crumb[0]
    const route = crumb.length === 2 && crumb[1]

    return createBreadcrumb(label, route)
  })
}
