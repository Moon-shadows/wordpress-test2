module.exports = {
    env: {
      browser: true,
      es6: true
    },
    extends: [
      // add more generic rulesets here, such as:
      'eslint:recommended',
      'plugin:vue/vue3-recommended',
      'prettier'
    ],
    rules: {
      'no-console': process.env.NODE_ENV === 'production' ? 'error': 'off',
      'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
      'linebreak-style': ['error', 'unix'],
      quotes: ['error', 'single'],
      semi: ['error', 'never'],
      'comma-dangle': ['error', 'never'],
      'vue/no-v-html': 0
    },
    plugins: [ 'prettier']
  }
