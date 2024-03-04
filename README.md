# Project Name:

Music

React & Laravel project for integration music API using laravel and create Docker images for both front and backend.

## Prerequisites

-   Before running this project, Make sure you have NodeJS installed
-   Before running this project, make sure you have Docker installed on your machine.

## Running the Frontend and Backend with Docker

1. Build the Docker images for both frontend and backend:

    ```
    docker build -t frontend-image ./frontend
    docker build -t backend-image ./backend
    ```

2. Run the Docker containers for both frontend and backend:

    - Frontend:

    ```
    project: npm install and npm start
    ```

    ```
    docker: docker run -d -p 3000:3000 frontend-image
    ```

    ```
    Auth cridentials: Loggin with Googgle or Github or Sign up and loggin using inputs form.
    ```

    - Backend:

    ```
    docker run -d -p 80:80 backend-image
    ```

3. Access the frontend application in your web browser at http://localhost:3000 and the backend application's API endpoints as needed.

## Running the Frontend and Backend without Docker

### Frontend

1. Navigate to the `frontend` directory:

    ```
    cd frontend
    ```

2. Install dependencies:

    ```
    npm install
    ```

3. Start the frontend server:

    ```
    npm start
    ```

4. Access the frontend application in your web browser at http://localhost:3000

### Backend

1. Navigate to the `backend` directory:

    ```
    cd backend
    ```

2. Install Laravel dependencies:

    ```
    composer install
    ```

3. Run the backend server:

    ```
    php artisan serve
    ```

4. Access the backend application's API endpoints as needed.

## Additional Notes

-   Make sure to have the necessary environment configurations (such as database connection settings) set up properly for the backend application.
-   You may need to adjust the ports or server configurations based on your specific setup.
