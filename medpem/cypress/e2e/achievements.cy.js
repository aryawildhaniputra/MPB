describe('Achievements and Leaderboard Tests', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('#login-button').click()
    cy.url().should('include', '/dashboard')
    cy.visit('/achievements')
    cy.url().should('include', '/achievements')
  })

  describe('Achievements Tests', () => {
    it('should display achievements page', () => {
      cy.get('.content-title').should('contain', 'PENCAPAIAN')
      cy.get('body').then($body => {
        if ($body.find('.achievement-card').length > 0) {
          cy.get('.achievement-card').should('exist')
        } else {
          cy.contains('Belum Ada Pencapaian').should('exist')
        }
      })
    })

    it('should display achievement names and rewards', () => {
      cy.get('body').then($body => {
        if ($body.find('.achievement-card').length > 0) {
          cy.get('.achievement-card').each($card => {
            cy.wrap($card).find('.achievement-name').should('exist')
            cy.wrap($card).find('.achievement-reward').should('exist')
          })
        } else {
          cy.contains('Belum Ada Pencapaian').should('exist')
        }
      })
    })

    it('should show locked achievements', () => {
      cy.get('[data-testid="achievement-item"]').each(($achievement) => {
        cy.wrap($achievement).within(() => {
          cy.get('[data-testid="achievement-status"]').should('be.visible')
          cy.get('[data-testid="achievement-progress"]').should('be.visible')
          cy.get('[data-testid="achievement-criteria"]').should('be.visible')
        })
      })
    })

    it('should display achievement details', () => {
      cy.get('[data-testid="achievement-item"]').first().click()
      cy.get('[data-testid="achievement-details"]').should('be.visible')
      cy.get('[data-testid="achievement-description"]').should('be.visible')
      cy.get('[data-testid="achievement-criteria"]').should('be.visible')
      cy.get('[data-testid="achievement-reward"]').should('be.visible')
    })

    it('should update achievement progress', () => {
      // Complete some activities to earn achievements
      cy.visit('/belajar')
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

      // Check achievement progress
      cy.visit('/achievements')
      cy.get('[data-testid="achievement-progress"]').first()
        .should('have.attr', 'style')
        .and('include', 'width: 100%')
    })

    it('should check speed achievements', () => {
      // Complete lesson quickly
      cy.visit('/belajar')
      cy.get('[data-testid="lesson-item"]').first().click()
      cy.get('[data-testid="start-lesson-button"]').click()

      // Answer questions quickly
      cy.get('[data-testid="question-container"]').each(($question) => {
        cy.wrap($question).within(() => {
          cy.get('[data-testid="answer-input"]').type('test answer')
          cy.get('[data-testid="submit-answer"]').click()
          cy.get('[data-testid="next-question"]').click()
        })
      })

      // Check speed achievement
      cy.visit('/achievements')
      cy.get('[data-testid="achievement-item"]')
        .contains('Speed Master')
        .parent()
        .find('[data-testid="achievement-status"]')
        .should('contain', 'Unlocked')
    })
  })

  describe('Leaderboard Tests', () => {
    beforeEach(() => {
      cy.visit('/leaderboard')
    })

    it('should display leaderboard', () => {
      cy.get('[data-testid="leaderboard-table"]').should('be.visible')
      cy.get('[data-testid="leaderboard-row"]').should('have.length.at.least', 1)
    })

    it('should show user rankings', () => {
      cy.get('[data-testid="leaderboard-row"]').each(($row, index) => {
        cy.wrap($row).within(() => {
          cy.get('[data-testid="rank"]').should('contain', index + 1)
          cy.get('[data-testid="username"]').should('be.visible')
          cy.get('[data-testid="total-points"]').should('be.visible')
          cy.get('[data-testid="achievements-count"]').should('be.visible')
        })
      })
    })

    it('should filter leaderboard by time period', () => {
      cy.get('[data-testid="time-filter"]').select('weekly')
      cy.get('[data-testid="leaderboard-table"]').should('be.visible')

      cy.get('[data-testid="time-filter"]').select('monthly')
      cy.get('[data-testid="leaderboard-table"]').should('be.visible')

      cy.get('[data-testid="time-filter"]').select('all-time')
      cy.get('[data-testid="leaderboard-table"]').should('be.visible')
    })

    it('should search leaderboard entries', () => {
      cy.get('[data-testid="search-input"]').type('test')
      cy.get('[data-testid="leaderboard-row"]').should('contain', 'test')
    })

    it('should update leaderboard after completing activities', () => {
      // Complete a lesson to earn points
      cy.visit('/belajar')
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

      // Check leaderboard update
      cy.visit('/leaderboard')
      cy.get('[data-testid="leaderboard-row"]')
        .contains('user@example.com')
        .parent()
        .find('[data-testid="total-points"]')
        .should('not.equal', '0')
    })
  })
})
