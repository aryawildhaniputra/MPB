describe('User Materi Feature', () => {
  beforeEach(() => {
    cy.loginAsUser();
    cy.visit('/user/materi');
  });

  it('should display user materi index page', () => {
    cy.url().should('include', '/user/materi');
    cy.contains('MATERI').should('exist');
    cy.contains('Mari belajar hal-hal seru dan menarik bersama!').should('exist');
  });

  it('should show available materi', () => {
    cy.get('.card').then($cards => {
      if ($cards.length > 0) {
        cy.get('.card').should('have.length.at.least', 1);
        cy.get('.card .view-button').should('exist');
      } else {
        cy.contains(/Belum Ada Materi|Materi Tidak Ditemukan|Belum ada materi pembelajaran yang tersedia/i).should('exist');
      }
    });
  });

  it('should open materi detail when clicking a materi', () => {
    cy.get('body').then($body => {
      const cards = $body.find('.card .view-button');
      if (cards.length > 0) {
        cy.get('.card .view-button').first().click({force: true});
        cy.url().should('match', /\/user\/materi\/[0-9]+/);
        cy.get('.content-title').should('exist');
        cy.get('.materi-content').should('exist');
      } else {
        cy.log('No materi items available to click');
      }
    });
  });

  it('should update progress when reading materi', () => {
    cy.get('body').then($body => {
      const cards = $body.find('.card .view-button');
      if (cards.length > 0) {
        cy.get('.card .view-button').first().click({force: true});
        cy.url().should('match', /\/user\/materi\/[0-9]+/);
        cy.get('.materi-content').should('exist');
        cy.scrollTo('bottom', {duration: 1000});
        cy.wait(500);
        cy.get('button#mark-completed, .btn-complete').should('exist');
        cy.get('button#mark-completed, .btn-complete').click({force: true});
        cy.get('#successNotification').should('be.visible');
      } else {
        cy.log('No materi items available to test progress');
      }
    });
  });

  it('should access supporting documents if available', () => {
    cy.get('body').then($body => {
      const cards = $body.find('.card .view-button');
      if (cards.length > 0) {
        cy.get('.card .view-button').first().click({force: true});
        cy.url().should('match', /\/user\/materi\/[0-9]+/);
        cy.get('.content-container').contains('Dokumen Pendukung').should('exist');
        cy.get('#documents-container').then($docs => {
          if ($docs.find('.document-embed').length > 0) {
            cy.get('.document-embed').first().within(() => {
              cy.get('.document-header').should('exist');
              cy.get('.document-title').should('exist');
              cy.get('.document-actions .document-view').should('exist');
              cy.get('.document-actions .document-download').should('exist');
            });
          } else {
            cy.get('#no-documents-message').should('exist');
          }
        });
      } else {
        cy.log('No materi items available to test document access');
      }
    });
  });
});
