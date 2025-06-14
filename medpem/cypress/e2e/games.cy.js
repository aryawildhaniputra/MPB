describe('Games Tests', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('#login-button').click()
    cy.url().should('include', '/dashboard')
    cy.get('.sidebar-item .sidebar-text').contains('PERMAINAN').click()
    cy.url().should('include', '/permainan')
  })

  it('should display list of available games', () => {
    cy.get('.content-title').should('contain', 'PERMAINAN')
    cy.get('body').then($body => {
      if ($body.find('.game-card').length > 0) {
        cy.get('.game-card').should('exist')
      } else {
        cy.contains('Belum Ada Permainan').should('exist')
      }
    })
  })

  it('should play Word Scramble game', () => {
    cy.get('[data-testid="game-item"]').contains('Word Scramble').click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Play the game
    cy.get('[data-testid="scrambled-word"]').should('be.visible')
    cy.get('[data-testid="answer-input"]').type('correctword')
    cy.get('[data-testid="submit-answer"]').click()
    cy.get('[data-testid="feedback"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Mark as completed
    cy.get('[data-testid="mark-complete"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should play Word Matching game', () => {
    cy.get('[data-testid="game-item"]').contains('Word Matching').click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Match words
    cy.get('[data-testid="word-card"]').first().click()
    cy.get('[data-testid="word-card"]').eq(1).click()
    cy.get('[data-testid="match-feedback"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Complete game
    cy.get('[data-testid="mark-complete"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should play Word Search game', () => {
    cy.get('[data-testid="game-item"]').contains('Word Search').click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Find words
    cy.get('[data-testid="word-grid"]').should('be.visible')
    cy.get('[data-testid="word-list"]').should('be.visible')

    // Mark found words
    cy.get('[data-testid="word-item"]').first().click()
    cy.get('[data-testid="found-word"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Complete game
    cy.get('[data-testid="mark-complete"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should play Hangman game', () => {
    cy.get('[data-testid="game-item"]').contains('Hangman').click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Guess letters
    cy.get('[data-testid="letter-input"]').type('a')
    cy.get('[data-testid="guess-feedback"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Complete game
    cy.get('[data-testid="mark-complete"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should play House game', () => {
    cy.get('[data-testid="game-item"]').contains('House').click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Play house game
    cy.get('[data-testid="house-item"]').first().click()
    cy.get('[data-testid="house-feedback"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Complete game
    cy.get('[data-testid="mark-complete"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should handle incomplete game exit', () => {
    cy.get('[data-testid="game-item"]').first().click()
    cy.get('[data-testid="game-container"]').should('be.visible')

    // Exit without completing
    cy.get('[data-testid="exit-game"]').click()
    cy.get('[data-testid="confirm-exit"]').click()
    cy.url().should('include', '/permainan')

    // Check progress not updated
    cy.get('[data-testid="game-item"]').first()
      .find('[data-testid="completion-status"]')
      .should('not.have.class', 'completed')
  })

  it('should update game progress and points', () => {
    // Complete a game
    cy.get('[data-testid="game-item"]').first().click()
    cy.get('[data-testid="mark-complete"]').click()

    // Check progress update
    cy.visit('/dashboard')
    cy.get('[data-testid="games-progress"]').should('contain', '1')
    cy.get('[data-testid="total-points"]').should('be.visible')
    cy.get('[data-testid="games-completed"]').should('be.visible')
  })
})
