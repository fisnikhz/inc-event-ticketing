
# Event Ticketing API

A RESTful API for managing events, venues, and ticket bookings. This platform allows users to view, create, and manage events, as well as book and manage tickets.

## Requirements

- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Laravel 12.x

## Installation

### Step 1: Clone the repository

Clone the repository to your local machine:

```bash
git clone [https://github.com/fisnikhz/inc-event-ticketing.git]
cd inc-event-ticketing
```

### Step 2: Install Dependencies

Install the required PHP dependencies via Composer:

```bash
composer install
```


### Step 3:  Set Up Environment Variables

```bash
cp .env.example .env
```


### Step 4: Generate Application Key

```bash
php artisan key:generate
```


### Step 5: Run Migrations and Seeders

```bash
php artisan migrate --seed
```


### Step 6: Set Storage Permissions

```bash
chmod -R 775 bootstrap/cache
```


### Step 7: Run the Development Server
Run the Laravel development server:

```bash
php artisan serve
```


By default, the API will be available at http://localhost:8000.

### Step 8: Authentication
This API uses Laravel Sanctum for authentication. To access protected routes, users must authenticate by logging in, and they will receive an API token to be used in subsequent requests.

```bash
API Endpoints
Public Routes
POST /register: Register a new user.

POST /login: Login a user and get an API token.

Protected Routes (Requires Authentication)
Once authenticated (with a valid token), users can access the following routes:

Event Routes
GET /all/events: Get a list of all upcoming events.

POST /store/event: Create a new event.

GET /find/events/{event}: View details of a specific event.

PUT /update/events/{event}: Update an existing event.

DELETE /delete/events/{event}: Delete an event.

Venue Routes
GET /all/venues: Get a list of all venues.

POST /store/venue: Create a new venue.

GET /find/venues/{venue}: View details of a specific venue.

PUT /update/venues/{venue}: Update an existing venue.

DELETE /delete/venues/{venue}: Delete a venue.

Ticket Routes
GET /all/tickets: Get a list of all tickets.

POST /store/ticket: Book a new ticket for an event.

GET /find/tickets/{ticket}: View details of a specific ticket.

PUT /update/tickets/{ticket}: Update an existing ticket.

DELETE /delete/tickets/{ticket}: Delete a ticket.

Search Routes
GET /search: Search events by name or venue.

User Profile
PUT /profile: Update user profile information.

Rate Limiting
The /store/ticket route has a rate limit of 3 requests per minute (using the throttle:3,1 middleware) to prevent abuse.

Security
Authentication: Uses Laravel Sanctum for API authentication. Users must authenticate and pass a valid bearer token in the Authorization header to access protected routes.

Rate Limiting: Some routes have rate limits to ensure fair usage and prevent abuse, such as booking tickets.
