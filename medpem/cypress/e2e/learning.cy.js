describe('Learning/Lesson Tests', () => {
  beforeEach(() => {
    cy.login('user@example.com', 'password123')
    cy.visit('/belajar')
  })

  it('should display list of lessons', () => {
    cy.get('[data-testid="lesson-list"]').should('be.visible')
    cy.get('[data-testid="lesson-item"]').should('have.length.at.least', 1)
    cy.get('[data-testid="lesson-level"]').should('be.visible')
  })

  it('should start a new lesson', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.url().should('include', '/belajar/lesson/')
    cy.get('[data-testid="lesson-content"]').should('be.visible')
    cy.get('[data-testid="lesson-parts"]').should('be.visible')
    cy.get('[data-testid="start-lesson-button"]').click()
    cy.get('[data-testid="question-container"]').should('be.visible')
  })

  it('should answer questions correctly', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="start-lesson-button"]').click()

    // Answer first question
    cy.get('[data-testid="question-text"]').should('be.visible')
    cy.get('[data-testid="answer-input"]').type('correct answer')
    cy.get('[data-testid="submit-answer"]').click()
    cy.get('[data-testid="correct-feedback"]').should('be.visible')

    // Check points awarded
    cy.get('[data-testid="points-awarded"]').should('be.visible')

    // Move to next question
    cy.get('[data-testid="next-question"]').click()
  })

  it('should handle advanced questions', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="start-lesson-button"]').click()

    // Find advanced question
    cy.get('[data-testid="question-container"]').each(($question) => {
      if ($question.find('[data-testid="is-advanced"]').length) {
        cy.wrap($question).within(() => {
          cy.get('[data-testid="answer-input"]').type('advanced answer')
          cy.get('[data-testid="submit-answer"]').click()
          cy.get('[data-testid="points-awarded"]').should('contain', '10')
        })
      }
    })
  })

  it('should handle incorrect answer format', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="start-lesson-button"]').click()

    // Submit empty answer
    cy.get('[data-testid="submit-answer"]').click()
    cy.get('[data-testid="error-message"]').should('be.visible')

    // Submit invalid format
    cy.get('[data-testid="answer-input"]').type('!@#$%')
    cy.get('[data-testid="submit-answer"]').click()
    cy.get('[data-testid="error-message"]').should('be.visible')
  })

  it('should complete lesson and show results', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="start-lesson-button"]').click()

    // Answer all questions
    cy.get('[data-testid="question-container"]').each(($question) => {
      cy.wrap($question).within(() => {
        cy.get('[data-testid="answer-input"]').type('test answer')
        cy.get('[data-testid="submit-answer"]').click()
        cy.get('[data-testid="next-question"]').click()
      })
    })

    // Check results page
    cy.get('[data-testid="lesson-results"]').should('be.visible')
    cy.get('[data-testid="total-points"]').should('be.visible')
    cy.get('[data-testid="part-points"]').should('be.visible')
    cy.get('[data-testid="review-button"]').should('be.visible')
  })

  it('should review completed lesson', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="review-button"]').click()

    cy.get('[data-testid="review-content"]').should('be.visible')
    cy.get('[data-testid="question-review"]').should('have.length.at.least', 1)
    cy.get('[data-testid="correct-answer"]').should('be.visible')
    cy.get('[data-testid="points-earned"]').should('be.visible')
  })

  it('should update learning progress and stats', () => {
    cy.get('[data-testid="lesson-item"]').first().click()
    cy.get('[data-testid="start-lesson-button"]').click()

    // Complete lesson
    cy.get('[data-testid="question-container"]').each(($question) => {
      cy.wrap($question).within(() => {
        cy.get('[data-testid="answer-input"]').type('test answer')
        cy.get('[data-testid="submit-answer"]').click()
        cy.get('[data-testid="next-question"]').click()
      })
    })

    // Check progress update
    cy.visit('/dashboard')
    cy.get('[data-testid="learning-progress"]').should('contain', '1')
    cy.get('[data-testid="total-points"]').should('be.visible')
    cy.get('[data-testid="lessons-completed"]').should('be.visible')
  })
})
