describe('Login Page Tests', () => {
  beforeEach(() => {
    // Ensure we're logged out before each test
    cy.visit('/logout', { failOnStatusCode: false })
    cy.visit('/login')
    cy.get('#login-form').should('be.visible')
  })

  it('should login successfully with valid credentials', () => {
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
  })

  it('should show error when only username is entered', () => {
    cy.get('input[name="username"]').type('user')
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should show error when only password is entered', () => {
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should show error with incorrect credentials', () => {
    cy.get('input[name="username"]').type('wronguser')
    cy.get('input[name="password"]').type('wrongpass')
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should show error when submitting empty form', () => {
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should handle special characters in username', () => {
    cy.get('input[name="username"]').type('user@#$%')
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should show error for password less than minimum length', () => {
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('123')
    cy.get('button[type="submit"]').click()
    cy.get('.error-message').should('be.visible')
  })

  it('should trim whitespace from username', () => {
    cy.get('input[name="username"]').type('  user  ')
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
  })
})
