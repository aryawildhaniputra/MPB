describe('Admin Navigation', () => {
  beforeEach(() => {
    // Use the custom login command
    cy.loginAsAdmin();
  });

  it('should access all admin pages', () => {
    // Visit dashboard
    cy.visit('/dashboard');
    cy.url().should('include', '/dashboard');
    cy.contains(/dashboard|menu utama|beranda/i).should('exist');

    // Visit admin materi page
    cy.visit('/materi');
    cy.url().should('include', '/materi');
    cy.contains(/materi|kelola materi/i).should('exist');

    // Visit user management page
    cy.visit('/admin/users');
    cy.url().should('include', '/admin/users');
    cy.contains(/manajemen pengguna|kelola user|user management/i).should('exist');
  });

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
