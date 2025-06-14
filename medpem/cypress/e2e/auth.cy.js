describe('Authentication', () => {
  beforeEach(() => {
    // Ensure we're logged out before each test
    cy.visit('/logout', { failOnStatusCode: false })
    cy.visit('/login')
    cy.get('#login-form').should('be.visible')
  })

  it('should show login page', () => {
    // Check for login page elements
    cy.get('input[name="username"]').should('be.visible')
    cy.get('input[name="password"]').should('be.visible')
    cy.get('button[type="submit"]').should('be.visible')
  })

  it('should login successfully with user credentials', () => {
    // Use credentials from our custom command
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()

    // Should redirect to dashboard after login
    cy.url().should('include', '/dashboard')
  })

  it('should display error with invalid credentials', () => {
    // Try with invalid password
    cy.get('input[name="username"]').type('wronguser')
    cy.get('input[name="password"]').type('wrongpass')
    cy.get('button[type="submit"]').click()

    // Check for error message
    cy.get('.alert-danger, .error-message').should('be.visible')

    // Should stay on login page
    cy.url().should('include', '/login')
  })
})
