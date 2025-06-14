import { defineConfig } from 'cypress'

export default defineConfig({
  e2e: {
    // baseUrl: 'https://mpb.oopedia.com',
    baseUrl: 'http://127.0.0.1:8000',
    viewportWidth: 1280,
    viewportHeight: 720,
    video: false,
    screenshotOnRunFailure: true,
    defaultCommandTimeout: 10000,
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },
})
