describe('User Profile', () => {
  beforeEach(() => {
    // Use the custom login command
    cy.loginAsUser();
    cy.visit('/dashboard');
  });

  it('should access profile from header dropdown', () => {
    // Click on the user avatar in the header
    cy.get('#userAvatarControl, .user-avatar').click({force: true});

    // Click on the profile option in the dropdown
    cy.get('#userDropdownDiv, .dropdown-menu').should('be.visible');
    cy.contains(/profil saya|profile|my profile/i).click({force: true});

    // Verify we're on the profile page
    cy.url().should('include', '/profile');
  });

  it('should display user profile information', () => {
    cy.visit('/profile');

    // Verify profile page elements are visible
    cy.contains(/profil saya|profile|my profile/i).should('exist');

    // Verify profile sections are present
    cy.get('.profile-card, .profile-container').should('exist');
    cy.get('.profile-header, .profile-top').should('exist');

    // Check user info is displayed
    cy.get('.profile-name, .user-name').should('exist');
    cy.get('.profile-username, .username').should('contain', 'user');

    // Check profile stats
    cy.get('.profile-stats, .stats-container, .user-stats').should('exist');
  });

  it('should show user points and learning progress', () => {
    cy.visit('/profile');

    // Check for points/stats display
    cy.contains(/poin|point|xp|score/i).should('exist');

    // Check for progress section
    cy.get('body').then($body => {
      if ($body.find('.progress-items, .learning-progress, .progress-section').length > 0) {
        cy.get('.progress-items, .learning-progress, .progress-section').should('exist');
      } else {
        // If no progress items found, check for empty state message
        cy.contains(/belum ada progress|no progress|no lessons/i).should('exist');
      }
    });
  });

  it('should display account information section', () => {
    cy.visit('/profile');

    // Check for account info section
    cy.contains(/informasi akun|account information|personal info/i).should('exist');

    // Verify account info fields are present
    cy.contains(/nama lengkap|full name|name/i).should('exist');
    cy.contains(/username/i).should('exist');
    cy.contains(/peran|role/i).should('exist');
    cy.contains(/tanggal bergabung|join date|member since/i).should('exist');
  });

  it('should show achievements if available', () => {
    cy.visit('/profile');

    // Check for achievements section
    cy.get('body').then($body => {
      if ($body.find('.achievements-grid, .achievements-container, .achievement-item').length > 0) {
        cy.get('.achievements-grid, .achievements-container, .achievement-item').should('exist');

        // Check for achievement items
        cy.get('.achievement-item, .achievement-card').should('have.length.at.least', 1);
      } else {
        // If no achievements section, log it but don't fail the test
        cy.log('No achievements section found in profile');
      }
    });
  });
});
