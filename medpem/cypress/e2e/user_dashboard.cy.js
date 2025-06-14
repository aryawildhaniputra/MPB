describe('User Dashboard Tests', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
  })

  it('should display welcome title', () => {
    cy.get('.welcome-title').should('be.visible').and('contain', 'Halo')
  })

  it('should display main statistics', () => {
    cy.get('.stat-card .stat-label').should('contain', 'Peringkatmu')
    cy.get('.stat-card .stat-label').should('contain', 'Penghargaan')
    cy.get('.stat-card .stat-label').should('contain', 'Materi Selesai')
    cy.get('.stat-card .stat-value').should('exist')
  })

  it('should display welcome message with Halo', () => {
    cy.get('.welcome-title').should('contain', 'Halo')
  })

  it('should display adventure section', () => {
    cy.get('.adventure-card').should('have.length.at.least', 1)
    cy.get('.adventure-card').first().should('be.visible')
  })

  it('should navigate through sidebar menu items', () => {
    // Dashboard
    cy.get('.sidebar-menu .sidebar-item').contains('MENU UTAMA').click()
    cy.url().should('include', '/dashboard')

    // Materi Belajar
    cy.get('.sidebar-menu .sidebar-item').contains('MATERI BELAJAR').click()
    cy.url().should('include', '/user/materi')

    // Belajar Singkat
    cy.get('.sidebar-menu .sidebar-item').contains('BELAJAR SINGKAT').click()
    cy.url().should('include', '/belajar')

    // Permainan
    cy.get('.sidebar-menu .sidebar-item').contains('PERMAINAN').click()
    cy.url().should('include', '/permainan')

    // Papan Peringkat
    cy.get('.sidebar-menu .sidebar-item').contains('PAPAN PERINGKAT').click()
    cy.url().should('include', '/skor')
  })

  // it('should logout successfully', () => {
  //   // Perlu update selector jika sudah ada tombol logout di header
  //   cy.get('.logout-button').click()
  //   cy.url().should('include', '/login')
  // })
})
