# Notes API Documentation

## Base URL
```
http://localhost:8000/api
```

## API Endpoints

### 1. Get All Notes
**GET** `/notes`

Retrieve all notes from the database.

**Response:**
```json
{
    "status": 1,
    "message": "Notes retrieved successfully",
    "data": [
        {
            "id": 1,
            "title": "Sample Note",
            "content": "This is a sample note content",
            "created_at": "2025-07-02T10:00:00.000000Z",
            "updated_at": "2025-07-02T10:00:00.000000Z"
        }
    ]
}
```

### 2. Create Note Form
**GET** `/notes/create`

Get information about creating a new note.

**Response:**
```json
{
    "status": 1,
    "message": "Note creation form"
}
```

### 3. Create New Note
**POST** `/notes`

Create a new note.

**Request Body:**
```json
{
    "title": "Note Title",
    "content": "Note content goes here"
}
```

**Validation Rules:**
- `title`: required, string
- `content`: required, string

**Response (Success - 201):**
```json
{
    "status": 1,
    "message": "Note created successfully",
    "data": {
        "id": 1,
        "title": "Note Title",
        "content": "Note content goes here",
        "created_at": "2025-07-02T10:00:00.000000Z",
        "updated_at": "2025-07-02T10:00:00.000000Z"
    }
}
```

**Response (Validation Error - 422):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "title": ["The title field is required."],
        "content": ["The content field is required."]
    }
}
```

### 4. Get Single Note
**GET** `/notes/{id}`

Retrieve a specific note by ID.

**Path Parameters:**
- `id`: Note ID (integer)

**Response (Success - 200):**
```json
{
    "status": 1,
    "message": "Note retrieved successfully",
    "data": {
        "id": 1,
        "title": "Note Title",
        "content": "Note content goes here",
        "created_at": "2025-07-02T10:00:00.000000Z",
        "updated_at": "2025-07-02T10:00:00.000000Z"
    }
}
```

**Response (Not Found - 404):**
```json
{
    "message": "No query results for model [App\\Models\\Note] {id}"
}
```

### 5. Get Note for Editing
**GET** `/notes/{id}/edit`

Get note data for editing purposes.

**Path Parameters:**
- `id`: Note ID (integer)

**Response:**
```json
{
    "status": 1,
    "message": "Note data for editing",
    "data": {
        "id": 1,
        "title": "Note Title",
        "content": "Note content goes here",
        "created_at": "2025-07-02T10:00:00.000000Z",
        "updated_at": "2025-07-02T10:00:00.000000Z"
    }
}
```

### 6. Update Note
**PUT/PATCH** `/notes/{id}`

Update an existing note.

**Path Parameters:**
- `id`: Note ID (integer)

**Request Body:**
```json
{
    "title": "Updated Note Title",
    "content": "Updated note content"
}
```

**Validation Rules:**
- `title`: required, string
- `content`: required, string

**Response (Success - 200):**
```json
{
    "status": 1,
    "message": "Note updated successfully",
    "data": {
        "id": 1,
        "title": "Updated Note Title",
        "content": "Updated note content",
        "created_at": "2025-07-02T10:00:00.000000Z",
        "updated_at": "2025-07-02T10:15:00.000000Z"
    }
}
```

### 7. Delete Note
**DELETE** `/notes/{id}`

Delete a specific note.

**Path Parameters:**
- `id`: Note ID (integer)

**Response (Success - 200):**
```json
{
    "status": 1,
    "message": "Note deleted successfully"
}
```

## Error Responses

### Authentication Error (401)
```json
{
    "message": "Unauthenticated."
}
```

### Validation Error (422)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field_name": ["Error message"]
    }
}
```

### Not Found (404)
```json
{
    "message": "No query results for model [App\\Models\\Note] {id}"
}
```

### Server Error (500)
```json
{
    "message": "Server Error"
}
```

## Authentication
This API requires authentication for all note endpoints. You must include a valid Bearer token in the Authorization header.

**Header Required:**
```
Authorization: Bearer {your_token_here}
```

**Getting a Token:**
1. Register: `POST /api/register`
2. Login: `POST /api/login`

Both endpoints will return an access token that you must use for subsequent requests.

## Content Type
All requests should include the following headers:
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer {your_token_here}
```

## Testing the API

### Using cURL

**Get all notes:**
```bash
curl -X GET http://localhost:8000/api/notes \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

**Create a note:**
```bash
curl -X POST http://localhost:8000/api/notes \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"title": "My Note", "content": "This is my note content"}'
```

**Get a specific note:**
```bash
curl -X GET http://localhost:8000/api/notes/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

**Update a note:**
```bash
curl -X PUT http://localhost:8000/api/notes/1 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"title": "Updated Note", "content": "Updated content"}'
```

**Delete a note:**
```bash
curl -X DELETE http://localhost:8000/api/notes/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Notes
- Make sure your Laravel application is running (`php artisan serve`)
- Ensure your database is set up and migrated
- The API uses Laravel's model route binding for automatic model resolution
- All responses follow a consistent JSON structure with status, message, and data fields
