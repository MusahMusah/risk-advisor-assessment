# RiskAdvisor Technical Assessment - "Consumer Facing Form"

This is my solution to the provided Scenarios in the assessment

## Installation
### Local installation
- Instructions on how to set up your **local farm environment** with composer:
    - Run `composer install` to install the dependencies.
    - Create a `.env` file using the [.env.example](/.env.example) file as a template. All the appropriate values has been filled in the `.env.example`, this will enable you to run the application locally without issues.
    - Run `php artisan key:generate` to generate the application key.
    - Run `php artisan migrate --seed` to run all migrations and seeders
    - Run `npm install && npm run dev` to bootstrap frontend client [Vuejs] assets 

## Usage
- Web
    - By running the command `php artisan serve` from the root directory of the project, the application will be available at
      `http://127.0.0.1:8000/` by default.
    - Access the application from the browser using the generated url `http://127.0.0.1:8000/`
  
## My Solution

## Testing 🚨
- Automated testing
    - Run `php artisan test` to execute the test cases.
