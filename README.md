<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/ariff-fikri/spmath/blob/master/public/assets/images/home_banner.jpg?raw=true" width="400"></a></p>

# SPMath

## Introduction

⚡ SPMath 🎓 – Elevate online learning with our intuitive platform! Interactive courses, real-time collaboration, and personalized progress tracking. Join us in shaping the future of education! 🌐💡 #EdTech #OnlineLearning

## Table of Contents

- [Prerequisites](#prerequisites)
- [Getting Started](#getting-started)
- [Docker Compose Services](#docker-compose-services)
- [Additional Commands](#additional-commands)
- [License](#license)

## Prerequisites

Before you begin, make sure you have the following software installed on your system:

- [Docker](https://www.docker.com/get-started)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Git](https://git-scm.com/)

## Getting Started

1. Clone this repository (if you haven't already):

    ```bash
    git clone git@github.com:ariff-fikri/spmath.git
    cd spmath
    ```

2. Create a copy of the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

3. Customize the `.env` file with your application configuration settings, such as database credentials and app key.

4. Build and start the Docker containers:

    ```bash
    docker compose up -d --build
    ```

5. Run database migrations and seed the database:

    ```bash
    docker exec -ti app bash
    php artisan migrate:fresh --seed
    ```

6. Access the app in your browser at [http://localhost:8000](http://localhost:8000).

## Docker Compose Services

This Docker Compose setup includes the following services:

- **app**: The Laravel application container.
- **nginx**: A web server container using Nginx to serve the Laravel app.
- **database**: The MySQL database container.

## Additional Commands

- Stop the Docker containers:

    ```bash
    docker compose down
    ```

- View logs (e.g., Laravel logs):

    ```bash
    docker compose logs
    ```

- List all containers (e.g., including the stopped ones):

    ```bash
    docker ps -a
    ```

## Credits

- [Ariff Fikri](https://github.com/ariff-fikri)

## About Ariff Fikri

Ariff Fikri is a senior web developer specialising on the Laravel framework. Visit [my website](https://ariff-fikri.com/).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Thank you for visiting!
