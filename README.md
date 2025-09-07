# Colors

A stateless **LAMP stack web app** running behind an **NGINX reverse proxy**, fully **dockerized** with `docker-compose`.

## Features
- Secure login & logout with password hasing
- User authentication & session management via secure cookies
- Simple add & search functionality for stored data

## Tech Stack
- Backend: PHP + MySQL
- Frontend: HTML, CSS, JavaScript
- Proxy: NGINX handling TLS termination
- Deployment: Docker for easy setup and portability

## Setup
1. Clone or download this repository
2. Navigate to the project root directory
3. Create .env file with required variables
4. Run `docker-compose up -d`
5. Open your browser and visit localhost
