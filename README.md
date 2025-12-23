# Mini Ticketing System (API-Based)

## Overview

This project is a RESTful **API-only** mini ticketing system built with **Laravel**.  
It supports user authentication, ticket management, and replies with proper role-based authorization.

The application uses **Laravel Sanctum (personal access tokens)** for authentication and is designed to return **JSON responses only**, making it suitable for API clients such as Postman or frontend SPAs.

---

## Features

### Authentication

-   User registration
-   User login (token-based authentication)
-   User logout (token revocation)
-   Authenticated user profile endpoint

### Ticket Management

-   Users can create support tickets
-   Users can view, update, and close their own tickets
-   Admin users can view all tickets
-   Ticket status lifecycle:
    -   `open`
    -   `in_progress`
    -   `closed`
-   Closed tickets cannot be modified (must use the close endpoint)

### Replies

-   Replies are nested under tickets
-   Users and admins can reply to tickets they are authorized to view
-   Replies are not allowed on closed tickets

### Authorization

-   Authorization is implemented using **Laravel Policies**
-   `TicketPolicy` enforces:
    -   Ownership rules
    -   Admin access
-   Reply access is controlled through the associated ticket

---

## API Endpoints

### Authentication Routes

```
POST /api/register
POST /api/login
POST /api/logout
GET /api/user

```

### Ticket Routes

```
POST /api/tickets
GET /api/tickets (admin only)
GET /api/tickets/{ticket}
PUT /api/tickets/{ticket}
POST /api/tickets/{ticket}/close
```

### Reply Routes

```
GET /api/tickets/{ticket}/replies
POST /api/tickets/{ticket}/replies

```

---

## Authentication & Headers

All protected routes require a valid Sanctum token.

### Required Headers

```
Authorization: Bearer {access_token}
Accept: application/json
Content-Type: application/json
```

---

## Error Handling

-   All API responses are returned in **JSON format**
-   Authentication failures return **401 Unauthorized**
-   Validation errors return **422 Unprocessable Entity**
-   Missing resources return **404 Resource Not Found**

Custom middleware and exception handling ensure API requests never redirect to HTML pages.

---

## Database Schema

### Users

-   `id`
-   `name`
-   `email`
-   `password`
-   `role` (`user`, `admin`)
-   timestamps

### Tickets

-   `id`
-   `user_id`
-   `title`
-   `description`
-   `status`
-   `closed_at`
-   timestamps

### Replies

-   `id`
-   `ticket_id`
-   `user_id`
-   `message`
-   timestamps

---

## Tech Stack

-   Laravel
-   Laravel Sanctum
-   SQLite (development database)
-   RESTful JSON API

---

## Notes

-   This project is intentionally **API-only** (no UI)
-   Business logic is kept in models, controllers, and policies
-   Authorization logic is centralized using Laravel Policies
-   Designed to be clean, minimal, and interview-ready

---
