describe('Dashboard', () => {
  beforeEach(() => {
    cy.loginAsUser();
    cy.visit('/dashboard');
  });

  it('should display dashboard page', () => {
    cy.url().should('include', '/dashboard');

    cy.contains(/dashboard|menu utama|halaman utama/i).should('exist');
  });

  it('should show user information', () => {
    cy.get('body').then($body => {
      if ($body.find('.user-info, .welcome-section, .profile-info').length > 0) {
        cy.get('.user-info, .welcome-section, .profile-info').should('exist');
      } else {
        cy.contains(/welcome|selamat datang|hai|hello/i).should('exist');
      }
    });

    cy.contains(/poin|point|xp|skor|score/i).should('exist');
  });

  it('should display menu navigation options', () => {
    cy.contains(/belajar|learn/i).should('exist');
    cy.contains(/permainan|game/i).should('exist');
    cy.contains(/skor|leaderboard|peringkat/i).should('exist');
    cy.contains(/materi|material/i).should('exist');
  });

  it('should navigate to other main menus from dashboard', () => {
    cy.contains(/belajar|learn/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    cy.contains(/permainan|game/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    cy.contains(/skor|leaderboard|peringkat/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    cy.get('body').then($body => {
      if ($body.find('a:contains("Materi"), a[href*="materi"]').length > 0) {
        cy.contains(/materi|material/i).click({force: true});
        cy.url().should('not.include', '/dashboard');
      }
    });
  });

  it('should show user profile in header', () => {
    cy.get('.user-avatar, .profile-dropdown, .user-dropdown').should('exist');

    cy.get('header, .duolingo-header, .app-header').contains('user').should('exist');
  });
});
