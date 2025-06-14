// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************

// Environment configuration
const config = {
  baseUrl: 'https://mpb.oopedia.com',
  testUsers: {
    student: {
      username: 'user',
      password: 'user123'
    },
    admin: {
      username: 'admin',
      password: 'admin123'
    },
    superadmin: {
      username: 'superadmin',
      password: '12345'
    }
  }
}

// Custom command for student login
Cypress.Commands.add('login', (username = config.testUsers.student.username, password = config.testUsers.student.password) => {
  cy.visit('/login')
  cy.get('input[name="username"]').type(username)
  cy.get('input[name="password"]').type(password)
  cy.get('button[type="submit"]').click()
  cy.url().should('include', '/dashboard')
})

// Custom command for admin login
Cypress.Commands.add('adminLogin', (username = config.testUsers.admin.username, password = config.testUsers.admin.password) => {
  cy.visit('/login')
  cy.get('input[name="username"]').type(username)
  cy.get('input[name="password"]').type(password)
  cy.get('button[type="submit"]').click()
  cy.url().should('include', '/admin/dashboard')
})

// Custom command for superadmin login
Cypress.Commands.add('superadminLogin', (username = config.testUsers.superadmin.username, password = config.testUsers.superadmin.password) => {
  cy.visit('/login')
  cy.get('input[name="username"]').type(username)
  cy.get('input[name="password"]').type(password)
  cy.get('button[type="submit"]').click()
  cy.url().should('include', '/superadmin/dashboard')
})

// Custom command for user login
Cypress.Commands.add('loginAsUser', () => {
  cy.login(config.testUsers.student.username, config.testUsers.student.password);
});

// Custom command to check if element is visible and contains text
Cypress.Commands.add('shouldBeVisibleAndContain', (selector, text) => {
  cy.get(selector).should('be.visible').and('contain', text)
})

// Custom command to check if element is visible and has class
Cypress.Commands.add('shouldBeVisibleAndHaveClass', (selector, className) => {
  cy.get(selector).should('be.visible').and('have.class', className)
})

// Custom command to check if element is visible and has attribute
Cypress.Commands.add('shouldBeVisibleAndHaveAttr', (selector, attr, value) => {
  cy.get(selector).should('be.visible').and('have.attr', attr, value)
})

// Custom command to check if element is visible and has length
Cypress.Commands.add('shouldBeVisibleAndHaveLength', (selector, length) => {
  cy.get(selector).should('be.visible').and('have.length', length)
})

// Custom command to check if element is visible and has value
Cypress.Commands.add('shouldBeVisibleAndHaveValue', (selector, value) => {
  cy.get(selector).should('be.visible').and('have.value', value)
})

// Custom command to check if element is visible and has text
Cypress.Commands.add('shouldBeVisibleAndHaveText', (selector, text) => {
  cy.get(selector).should('be.visible').and('have.text', text)
})

// Custom command to check if element is visible and has placeholder
Cypress.Commands.add('shouldBeVisibleAndHavePlaceholder', (selector, placeholder) => {
  cy.get(selector).should('be.visible').and('have.attr', 'placeholder', placeholder)
})

// Custom command to check if element is visible and has type
Cypress.Commands.add('shouldBeVisibleAndHaveType', (selector, type) => {
  cy.get(selector).should('be.visible').and('have.attr', 'type', type)
})

// Custom command to check if element is visible and has name
Cypress.Commands.add('shouldBeVisibleAndHaveName', (selector, name) => {
  cy.get(selector).should('be.visible').and('have.attr', 'name', name)
})

// Custom command to check if element is visible and has id
Cypress.Commands.add('shouldBeVisibleAndHaveId', (selector, id) => {
  cy.get(selector).should('be.visible').and('have.attr', 'id', id)
})

// Custom command to check if element is visible and has data-testid
Cypress.Commands.add('shouldBeVisibleAndHaveTestId', (selector, testId) => {
  cy.get(selector).should('be.visible').and('have.attr', 'data-testid', testId)
})

// Custom command to check if element is visible and has role
Cypress.Commands.add('shouldBeVisibleAndHaveRole', (selector, role) => {
  cy.get(selector).should('be.visible').and('have.attr', 'role', role)
})

// Custom command to check if element is visible and has aria-label
Cypress.Commands.add('shouldBeVisibleAndHaveAriaLabel', (selector, label) => {
  cy.get(selector).should('be.visible').and('have.attr', 'aria-label', label)
})

// Custom command to check if element is visible and has aria-describedby
Cypress.Commands.add('shouldBeVisibleAndHaveAriaDescribedBy', (selector, describedBy) => {
  cy.get(selector).should('be.visible').and('have.attr', 'aria-describedby', describedBy)
})

// Custom command to check if element is visible and has aria-expanded
Cypress.Commands.add('shouldBeVisibleAndHaveAriaExpanded', (selector, expanded) => {
  cy.get(selector).should('be.visible').and('have.attr', 'aria-expanded', expanded)
})

// Custom command to check if element is visible and has aria-hidden
Cypress.Commands.add('shouldBeVisibleAndHaveAriaHidden', (selector, hidden) => {
  cy.get(selector).should('be.visible').and('have.attr', 'aria-hidden', hidden)
})

// Custom command to check if element is visible and has aria-selected
Cypress.Commands.add('shouldBeVisibleAndHaveAriaSelected', (selector, selected) => {
  cy.get(selector).should('be.visible').and('have.attr', 'aria-selected', selected)
})

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
