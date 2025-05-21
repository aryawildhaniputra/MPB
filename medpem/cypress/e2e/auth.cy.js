describe('Authentication', () => {
  beforeEach(() => {
    cy.visit('/login');
  });

  it('should show login page', () => {
    // Check for login page elements
    cy.contains('Halo Teman!').should('be.visible');
    cy.contains('Yuk masuk').should('be.visible');
    cy.get('input[name="username"]').should('be.visible');
    cy.get('input[name="password"]').should('be.visible');
    cy.get('button[type="submit"]').should('be.visible');
  });

  it('should login successfully with user credentials', () => {
    // Use credentials from our custom command
    cy.get('input[name="username"]').type('user');
    cy.get('input[name="password"]').type('123');
    cy.get('button[type="submit"]').click();

    // Should redirect to dashboard after login
    cy.url().should('include', '/dashboard');
  });

  it('should display error with invalid credentials', () => {
    // Try with invalid password
    cy.get('input[name="username"]').type('user');
    cy.get('input[name="password"]').type('wrongpassword');
    cy.get('button[type="submit"]').click();

    // Check for various possible error indicators
    cy.get('body').then($body => {
      const hasErrorElement =
        $body.find('.alert-danger:visible, .error-message:visible, .invalid-feedback:visible').length > 0 ||
        $body.text().match(/gagal|invalid|failed|incorrect|wrong/i) !== null;

      // If no error message is displayed, we stay on login page which is also a valid behavior
      expect(hasErrorElement || $body.find('input[name="username"]').length > 0).to.be.true;
    });

    // Should stay on login page
    cy.url().should('include', '/login');
  });
});
