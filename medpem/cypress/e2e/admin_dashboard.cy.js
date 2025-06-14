describe('Admin Dashboard Tests', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('admin')
    cy.get('input[name="password"]').type('admin123')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
  })

  it('should display admin dashboard welcome title', () => {
    cy.get('.welcome-title').should('be.visible').and('contain', 'Dashboard Admin')
  })

  it('should display admin-only menu in sidebar', () => {
    cy.get('.sidebar-menu .sidebar-item').contains('KELOLA USER').should('be.visible')
    cy.get('.sidebar-menu .sidebar-item').contains('KELOLA MATERI').should('be.visible')
  })

  it('should access user management feature', () => {
    cy.get('.sidebar-menu .sidebar-item').contains('KELOLA USER').click()
    cy.url().should('include', '/admin/users')
  })

  it('should access materi management feature', () => {
    cy.get('.sidebar-menu .sidebar-item').contains('KELOLA MATERI').click()
    cy.url().should('include', '/admin/materi')
  })
})
