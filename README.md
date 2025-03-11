# Laravel Kahoot Clone

This project is a Kahoot clone built with Laravel, using Docker for containerization and WebSockets for real-time functionality.

## Prerequisites

Ensure you have the following installed:
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Getting Started

### 1. Start the Application
Run the following command to start the application in detached mode:

```sh
docker compose up -d
```

This will start all necessary containers, including the web server and database.

### 2. Start WebSocket Server
Inside the web container, run:

```sh
docker compose exec web php artisan websocket:serve
```

Replace `<web_container_name>` with the actual name of the web container (you can find it using `docker ps`).

## Usage

Once the services are running:
- Access the application via `http://localhost`
- WebSockets should be running to enable real-time communication for the quiz system.

## Stopping the Application
To stop the running containers, use:

```sh
docker compose down
```

## Additional Notes
- Ensure that the Laravel environment is set up correctly with `.env` configurations.
- Run `php artisan migrate --seed` inside the container if database migrations are required.
- If needed, you can install dependencies with `composer install` inside the container.
