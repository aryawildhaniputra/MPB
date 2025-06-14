describe('Landing Page Tests', () => {
  beforeEach(() => {
    // Ensure we're logged out by visiting logout route
    cy.visit('/logout', { failOnStatusCode: false })
    cy.visit('/')
    // Wait for page to load
    cy.get('body').should('be.visible')
  })

  it('should display landing page without login', () => {
    cy.url().should('eq', 'https://mpb.oopedia.com/')
    cy.get('h1').should('contain', 'Ayo Belajar Bahasa Inggris')
    // Check for login button with correct class and text
    cy.get('.login-button').should('be.visible')
    cy.get('.login-button').should('contain', 'Mulai Petualangan')
  })

  it('should display main sections', () => {
    cy.get('h3').contains('Pelajaran Seru').should('be.visible')
    cy.get('h3').contains('Bermain Sambil Belajar').should('be.visible')
    cy.get('h3').contains('Kumpulkan Bintang').should('be.visible')
  })

  it('should navigate to login page when clicking login button', () => {
    // Click the login button with correct class
    cy.get('.login-button').click()
    cy.url().should('include', '/login')
  })

  it('should display footer information', () => {
    cy.get('footer').should('contain', '© 2023 Media Pembelajaran Bahasa Inggris')
    cy.get('footer').should('contain', 'Dibuat dengan')
    cy.get('footer').should('contain', 'untuk siswa SD')
  })
})
