# Notes API 📝

A secure REST API for managing notes built with Laravel 12 and Laravel Passport for authentication. Provides full CRUD operations with OAuth2 token-based authentication.

## 📋 Requirements

- **Docker**: For containerized deployment
- Docker Compose: For managing multi-container applications

## 🚀 Docker Deployment

### 1. Clone repository & prepare environment
```bash
git clone <repository-url>
cd note-API
cp .env.example .env
```











2. **Configure environment variables**

Edit .env to match Docker database settings:
   ```bash
   cp .env.example .env
   ```
Edit your .env file to match the Docker DB(MySQL) settings:

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=notes_db
DB_USERNAME=root
DB_PASSWORD=
```

3. **Generate application key**
```bash
docker-compose run --rm app php artisan key:generate
```

4. **Build and launch containers**
   ```bash
   docker-compose up -d --build
   ```

5. **Install dependencies and setup Passport**
```bash
docker-compose exec notes-api-app-1 composer install
docker-compose exec notes-api-app-1 php artisan install:api --passport
```

6. **Run database migrations**
```bash
sudo docker exec -it notes-api-app-1 php artisan migrate
```

7. **Set proper key permissions**
```bash
sudo docker exec -it notes-api-app-1 chmod 600 storage/oauth-*.key && \
chown www-data:www-data storage/oauth-*.key
```




## 📚 API Documentation

The API provides the following endpoints:

### Base URL
```
http://localhost:8000/api
```

### Authentication Endpoints
- `POST /api/register` - Register a new user
- `POST /api/login` - Login user

### Notes Endpoints
- `GET /api/notes` - Get all notes
- `POST /api/notes` - Create a new note
- `GET /api/notes/{id}` - Get specific note
- `PUT/PATCH /api/notes/{id}` - Update note
- `DELETE /api/notes/{id}` - Delete note

For complete API documentation with examples, see [APIDOC.md](APIDOC.md)

## 🔐 Authentication

This API uses Laravel Passport for authentication. All note endpoints require a valid Bearer token.

### Getting Started with Authentication

1. **Register a new user**
   ```bash
   curl -X POST http://localhost:8000/api/register \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "name": "John Doe",
       "email": "john@example.com",
       "password": "password",
       "confirm_password": "password"
     }'
   ```

2. **Login to get access token**
   ```bash
   curl -X POST http://localhost:8000/api/login \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
       "email": "john@example.com",
       "password": "password"
     }'
   ```

3. **Use token in requests (Example: List notes)**
```bash
curl -X GET http://localhost:8000/api/notes \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#
