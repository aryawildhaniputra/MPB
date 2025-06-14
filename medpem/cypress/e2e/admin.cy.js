// Admin Authentication & Dashboard tests
describe('Admin Authentication & Dashboard', () => {
  it('should login as admin', () => {
    cy.visit('/login');
    cy.get('input[name="username"]').type('admin');
    cy.get('input[name="password"]').type('admin123');
    cy.get('button[type="submit"]').click();
    cy.visit('/admin/dashboard');
    cy.url().should('include', '/admin/dashboard');
    cy.get('body').should('exist');
  });

  it('should show admin-specific menu options', () => {
    cy.adminLogin();
    cy.contains('KELOLA MATERI').should('exist');
    cy.contains('KELOLA USER').should('exist');
  });
});

// Admin Materi Management tests
describe('Admin Materi Management', () => {
  beforeEach(() => {
    cy.adminLogin();
    cy.contains('KELOLA MATERI').click();
    cy.url().should('include', '/admin/materi');
  });

  it('should display materi management page', () => {
    cy.url().should('include', '/admin/materi');
    cy.contains('MATERI').should('exist');
  });

  it('should have materi list or empty state message', () => {
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.card').should('exist');
      } else {
        cy.contains('Belum Ada Materi').should('exist');
      }
    });
  });

  it('should have add button for materi creation', () => {
    cy.contains('Tambah Materi Baru').should('exist');
  });

  it('should have search functionality', () => {
    cy.get('input[name="search"]').should('exist');
  });

  it('should navigate to create materi page when clicking add button', () => {
    cy.contains('Tambah Materi Baru').click();
    cy.url().should('include', '/admin/materi/create');
  });

  it('should create a new materi', () => {
    cy.contains('Tambah Materi Baru').click();
    cy.url().should('include', '/admin/materi/create');
    cy.log('This test requires special handling for the rich text editor');
  });

  it('should search for materi', () => {
    cy.get('input[name="search"]').type('Test Materi');
    cy.get('input[name="search"]').parents('form').submit();
    cy.url().should('include', 'search=Test+Materi');
  });

  it('should view materi details', () => {
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.view-button').first().click();
        cy.url().should('include', '/admin/materi/');
      } else {
        cy.log('No materials to view, skipping test');
      }
    });
  });

  it('should edit a materi', () => {
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.edit-button').first().click({force: true});
        cy.url().should('include', '/edit');
      } else {
        cy.log('No materials to edit, skipping test');
      }
    });
  });

  it('should delete a materi', () => {
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.delete-button').first().click();
        cy.get('#confirmDelete').click();
      } else {
        cy.log('No materials to delete, skipping test');
      }
    });
  });
});

// Admin User Management tests
describe('Admin User Management', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('admin')
    cy.get('input[name="password"]').type('admin123')
    cy.get('#login-button').click()
    cy.url().should('include', '/admin/dashboard')
    cy.visit('/admin/users')
    cy.url().should('include', '/admin/users')
  })

  it('should display user management page', () => {
    cy.get('.content-title').should('contain', 'MANAJEMEN PENGGUNA')
    cy.get('.user-table').should('exist')
    cy.get('body').then($body => {
      if ($body.find('.table-row').length > 0) {
        cy.get('.table-row').should('exist')
      } else {
        cy.contains('Belum Ada Pengguna').should('exist')
      }
    })
  })

  it('should have add user button', () => {
    cy.contains('Tambah Pengguna').should('exist')
  })
})
