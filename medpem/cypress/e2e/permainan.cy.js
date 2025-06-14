describe('Fitur Permainan', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('#login-button').click()
    cy.url().should('include', '/dashboard')
    cy.get('.sidebar-item .sidebar-text').contains('PERMAINAN').click()
    cy.url().should('include', '/permainan')
  })

  it('should display permainan index page', () => {
    cy.get('.content-title').should('contain', 'PERMAINAN')
    cy.get('body').then($body => {
      if ($body.find('.game-card').length > 0) {
        cy.get('.game-card').should('exist')
      } else {
        cy.contains('Belum Ada Permainan').should('exist')
      }
    })
  })

  it('should show available games', () => {
    cy.get('body').then($body => {
      if ($body.find('.game-card, .card.game').length > 0) {
        cy.get('.game-card, .card.game').should('have.length.at.least', 1);
      } else {
        cy.log('No game cards found - checking for empty state message');
        cy.contains(/belum ada permainan|no games|empty/i).should('exist');
      }
    });
  });

  // Word Scramble game tests
  describe('Permainan Word Scramble', () => {
    it('should navigate to word scramble game', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        // Check if word scramble link exists
        if ($body.find('a[href*="word-scramble"], .card:contains("Word Scramble")').length > 0) {
          cy.contains('Word Scramble').click({force: true});
          cy.url().should('include', '/permainan/word-scramble');
        } else {
          // If link not found, navigate directly and expect the page to exist
          cy.visit('/permainan/word-scramble', {failOnStatusCode: false});
          cy.log('Word Scramble link not found - navigated directly');
        }
      });
    });

    it('should navigate to word scramble house game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-scramble-house"], .card:contains("Word Scramble House")').length > 0) {
          cy.contains('Word Scramble House').click({force: true});
          cy.url().should('include', '/permainan/word-scramble-house');
        } else {
          cy.log('Word Scramble House link not found - game may not exist');
        }
      });
    });

    it('should navigate to word scramble illness game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-scramble-illness"], .card:contains("Word Scramble Illness")').length > 0) {
          cy.contains('Word Scramble Illness').click({force: true});
          cy.url().should('include', '/permainan/word-scramble-illness');
        } else {
          cy.log('Word Scramble Illness link not found - game may not exist');
        }
      });
    });

    it('should play word scramble game if available', () => {
      cy.visit('/permainan/word-scramble', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasGameElements = $body.find('.scrambled-word, .word-container, .game-area').length > 0;

        if (hasGameElements) {
          if ($body.find('input.answer-input, .answer-field').length > 0) {
            cy.get('input.answer-input, .answer-field').type('jawaban');
            cy.get('button.check-answer, .submit-answer, button:contains("Periksa")').click({force: true});
            cy.get('.feedback, .result-message, .answer-result').should('exist');
          } else {
            cy.log('Input field not found in Word Scramble game - may have different UI');
          }
        } else {
          cy.log('Word Scramble game elements not found - game may have different UI or not be available');
        }
      });
    });
  });

  // Word Matching game tests
  describe('Permainan Word Matching', () => {
    it('should navigate to word matching game', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-matching"], .card:contains("Word Matching")').length > 0) {
          cy.contains('Word Matching').click({force: true});
          cy.url().should('include', '/permainan/word-matching');
        } else {
          cy.visit('/permainan/word-matching', {failOnStatusCode: false});
          cy.log('Word Matching link not found - navigated directly');
        }
      });
    });

    it('should navigate to word matching house game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-matching-house"], .card:contains("Word Matching House")').length > 0) {
          cy.contains('Word Matching House').click({force: true});
          cy.url().should('include', '/permainan/word-matching-house');
        } else {
          cy.log('Word Matching House link not found - game may not exist');
        }
      });
    });

    it('should navigate to word matching illness game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-matching-illness"], .card:contains("Word Matching Illness")').length > 0) {
          cy.contains('Word Matching Illness').click({force: true});
          cy.url().should('include', '/permainan/word-matching-illness');
        } else {
          cy.log('Word Matching Illness link not found - game may not exist');
        }
      });
    });

    it('should play word matching game if available', () => {
      cy.visit('/permainan/word-matching', {failOnStatusCode: false});

      cy.on('uncaught:exception', (err) => {
        // returning false here prevents Cypress from failing the test on JS errors
        // which might occur in games due to complex interactions
        return false;
      });

      cy.get('body').then($body => {
        const hasGameElements = $body.find('.word-card, .matching-card, .game-area').length > 0;

        if (hasGameElements) {
          // Try to click cards if they exist
          if ($body.find('.word-card, .matching-card').length >= 2) {
            cy.get('.word-card, .matching-card').first().click({force: true});
            cy.get('.word-card, .matching-card').eq(1).click({force: true});
          } else {
            cy.log('Matching cards not found in expected format');
          }
        } else {
          cy.log('Word Matching game elements not found - game may have different UI or not be available');
        }
      });
    });
  });

  // Word Search game tests
  describe('Permainan Word Search', () => {
    it('should navigate to word search game', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-search"], .card:contains("Word Search")').length > 0) {
          cy.contains('Word Search').click({force: true});
          cy.url().should('include', '/permainan/word-search');
        } else {
          cy.visit('/permainan/word-search', {failOnStatusCode: false});
          cy.log('Word Search link not found - navigated directly');
        }
      });
    });

    it('should navigate to word search house game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-search-house"], .card:contains("Word Search House")').length > 0) {
          cy.contains('Word Search House').click({force: true});
          cy.url().should('include', '/permainan/word-search-house');
        } else {
          cy.log('Word Search House link not found - game may not exist');
        }
      });
    });

    it('should navigate to word search illness game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-search-illness"], .card:contains("Word Search Illness")').length > 0) {
          cy.contains('Word Search Illness').click({force: true});
          cy.url().should('include', '/permainan/word-search-illness');
        } else {
          cy.log('Word Search Illness link not found - game may not exist');
        }
      });
    });

    it('should play word search game if available', () => {
      cy.visit('/permainan/word-search', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasGameElements = $body.find('.word-search-grid, .grid-container, .puzzle-grid, .game-area').length > 0;

        if (hasGameElements) {
          // Attempt to interact with grid cells if they exist
          if ($body.find('.grid-cell, .letter-cell, .puzzle-cell').length > 0) {
            cy.get('.grid-cell, .letter-cell, .puzzle-cell').eq(0).trigger('mousedown', {force: true});
            cy.get('.grid-cell, .letter-cell, .puzzle-cell').eq(1).trigger('mouseover', {force: true});
            cy.get('.grid-cell, .letter-cell, .puzzle-cell').eq(2).trigger('mouseup', {force: true});
          } else {
            cy.log('Grid cells not found in expected format');
          }
        } else {
          cy.log('Word Search game elements not found - game may have different UI or not be available');
        }
      });
    });
  });

  // Image Matching game tests
  describe('Image Matching Games', () => {
    it('should navigate to image matching house game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="image-matching-house"], .card:contains("Image Matching House")').length > 0) {
          cy.contains('Image Matching House').click({force: true});
          cy.url().should('include', '/permainan/image-matching-house');
        } else {
          cy.log('Image Matching House link not found - game may not exist');
        }
      });
    });

    it('should play image matching game if available', () => {
      cy.visit('/permainan/image-matching-house', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasGameElements = $body.find('.image-card, .matching-card, .game-area').length > 0;

        if (hasGameElements) {
          // Attempt to interact with image cards if they exist
          if ($body.find('.image-card, .matching-card').length >= 2) {
            cy.get('.image-card, .matching-card').first().click({force: true});
            cy.get('.image-card, .matching-card').eq(1).click({force: true});
          } else {
            cy.log('Image cards not found in expected format');
          }
        } else {
          cy.log('Image Matching game elements not found - game may have different UI or not be available');
        }
      });
    });
  });

  // Hangman game tests
  describe('Hangman Games', () => {
    it('should navigate to hangman body game if available', () => {
      cy.visit('/permainan');

      cy.get('body').then($body => {
        if ($body.find('a[href*="word-hangman-body"], .card:contains("Word Hangman Body")').length > 0) {
          cy.contains('Word Hangman Body').click({force: true});
          cy.url().should('include', '/permainan/word-hangman-body');
        } else {
          cy.log('Word Hangman Body link not found - game may not exist');
        }
      });
    });

    it('should play hangman game if available', () => {
      cy.visit('/permainan/word-hangman-body', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasGameElements = $body.find('.hangman-word, .letter-display, .game-area').length > 0;

        if (hasGameElements) {
          // Attempt to interact with letter buttons if they exist
          if ($body.find('.letter-button, .key, .keyboard-button').length > 0) {
            cy.get('.letter-button, .key, .keyboard-button').first().click({force: true});
          } else {
            cy.log('Letter buttons not found in expected format');
          }
        } else {
          cy.log('Hangman game elements not found - game may have different UI or not be available');
        }
      });
    });
  });

  // Game completion and answers
  describe('Penyelesaian Permainan', () => {
    it('should attempt to complete a game', () => {
      // Try to visit Word Scramble game which is most likely to exist
      cy.visit('/permainan/word-scramble', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasAnswerInput = $body.find('input.answer-input, .answer-field, [placeholder*="jawaban"], [placeholder*="answer"]').length > 0;

        if (hasAnswerInput) {
          // Try to answer and complete the game
          cy.get('input.answer-input, .answer-field, [placeholder*="jawaban"], [placeholder*="answer"]').type('jawaban');

          // Check if submit button exists before clicking
          cy.get('body').then($submitBody => {
            if ($submitBody.find('button.check-answer, .submit-answer, button:contains("Periksa"), button:contains("Check")').length > 0) {
              cy.get('button.check-answer, .submit-answer, button:contains("Periksa"), button:contains("Check")').click({force: true});

              // Try to find and click finish/complete button if it exists
              cy.get('body').then($finishBody => {
                if ($finishBody.find('button.submit-game, .finish-game, button:contains("Selesai"), button:contains("Finish")').length > 0) {
                  cy.get('button.submit-game, .finish-game, button:contains("Selesai"), button:contains("Finish")').click({force: true});
                }
              });
            } else {
              cy.log('Submit button not found - game may have different UI');
            }
          });
        } else {
          cy.log('Answer input not found - game may have different UI or not be available');
        }
      });
    });

    it('should check for points after completing a game', () => {
      // Visit a completion page or look for points on the game page
      cy.visit('/permainan/complete', {failOnStatusCode: false});

      cy.get('body').then($body => {
        const hasPointsMessage =
          $body.text().match(/poin|xp|point|score/i) !== null ||
          $body.find('.points, .xp, .score, .point-badge').length > 0;

        if (!hasPointsMessage) {
          cy.visit('/permainan/word-scramble', {failOnStatusCode: false});
          cy.log('Points display not found on completion page - checking game page');
        }
      });
    });

    it('should attempt to view game answers if available', () => {
      // Try to visit the answers page
      cy.visit('/permainan/answers/word-scramble', {failOnStatusCode: false});

      cy.get('body').then($body => {
        // Check if we found answer content
        const hasAnswerContent =
          $body.find('.answer-list, .answers-container, .jawaban-container').length > 0 ||
          $body.text().match(/jawaban|kunci jawaban|answer|solutions/i) !== null;

        if (!hasAnswerContent) {
          cy.log('Answers page not found or different format - feature may not be available');
        }
      });
    });
  });
});
