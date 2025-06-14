describe('Fitur Belajar', () => {
  beforeEach(() => {
    cy.loginAsUser();
    cy.visit('/belajar');
  });

  it('should display belajar index page', () => {
    cy.url().should('include', '/belajar');
    cy.get('.content-title').should('contain', 'BELAJAR');
    cy.get('.lesson-path-container').should('exist');
    cy.get('body').then($body => {
      if ($body.find('.lesson-circle').length > 0) {
        cy.get('.lesson-circle').should('exist');
      } else {
        cy.contains('Belum Ada Pelajaran').should('exist');
      }
    });
  });

  it('should start a new lesson', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').should('exist');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        cy.url().should('include', '/question');
      } else {
        cy.log('No active lesson circles available to start');
      }
    });
  });

  it('should answer questions in a lesson', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        // Answer questions
        cy.get('.question-prompt').should('exist');
        cy.get('.option-item').first().click({force: true});
        cy.get('.next-button').click({force: true});
        // Check if we're still in question mode or moved to complete
        cy.url().then(url => {
          if (url.includes('/question')) {
            cy.get('.question-prompt').should('exist');
          } else if (url.includes('/complete')) {
            cy.get('.completion-message').should('exist');
          }
        });
      } else {
        cy.log('No active lesson circles available to test questions');
      }
    });
  });

  it('should complete a lesson', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        // Answer all questions
        cy.get('.question-prompt').should('exist');
        cy.get('.option-item').first().click({force: true});
        cy.get('.next-button').click({force: true});
        // Should reach completion page
        cy.url().should('include', '/complete');
        cy.get('.completion-message').should('exist');
        cy.get('.points-earned').should('exist');
        cy.get('.review-button').should('exist');
      } else {
        cy.log('No active lesson circles available to test completion');
      }
    });
  });

  it('should review a completed lesson', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        // Complete the lesson
        cy.get('.question-prompt').should('exist');
        cy.get('.option-item').first().click({force: true});
        cy.get('.next-button').click({force: true});
        // Go to review
        cy.url().should('include', '/complete');
        cy.get('.review-button').click({force: true});
        cy.url().should('include', '/review');
        cy.get('.review-container').should('exist');
        cy.get('.question-review').should('exist');
      } else {
        cy.log('No active lesson circles available to test review');
      }
    });
  });

  it('should handle incorrect answer format', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        // Try to proceed without selecting an answer
        cy.get('.next-button').click({force: true});
        cy.get('.error-message').should('exist');
        cy.get('.error-message').should('contain', 'Pilih jawaban terlebih dahulu');
        // Select an answer and proceed
        cy.get('.option-item').first().click({force: true});
        cy.get('.next-button').click({force: true});
        cy.get('.error-message').should('not.exist');
      } else {
        cy.log('No active lesson circles available to test error handling');
      }
    });
  });

  it('should handle skipping questions', () => {
    cy.get('body').then($body => {
      const lessonCircles = $body.find('.lesson-circle.active');
      if (lessonCircles.length > 0) {
        cy.get('.lesson-circle.active').first().trigger('mouseover');
        cy.get('.lesson-node.active .lesson-tooltip form').first().submit();
        // Try to skip without answering
        cy.get('.skip-button').click({force: true});
        cy.get('.skip-confirmation').should('exist');
        cy.get('.skip-confirmation .confirm-skip').click({force: true});
        // Should move to next question
        cy.get('.question-prompt').should('exist');
        cy.get('.attempts-counter').should('exist');
      } else {
        cy.log('No active lesson circles available to test skipping');
      }
    });
  });
});
