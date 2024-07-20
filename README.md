# Task Planner

The Task Planner is a web application designed to assign tasks to developers in a way that ensures the tasks are completed in the shortest possible time. The application fetches task data from two different providers and distributes them among developers based on their efficiency and availability.

## Purpose

The main goal of this project is to assign tasks to developers in such a way that the total time taken to complete all tasks is minimized. Each developer has a different efficiency rate, which is taken into account when assigning tasks.

## Project Details

The project was developed using Laravel Framework version 11.16.0 and PHP version 8.2.21. It utilizes Laravel's migration, seeding, and custom commands to manage tasks and assignments.

## Getting Started

To get started with the project, follow the steps below:

### Prerequisites

Make sure you have the following installed on your machine:

- PHP 8.2.21
- Composer
- Laravel Framework 11.16.0

### Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/mertsnmz/task-planner.git
    cd task-planner
    ```

2. **Install the dependencies:**

    ```sh
    composer install
    ```

3. **Set up your environment:**

    - Copy the `.env.example` file to `.env`:

      ```sh
      cp .env.example .env
      ```

    - Update the `.env` file with your database configuration.

4. **Generate an application key:**

    ```sh
    php artisan key:generate
    ```

### Database Setup

1. **Run the migrations:**

    ```sh
    php artisan migrate
    ```

2. **Seed the database:**

    ```sh
    php artisan db:seed
    ```

### Fetch and Plan Tasks

1. **Fetch tasks from providers:**

    ```sh
    php artisan tasks:fetch
    ```

2. **Plan tasks:**

    ```sh
    php artisan tasks:plan
    ```

### Running the Application

1. **Serve the application:**

    ```sh
    php artisan serve
    ```

2. **Open your browser and navigate to:**

    ```
    http://localhost:8000
    ```

## Explanation

### Task Fetching

Tasks are fetched from two different providers (`mock-one` and `mock-two`). Each provider returns tasks with specific attributes like `id`, `value`, `estimated_duration`, and `provider`.

### Task Planning

The tasks are assigned to developers in such a way that the overall completion time is minimized. Each developer has an efficiency rate, which is used to calculate the time required to complete each task. The algorithm ensures that each developer's workload is balanced and does not exceed the weekly limit of 45 hours.

### Algorithm

The algorithm works as follows:

1. Fetch all tasks from the providers.
2. Sort tasks based on their difficulty and estimated duration.
3. Assign tasks to developers based on their efficiency and current workload.
4. Ensure that the total workload for each developer does not exceed 45 hours per week.

## License

This project is open-source and available under the MIT License.
# task-planner
# task-planner
