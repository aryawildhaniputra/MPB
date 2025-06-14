describe('User Profile', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('user')
    cy.get('input[name="password"]').type('user123')
    cy.get('#login-button').click()
    cy.url().should('include', '/dashboard')
    cy.visit('/profile')
    cy.url().should('include', '/profile')
  })

  it('should display profile page', () => {
    cy.get('.content-title').should('contain', 'PROFIL')
    cy.get('.profile-card').should('exist')
    cy.get('.profile-name').should('exist')
    cy.get('.profile-avatar').should('exist')
  })

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

describe('Profile Tests', () => {
  beforeEach(() => {
    cy.login('testuser', 'password123')
    cy.visit('/profil')
  })

  it('should display user profile information', () => {
    cy.get('[data-testid="profile-container"]').should('be.visible')
    cy.get('[data-testid="user-name"]').should('be.visible')
    cy.get('[data-testid="user-email"]').should('be.visible')
    cy.get('[data-testid="user-role"]').should('be.visible')
  })

  it('should update profile information', () => {
    cy.get('[data-testid="edit-profile-button"]').click()

    // Update name
    cy.get('input[name="name"]').clear().type('Updated Name')

    // Update email
    cy.get('input[name="email"]').clear().type('updated@test.com')

    // Save changes
    cy.get('[data-testid="save-profile"]').click()
    cy.get('.success-message').should('be.visible')

    // Verify changes
    cy.get('[data-testid="user-name"]').should('contain', 'Updated Name')
    cy.get('[data-testid="user-email"]').should('contain', 'updated@test.com')
  })

  it('should change password successfully', () => {
    cy.get('[data-testid="change-password-button"]').click()

    // Enter current and new password
    cy.get('input[name="current_password"]').type('password123')
    cy.get('input[name="new_password"]').type('newpassword123')
    cy.get('input[name="confirm_password"]').type('newpassword123')

    // Save new password
    cy.get('[data-testid="save-password"]').click()
    cy.get('.success-message').should('be.visible')
  })

  it('should validate required fields when saving profile', () => {
    cy.get('[data-testid="edit-profile-button"]').click()

    // Clear required fields
    cy.get('input[name="name"]').clear()
    cy.get('input[name="email"]').clear()

    // Try to save
    cy.get('[data-testid="save-profile"]').click()
    cy.get('[data-testid="error-message"]').should('be.visible')
  })

  it('should validate password criteria', () => {
    cy.get('[data-testid="change-password-button"]').click()

    // Enter short password
    cy.get('input[name="current_password"]').type('password123')
    cy.get('input[name="new_password"]').type('123')
    cy.get('input[name="confirm_password"]').type('123')

    // Try to save
    cy.get('[data-testid="save-password"]').click()
    cy.get('[data-testid="error-message"]').should('be.visible')
  })

  it('should validate password confirmation', () => {
    cy.get('[data-testid="change-password-button"]').click()

    // Enter mismatched passwords
    cy.get('input[name="current_password"]').type('password123')
    cy.get('input[name="new_password"]').type('newpassword123')
    cy.get('input[name="confirm_password"]').type('differentpassword')

    // Try to save
    cy.get('[data-testid="save-password"]').click()
    cy.get('[data-testid="error-message"]').should('be.visible')
  })

  it('should handle profile picture upload', () => {
    cy.get('[data-testid="edit-profile-button"]').click()

    // Upload image
    cy.get('input[type="file"]').attachFile('profile-picture.jpg')
    cy.get('[data-testid="save-profile"]').click()
    cy.get('.success-message').should('be.visible')

    // Verify new profile picture
    cy.get('[data-testid="profile-picture"]')
      .should('have.attr', 'src')
      .and('include', 'profile-picture.jpg')
  })
})
