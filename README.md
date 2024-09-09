# Laravel Attendance Lab System
<!--  tables of content  -->

## Table of Contents

- [Laravel Attendance Lab System](#laravel-attendance-lab-system)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
  - [Tech Stack](#tech-stack)
  - [Requirements](#requirements)
  - [Getting Started](#getting-started)
  - [Usage](#usage)
  - [API](#api)
  - [Contributing](#contributing)
  - [License](#license)
  - [Support](#support)
<!--  end tables of content  -->

This project is a Laravel-based attendance system designed for general use. It features face recognition, geolocation, and flexible shift management. The system is ideal for organizations needing an efficient way to track attendance, manage schedules, and handle absences.

## Features

- **Face Recognition**: Users can clock in and out using face recognition technology.
- **Geolocation**: Ensures that attendance is recorded only when users are at the specified location.
- **Absence Management**: Users can provide reasons and evidence for absences.
- **User-Friendly Interface**: Built with Filament to provide a clean and intuitive admin panel.

## Tech Stack

- **Laravel 11.x**: The PHP framework used to build the application.
- **Filament 3**: Used for the admin interface and resource management.
- **MySQL 8.0**: The database system used to store all records.
- **Sanctum**: For API authentication.

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL 8.0 or higher
  
## Getting Started

To get started with the Laravel Attendance Lab project, follow the steps below:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/IlhamGhaza/laravel-attendance-lab.git
    cd laravel-attendance-lab
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Copy the `.env.example` file to `.env`**:

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**:

    ```bash
    php artisan key:generate
    ```

5. **Set up your database**:
    - Update the `.env` file with your database credentials.
    - Run migrations and seeders:

      ```bash
      php artisan migrate --seed
      ```

6. **Serve the application**:

    ```bash
    php artisan serve
    ```

7. **Access the application**:

    Open your web browser and visit `http://localhost:8000` to access the Laravel Attendance Lab application.

## Usage

- **Admin Panel**: Manage shifts, schedules, and attendance records via the Filament interface.
- **Clock In/Out**: Users can clock in and out using the face recognition feature.
- **Manage Shifts**: Admins can create and manage shifts for users.
- **Absence Requests**: Users can submit absence requests with reasons and evidence.

<!-- ## Documentation

For detailed documentation on how to use and customize the Laravel Attendance Lab project, please refer to the [official documentation](https://github.com/IlhamGhaza/laravel-attendance-lab/wiki). -->

## API
<!-- check api in postman_collections -->
you can use postman to test api in postman_collections folder

## Contributing

Contributions are welcome! Please follow the standard GitHub flow:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

## License

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

If you encounter any issues or have any questions, please feel free to reach out to the project maintainer at [Email](cb7ezeur@selenakuyang.anonaddy.com).
