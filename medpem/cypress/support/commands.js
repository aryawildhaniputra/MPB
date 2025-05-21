// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************

// Login command with wait for redirection
Cypress.Commands.add('login', (username = 'user', password = '123') => {
  cy.visit('/login');
  cy.intercept('POST', '/login').as('loginRequest');

  cy.get('input[name="username"]').type(username);
  cy.get('input[name="password"]').type(password);
  cy.get('button[type="submit"], .login-button, button#login-button').click();

  // Wait for login request to complete
  cy.wait('@loginRequest');

  // Check for redirect to dashboard
  cy.url().should('include', '/dashboard');
});

// Standard user login command
Cypress.Commands.add('loginAsUser', () => {
  cy.login('user', '123');
});

// Admin login command
Cypress.Commands.add('loginAsAdmin', () => {
  cy.login('admin', 'admin123');
});

// Superadmin login command
Cypress.Commands.add('loginAsSuperadmin', () => {
  cy.login('superadmin', 'super123');
});

// Simple file upload command
Cypress.Commands.add('uploadFile', { prevSubject: 'element' }, (subject, fileName, fileType = '') => {
  cy.wrap(subject).then(subject => {
    cy.fixture(fileName, 'base64')
      .then(Cypress.Blob.base64StringToBlob)
      .then(blob => {
        const el = subject[0];
        const testFile = new File([blob], fileName, { type: fileType });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(testFile);
        el.files = dataTransfer.files;
        return cy.wrap(subject).trigger('change', { force: true });
      });
  });
});

// Navigate to a specific menu after login
Cypress.Commands.add('navigateTo', (menu) => {
  // Make sure we're logged in by checking for dashboard elements
  cy.url().should('include', '/dashboard');

  // Navigate to the specified menu
  switch(menu) {
    case 'dashboard':
      cy.visit('/dashboard');
      break;
    case 'belajar':
      cy.visit('/belajar');
      break;
    case 'materi':
      cy.visit('/user/materi');
      break;
    case 'permainan':
      cy.visit('/permainan');
      break;
    case 'leaderboard':
    case 'skor':
      cy.visit('/skor');
      break;
    case 'profile':
      cy.visit('/profile');
      break;
    default:
      throw new Error(`Menu "${menu}" is not supported`);
  }
});

// Command to check if an element exists
Cypress.Commands.add('elementExists', (selector) => {
  cy.get('body').then($body => {
    return $body.find(selector).length > 0;
  });
});

// Command to open user profile dropdown
Cypress.Commands.add('openProfileDropdown', () => {
  cy.get('#userAvatarControl, .user-avatar').click({force: true});
  cy.get('#userDropdownDiv, .dropdown-menu').should('be.visible');
});

// Command to logout
Cypress.Commands.add('logout', () => {
  cy.openProfileDropdown();
  cy.contains(/keluar|logout|sign out/i).click({force: true});

  // Handle confirmation dialog if it exists
  cy.get('body').then($body => {
    if ($body.find('#logoutModal, .logout-modal, .modal-logout').length > 0) {
      cy.get('#logoutModal button[type="submit"], .logout-button, .confirm-logout')
        .contains(/keluar|logout|yes/i)
        .click({force: true});
    }
  });

  // Verify redirect to login page
  cy.url().should('include', '/login');
});
