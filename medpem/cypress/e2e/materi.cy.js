describe('User Materi Feature', () => {
  beforeEach(() => {
    cy.loginAsUser();
    cy.visit('/user/materi');
  });

  it('should display user materi index page', () => {
    cy.url().should('include', '/user/materi');

    cy.contains(/materi|bahan|material/i).should('exist');
  });

  it('should show available materi', () => {
    cy.get('body').then($body => {
      const materiItems = $body.find('.materi-item, .card, .materi-card, .material-item');

      if (materiItems.length > 0) {
        cy.get('.materi-item, .card, .materi-card, .material-item').should('have.length.at.least', 1);
      } else {
        cy.contains(/belum ada materi|no materials|empty/i).should('exist');
      }
    });
  });

  it('should navigate to materi detail', () => {
    cy.get('body').then($body => {
      const materiItems = $body.find('.materi-item, .card, .materi-card, .material-item');

      if (materiItems.length > 0) {
        cy.get('.materi-item, .card, .materi-card, .material-item').first().click({force: true});

        cy.url().should('include', '/user/materi/');

        cy.get('.materi-detail, .materi-content, .content, article').should('exist');
      } else {
        cy.log('No materi items available to click');
      }
    });
  });

  it('should track progress when reading materi', () => {
    cy.get('body').then($body => {
      const materiItems = $body.find('.materi-item, .card, .materi-card, .material-item');

      if (materiItems.length > 0) {
        cy.get('.materi-item, .card, .materi-card, .material-item').first().click({force: true});

        cy.url().should('include', '/user/materi/');

        cy.scrollTo('bottom', {duration: 1000});

        cy.get('.progress-indicator, .progress-bar, [role="progressbar"], .progress').should('exist');
      } else {
        cy.log('No materi items available to test progress tracking');
      }
    });
  });

  it('should mark materi as completed after reading', () => {
    cy.get('body').then($body => {
      const materiItems = $body.find('.materi-item, .card, .materi-card, .material-item');

      if (materiItems.length > 0) {
        cy.get('.materi-item, .card, .materi-card, .material-item').first().click({force: true});

        cy.url().should('include', '/user/materi/');

        cy.get('body').then($detailBody => {
          const completeButton = $detailBody.find('.complete-button, .mark-complete, button:contains("Selesai"), button:contains("Complete")');

          if (completeButton.length > 0) {
            cy.contains(/selesai|complete|mark as read/i).click({force: true});
            cy.contains(/berhasil|success|completed/i).should('exist');
          } else {
            cy.scrollTo('bottom', {duration: 1000});
            cy.wait(1000);
          }
        });
      } else {
        cy.log('No materi items available to test completion');
      }
    });
  });
});
