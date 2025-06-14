describe('Admin Navigation', () => {
  beforeEach(() => {
    cy.visit('/login')
    cy.get('input[name="username"]').type('admin')
    cy.get('input[name="password"]').type('admin123')
    cy.get('#login-button').click()
    cy.url().should('include', '/admin/dashboard')
  })

  it('should access all admin pages', () => {
    // Dashboard
    cy.get('.sidebar-item .sidebar-text').contains('MENU UTAMA').click()
    cy.url().should('include', '/admin/dashboard')
    cy.get('.sidebar-item.active .sidebar-text').should('contain', 'MENU UTAMA')

    // Kelola User
    cy.get('.sidebar-item .sidebar-text').contains('KELOLA USER').click()
    cy.url().should('include', '/admin/users')
    cy.get('.sidebar-item.active .sidebar-text').should('contain', 'KELOLA USER')

    // Kelola Materi
    cy.get('.sidebar-item .sidebar-text').contains('KELOLA MATERI').click()
    cy.url().should('include', '/admin/materi')
    cy.get('.sidebar-item.active .sidebar-text').should('contain', 'KELOLA MATERI')
    cy.get('.content-title').should('contain', 'MATERI')
    cy.get('body').then($body => {
      if ($body.find('.card').length > 0) {
        cy.get('.card').should('exist')
      } else {
        cy.contains('Belum Ada Materi').should('exist')
      }
    })
  })

  it('should navigate using admin sidebar menu', () => {
    cy.visit('/dashboard');

    // Verify sidebar exists
    cy.get('.duolingo-sidebar, .sidebar, #sidebar').should('exist');

    // Click on Kelola Materi in sidebar
    cy.contains(/kelola materi/i).click({force: true});
    cy.url().should('include', '/materi');

    // Click on Kelola User in sidebar
    cy.contains(/kelola user/i).click({force: true});
    cy.url().should('include', '/admin/users');

    // Admin should also see regular user menus
    cy.contains(/belajar singkat|belajar/i).click({force: true});
    cy.url().should('include', '/belajar');

    cy.contains(/permainan/i).click({force: true});
    cy.url().should('include', '/permainan');
  });

  it('should access profile through header dropdown', () => {
    cy.visit('/dashboard');

    // Click on the user avatar in header
    cy.get('#userAvatarControl, .user-avatar').click({force: true});

    // Click on profile option in dropdown
    cy.get('#userDropdownDiv, .dropdown-menu').should('be.visible');
    cy.contains(/profil saya|profile|my profile/i).click({force: true});

    // Verify we're on profile page
    cy.url().should('include', '/profile');
  });

  it('should have admin-specific elements', () => {
    // Check for admin indicator in profile
    cy.visit('/profile');
    cy.contains(/admin|administrator/i).should('exist');

    // Check for admin features in materi management
    cy.visit('/materi');
    cy.contains(/tambah materi|add material|create/i).should('exist');

    // Check for admin features in user management
    cy.visit('/admin/users');
    cy.contains(/tambah pengguna|add user|create/i).should('exist');
  });
});
