describe('User Navigation', () => {
  beforeEach(() => {
    // Use the custom login command
    cy.loginAsUser();
  });

  it('should access all main navigation pages', () => {
    // Visit dashboard
    cy.visit('/dashboard');
    cy.url().should('include', '/dashboard');
    cy.contains(/dashboard|menu utama|beranda/i).should('exist');

    // Visit belajar page
    cy.visit('/belajar');
    cy.url().should('include', '/belajar');
    cy.contains(/belajar|pelajaran|lesson/i).should('exist');

    // Visit materi page - might be at different paths
    cy.visit('/user/materi');
    // Just check the page loaded and contains the expected content
    cy.contains(/materi|material/i).should('exist');

    // Visit permainan page
    cy.visit('/permainan');
    cy.url().should('include', '/permainan');
    cy.contains(/permainan|game/i).should('exist');

    // Visit leaderboard/skor page
    cy.visit('/skor');
    cy.url().should('include', '/skor');
    cy.contains(/skor|peringkat|leaderboard/i).should('exist');

    // Visit profile page
    cy.visit('/profile');
    cy.url().should('include', '/profile');
    cy.contains(/profil|profile/i).should('exist');
  });

  it('should navigate using sidebar menu', () => {
    cy.visit('/dashboard');

    // Verify sidebar exists
    cy.get('.duolingo-sidebar, .sidebar, #sidebar').should('exist');

    // Click on Belajar in sidebar and simply check we navigated away
    cy.contains(/belajar singkat|belajar|learn/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    // Click on Materi in sidebar and simply check we navigated away
    cy.contains(/materi belajar|materi|material/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    // Click on Permainan in sidebar and simply check we navigated away
    cy.contains(/permainan|game/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
    cy.go('back');

    // Click on Leaderboard in sidebar and simply check we navigated away
    cy.contains(/papan peringkat|skor|leaderboard/i).click({force: true});
    cy.url().should('not.include', '/dashboard');
  });

  it('should navigate to profile through header dropdown', () => {
    cy.visit('/dashboard');

    // Click on the user avatar in header
    cy.get('#userAvatarControl, .user-avatar').click({force: true});

    // Click on profile option in dropdown
    cy.get('#userDropdownDiv, .dropdown-menu').should('be.visible');
    cy.contains(/profil saya|profile|my profile/i).click({force: true});

    // Verify we're on profile page
    cy.url().should('include', '/profile');
  });

  it('should handle logout flow', () => {
    cy.visit('/dashboard');

    // Click on the user avatar in header
    cy.get('#userAvatarControl, .user-avatar').click({force: true});

    // Click on logout option in dropdown
    cy.get('#userDropdownDiv, .dropdown-menu').should('be.visible');
    cy.contains(/keluar|logout|sign out/i).click({force: true});

    // Check for confirmation modal if it exists
    cy.get('body').then($body => {
      if ($body.find('#logoutModal, .logout-modal, .modal-logout').length > 0) {
        // Click confirm logout button
        cy.get('#logoutModal button[type="submit"], .logout-button, .confirm-logout')
          .contains(/keluar|logout|yes/i)
          .click({force: true});
      }
    });

    // Verify we're redirected to login page or home page (both are valid behaviors)
    cy.url().should('satisfy', (url) => {
      return url.includes('/login') || url === '/' || url.endsWith('/');
    });

    // Check that we're logged out by looking for login indicators
    cy.get('body').then($body => {
      // Either we find a login form or a login link, both indicate logged out state
      const isLoggedOut =
        $body.find('input[name="username"], input[name="password"], a[href*="login"]').length > 0 ||
        $body.text().match(/login|masuk|sign in/i) !== null;

      expect(isLoggedOut).to.be.true;
    });
  });
});
