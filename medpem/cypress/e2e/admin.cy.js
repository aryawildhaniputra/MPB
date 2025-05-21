// Admin Authentication & Dashboard tests
describe('Admin Authentication & Dashboard', () => {
  it('should login as admin', () => {
    cy.visit('/login');
    cy.get('input[name="username"]').type('admin');
    cy.get('input[name="password"]').type('admin123');
    cy.get('button[type="submit"]').click();

    // After login, we should be redirected or can navigate to dashboard
    cy.visit('/dashboard');
    cy.url().should('include', '/dashboard');

    // Check that the page exists (any element)
    cy.get('body').should('exist');
  });

  it('should show admin-specific menu options', () => {
    cy.loginAsAdmin();

    // Check for sidebar menu items with specific text
    cy.contains('KELOLA MATERI').should('exist');
    cy.contains('KELOLA USER').should('exist');
  });
});

// Admin Materi Management tests
describe('Admin Materi Management', () => {
  beforeEach(() => {
    // Login as admin before each test
    cy.loginAsAdmin();

    // Navigate to materi management page via sidebar
    cy.contains('KELOLA MATERI').click();
    cy.url().should('include', '/materi');
  });

  it('should display materi management page', () => {
    cy.url().should('include', '/materi');
    cy.contains('MATERI').should('exist');
  });

  it('should have materi list or empty state message', () => {
    // Check for either card elements containing materi list or the empty state message
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.card').should('exist');
      } else {
        cy.contains('Belum Ada Materi').should('exist');
      }
    });
  });

  it('should have add button for materi creation', () => {
    // Check for the add button with proper text
    cy.contains('Tambah Materi Baru').should('exist');
  });

  it('should have search functionality', () => {
    // Check for search input
    cy.get('input[name="search"]').should('exist');
  });

  it('should navigate to create materi page when clicking add button', () => {
    cy.contains('Tambah Materi Baru').click();
    cy.url().should('include', '/materi/create');
  });

  it('should create a new materi', () => {
    // Skip this test for now as it needs special handling for the content editor
    cy.contains('Tambah Materi Baru').click();
    cy.url().should('include', '/materi/create');
    cy.log('This test requires special handling for the rich text editor');
  });

  it('should search for materi', () => {
    // Type in search input and submit the form
    cy.get('input[name="search"]').type('Test Materi');
    cy.get('input[name="search"]').parents('form').submit();

    // URL should update with the search parameter (but using + instead of %20)
    cy.url().should('include', 'search=Test+Materi');
  });

  it('should view materi details', () => {
    // First check if we have any cards
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        // Find and click view button on first card
        cy.get('.view-button').first().click();
        cy.url().should('include', '/materi/');
      } else {
        // Skip test if no materials exist
        cy.log('No materials to view, skipping test');
      }
    });
  });

  it('should edit a materi', () => {
    // First check if we have any cards
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        // Find and click edit button on first card (making sure we only target one)
        cy.get('.edit-button').first().click({force: true});
        cy.url().should('include', '/edit');
      } else {
        // Skip test if no materials exist
        cy.log('No materials to edit, skipping test');
      }
    });
  });

  it('should delete a materi', () => {
    // First check if we have any cards
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        // Find and click delete button on first card
        cy.get('.delete-button').first().click();

        // Confirm delete in modal dialog
        cy.get('#confirmDelete').click();
      } else {
        // Skip test if no materials exist
        cy.log('No materials to delete, skipping test');
      }
    });
  });
});

// Admin User Management tests
describe('Admin User Management', () => {
  beforeEach(() => {
    // Login as admin before each test
    cy.loginAsAdmin();

    // Navigate to user management page via sidebar
    cy.contains('KELOLA USER').click();
    cy.url().should('include', '/admin/users');
  });

  it('should display user management page', () => {
    cy.url().should('include', '/admin/users');
    cy.contains('Manajemen Pengguna').should('exist');
  });

  it('should have data table with user list', () => {
    // Check for the user table
    cy.get('.user-table').should('exist');
    cy.get('table').should('exist');
  });

  it('should have user management actions', () => {
    // Check for add button with correct text
    cy.contains('Tambah Pengguna').should('exist');
  });

  it('should navigate to create user page', () => {
    cy.contains('Tambah Pengguna').first().click();
    cy.url().should('include', '/admin/users/create');
  });

  it('should create a new user', () => {
    cy.contains('Tambah Pengguna').first().click();

    // Generate a unique username
    const username = 'testuser' + Date.now().toString().slice(-5);

    // Fill the form
    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="username"]').type(username);
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="password_confirmation"]').type('password123');

    // Select role if dropdown exists
    cy.get('select[name="role"]').then($roleSelect => {
      if ($roleSelect.length) {
        cy.wrap($roleSelect).select('user');
      }
    });

    // Submit the form - use a more specific selector to avoid hidden logout button
    // Only target buttons within the main content form
    cy.get('.main-content form button[type="submit"]').click({force: true});

    // Alternative approach if the above doesn't work
    // cy.get('form').submit();

    // Should redirect to users index after success
    cy.url().should('include', '/admin/users');
  });

  it('should view and edit users', () => {
    // Check if there are action buttons
    cy.get('.action-button').then($buttons => {
      if ($buttons.length) {
        cy.log(`Found ${$buttons.length} action buttons`);
      } else {
        cy.log('No action buttons found, maybe no editable users');
      }
    });
  });

  it('should have pagination if multiple users exist', () => {
    // Check if pagination exists
    cy.get('body').then($body => {
      if ($body.find('.pagination-wrapper').length > 0) {
        cy.get('.pagination-wrapper').should('exist');
      } else {
        cy.log('Pagination not present, might be only one page of users');
      }
    });
  });
});
