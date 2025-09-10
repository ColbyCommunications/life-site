describe('Colby Link', () => {
    it('Should go to Colby homepage', () => {
        cy.visit('/');
        cy.get('.elementor-nav-menu--main .menu-item-107 a')
            .invoke('removeAttr', 'target')
            .click({ force: true });
        cy.origin('www.colby.edu', () => {
            cy.location('hostname', { timeout: 3000 }).should('include', 'www.colby.edu');
        });
    });
});
