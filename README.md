

### Part 1: Project Overview

```markdown
# Backend API for User and Product Management

## Overview
This project is a backend API built with Laravel for managing users and products. It includes authentication, user CRUD operations, and product CRUD operations, with price adjustments based on user types.
```

---

### Part 2: Requirements

```markdown
## Requirements
- PHP 8.1 or higher
- Composer
- Laravel 10 or higher
- MySQL or SQLite
```

---

### Part 3: Installation Steps

```markdown
## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/sete20/tenjaz-task
   ```

2. **Navigate to the project directory**:
   ```bash
   cd your-repo
   ```

3. **Install dependencies**:
   ```bash
   composer install
   ```

4. **Set up environment variables**:
   Copy the `.env.example` file to `.env` and configure your database settings.
   ```bash
   cp .env.example .env
   ```

5. **Generate an application key**:
   ```bash
   php artisan key:generate
   ```

6. **Run migrations**:
   ```bash
   php artisan migrate
   ```

7. **Start the server**:
   ```bash
   php artisan serve
   ```
```

---

### Part 4: API Endpoints

```markdown
## API Endpoints

### Authentication
- **POST `/api/register`**: Register a new user.
- **POST `/api/login`**: Log in a user and return a token.

### User Management
- **GET `/api/users`**: Retrieve all users.
- **GET `/api/users/{id}`**: Retrieve a specific user.
- **POST `/api/users`**: Create a new user.
- **PUT `/api/users/{id}`**: Update a user.
- **DELETE `/api/users/{id}`**: Delete a user.

### Product Management
- **GET `/api/products`**: Retrieve all active products (prices adjusted based on user type).
- **GET `/api/products/{id}`**: Retrieve a specific product.
- **POST `/api/products`**: Create a new product.
- **PUT `/api/products/{id}`**: Update a product.
- **DELETE `/api/products/{id}`**: Delete a product.
```

---

### Part 5: Usage

```markdown
## Usage

### Authentication
Include the `Authorization` header with `Bearer <your_token>` for endpoints requiring authentication.

### Example cURL Command
```bash
curl -X POST http://localhost:8000/api/register \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "username": "johndoe", "password": "password123", "type": "normal"}'
```
```

---

### Part 6: Testing

```markdown
## Testing
Use Postman or similar tools to test the API endpoints. Ensure that you include the `Authorization` header for protected routes.
```



