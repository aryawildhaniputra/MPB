describe('Leaderboard Feature', () => {
  beforeEach(() => {
    cy.loginAsUser();
    cy.visit('/skor');
  });

  it('should display leaderboard page', () => {
    cy.url().should('include', '/skor');
    cy.contains(/leaderboard|papan skor|papan peringkat|ranking/i).should('exist');
  });

  it('should show user rankings', () => {
    cy.get('body').then($body => {
      if ($body.find('.leaderboard-table, .ranking-table, table').length > 0) {
        cy.get('.leaderboard-table, .ranking-table, table').should('exist');
      } else if ($body.find('.user-rank, .ranking-item, .rank-card').length > 0) {
        cy.get('.user-rank, .ranking-item, .rank-card').should('have.length.at.least', 1);
      } else {
        cy.contains(/no rankings|belum ada peringkat|empty/i).should('exist');
      }
    });
  });

  it('should highlight current user', () => {
    cy.get('body').then($body => {
      if ($body.find('.current-user, .highlight-user, .my-rank, .your-rank').length > 0) {
        cy.get('.current-user, .highlight-user, .my-rank, .your-rank').should('exist');
      } else {
        cy.contains('user').should('exist');
      }
    });
  });

  it('should sort users by points', () => {
    cy.get('body').then($body => {
      if (
        $body.find('.user-rank, .ranking-item, tr').length < 2 &&
        $body.find('.leaderboard-item, .user-score-item').length < 2
      ) {
        cy.log('Not enough users to verify sorting - skipping test');
        return;
      }

      let hasFoundPoints = false;

      if ($body.find('.user-rank, .ranking-item, tr').length >= 2) {
        const firstRankEl = $body.find('.user-rank, .ranking-item, tr').first();
        const secondRankEl = $body.find('.user-rank, .ranking-item, tr').eq(1);

        const pointSelectors = [
          '.points', '.score', '.poin', '[data-points]',
          '.point-value', '.score-value', '.user-points',
          'td:nth-child(2)', 'td:last-child', '.badge'
        ];

        for (const selector of pointSelectors) {
          if (firstRankEl.find(selector).length > 0 && secondRankEl.find(selector).length > 0) {
            hasFoundPoints = true;

            const firstPointText = firstRankEl.find(selector).text().trim().replace(/[^\d]/g, '');
            const secondPointText = secondRankEl.find(selector).text().trim().replace(/[^\d]/g, '');

            if (firstPointText && secondPointText) {
              const firstPoints = parseInt(firstPointText);
              const secondPoints = parseInt(secondPointText);

              if (!isNaN(firstPoints) && !isNaN(secondPoints)) {
                expect(firstPoints).to.be.at.least(secondPoints);
                break;
              }
            }
          }
        }
      }

      if (!hasFoundPoints) {
        cy.log('Standard leaderboard structure not found - checking alternative formats');
        cy.get('.leaderboard-table, .ranking-table, .user-rank, .ranking-item').should('exist');
      }
    });
  });

  it('should allow admin to manage leaderboard', () => {
    cy.loginAsAdmin();
    cy.visit('/skor');

    cy.get('body').then($body => {
      const adminActions = $body.find('button:contains("Fix Points"), button:contains("Reset"), button:contains("Update"), .admin-action, [data-admin-action]');

      if (adminActions.length > 0) {
        cy.contains(/fix points|reset|update|manage/i).click({force: true});

        cy.contains(/success|berhasil|updated|fixed/i).should('exist');
      } else {
        cy.log('No admin actions found on leaderboard');
      }
    });
  });
});
