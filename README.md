# RiskAdvisor Technical Assessment - "Consumer Facing Form"

This is my solution to the provided Scenarios in the assessment

## Installation
### Local installation
- Instructions on how to set up your **local farm environment** with composer:
    - Run `git clone https://github.com/MusahMusah/risk-advisor-assessment.git` to clone the repository.
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
  
## My Solution Overview:

My solution is built upon the Laravel Breeze authentication mechanism, combined with the Spartie data package for efficient data management. The architecture involves a separation of concerns where Laravel Breeze handles user authentication, while Spartie facilitates the data layer operations, including structuring data objects, implementing validation rules, and formatting data.

### Key Components:

1. Data Layer with Spartie:  
Leveraged Spartie data package to organize data objects into classes.
Implemented data validation and formatting functionalities within the data layer to ensure data integrity and consistency.

2. Service Class "RegisterUserAction":  
Developed a service class specifically tailored to handle business logic related to user registration.
The **"RegisterUserAction"** class manages scenarios such as existing user email submissions and new user creations along with their submissions.

3. Client Development with Vue.js and Tailwind CSS:  
Utilized Vue.js and Tailwind CSS as per the assessment requirements for frontend development.
Leveraged the capabilities of Vue.js for creating dynamic and interactive user interfaces.
Tailwind CSS was employed for efficient styling and layout management, adhering to modern design principles.

4. Classic Server-Side Routing with Inertia.js:  
Implemented classic server-side routing using Inertia.js, which seamlessly integrates with Vue.js and Laravel.
Inertia.js facilitates smooth transitions between pages while maintaining the benefits of server-side rendering.

5. API Endpoints for Mobile Integration:  
Exposed API endpoints to accommodate scenarios where mobile app integration is required.
Ensured compatibility and seamless interaction with mobile applications by providing well-defined and documented APIs.

## API Documentation with Postman
You can find the api documentation for the above solution specifically targeted for mobile client authentication [here](https://api.postman.com/collections/12541181-4ee284a8-9743-464a-b6c9-1f1436cb4ade?access_key=PMAT-01HRQ4HHF3Q33P18PXBM175YB6)

## Technologies / Libraries Used:

- Laravel
- Spartie data package
- Vue.js
- Tailwind CSS
- FontAwesome Fonts
- Inertia.js

## Conclusion:

The solution presented is a robust and scalable architecture that combines the strengths of Laravel, Vue.js, and other modern technologies to deliver a feature-rich web application. By leveraging Laravel Breeze for authentication, Spartie for efficient data management, and Vue.js for dynamic client-side rendering, the solution ensures optimal performance and maintainability. Additionally, the incorporation of Inertia.js and API endpoints enhances flexibility and facilitates seamless integration with various platforms, including mobile applications.

## Testing 🚨
- Automated testing
    - Run `php artisan test` to execute the test cases.
