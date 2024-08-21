
# 📚 Task Management System API Documentation

## Overview

Welcome to the **Task Management System** API documentation! This API allows you to manage tasks, including creating, reading, updating, and deleting tasks. The API is RESTful and returns JSON responses.

## 🌐 Base URL

The base URL for all API requests is:

```
http://localhost/api
```

## 🔐 Authentication

All API endpoints require authentication. You must include the `Authorization` header with a valid Bearer token in your requests.

**Example:**

```http
Authorization: Bearer your-access-token
```

## 📬 Endpoints

### 1. 📄 Get All Tasks

**Endpoint:** `GET /tasks`

**Description:** Retrieve a list of all tasks for the authenticated user.

**Request:**

```http
GET /api/tasks HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
```

**Response:**

```json
[
  {
    "id": 1,
    "title": "Complete project documentation",
    "description": "Finish writing the API documentation",
    "status": {
      "id": 1,
      "name": "In Progress"
    },
    "priority": {
      "id": 2,
      "name": "High"
    },
    "due_date": "2024-09-30",
    "created_at": "2024-08-25T10:30:00Z",
    "updated_at": "2024-08-26T12:45:00Z"
  },
  {
    "id": 2,
    "title": "Prepare meeting agenda",
    "description": "Outline the key points for the team meeting",
    "status": {
      "id": 3,
      "name": "Pending"
    },
    "priority": {
      "id": 1,
      "name": "Medium"
    },
    "due_date": "2024-09-29",
    "created_at": "2024-08-20T09:00:00Z",
    "updated_at": "2024-08-21T11:00:00Z"
  }
]
```

### 2. 🔍 Get a Single Task

**Endpoint:** `GET /tasks/{id}`

**Description:** Retrieve details of a specific task by its ID.

**Request:**

```http
GET /api/tasks/1 HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
```

**Response:**

```json
{
  "id": 1,
  "title": "Complete project documentation",
  "description": "Finish writing the API documentation",
  "status": {
    "id": 1,
    "name": "In Progress"
  },
  "priority": {
    "id": 2,
    "name": "High"
  },
  "due_date": "2024-09-30",
  "created_at": "2024-08-25T10:30:00Z",
  "updated_at": "2024-08-26T12:45:00Z"
}
```

### 3. ✏️ Create a New Task

**Endpoint:** `POST /tasks`

**Description:** Create a new task for the authenticated user.

**Request:**

```http
POST /api/tasks HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
Content-Type: application/json

{
  "title": "New Task",
  "description": "This is a new task",
  "status_id": 1,
  "priority_id": 2,
  "due_date": "2024-10-01"
}
```

**Response:**

```json
{
  "id": 3,
  "title": "New Task",
  "description": "This is a new task",
  "status": {
    "id": 1,
    "name": "In Progress"
  },
  "priority": {
    "id": 2,
    "name": "High"
  },
  "due_date": "2024-10-01",
  "created_at": "2024-08-27T14:00:00Z",
  "updated_at": "2024-08-27T14:00:00Z"
}
```

### 4. 🔄 Update an Existing Task

**Endpoint:** `PUT /tasks/{id}`

**Description:** Update an existing task.

**Request:**

```http
PUT /api/tasks/1 HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
Content-Type: application/json

{
  "title": "Updated Task",
  "description": "This task has been updated",
  "status_id": 2,
  "priority_id": 1,
  "due_date": "2024-09-28"
}
```

**Response:**

```json
{
  "id": 1,
  "title": "Updated Task",
  "description": "This task has been updated",
  "status": {
    "id": 2,
    "name": "Completed"
  },
  "priority": {
    "id": 1,
    "name": "Medium"
  },
  "due_date": "2024-09-28",
  "created_at": "2024-08-25T10:30:00Z",
  "updated_at": "2024-08-27T15:00:00Z"
}
```

### 5. 🗑️ Delete a Task

**Endpoint:** `DELETE /tasks/{id}`

**Description:** Delete a specific task by its ID.

**Request:**

```http
DELETE /api/tasks/1 HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
```

**Response:**

```http
HTTP/1.1 204 No Content
```

### 6. 📋 Get Task Statuses

**Endpoint:** `GET /statuses`

**Description:** Retrieve a list of available task statuses.

**Request:**

```http
GET /api/statuses HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
```

**Response:**

```json
[
  {
    "id": 1,
    "name": "In Progress"
  },
  {
    "id": 2,
    "name": "Completed"
  },
  {
    "id": 3,
    "name": "Pending"
  }
]
```

### 7. ⚙️ Get Task Priorities

**Endpoint:** `GET /priorities`

**Description:** Retrieve a list of available task priorities.

**Request:**

```http
GET /api/priorities HTTP/1.1
Host: localhost
Authorization: Bearer your-access-token
```

**Response:**

```json
[
  {
    "id": 1,
    "name": "Low"
  },
  {
    "id": 2,
    "name": "Medium"
  },
  {
    "id": 3,
    "name": "High"
  }
]
```

## 🚨 Error Handling

All errors return a JSON response with an appropriate HTTP status code and an error message.

### Example: Resource Not Found

**Response:**

```json
{
  "error": "Resource not found",
  "status_code": 404
}
```

### Example: Validation Error

**Response:**

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}
```

## 🎉 Conclusion

This API documentation provides you with all the necessary information to interact with the Task Management System's endpoints. Make sure to authenticate your requests using the Bearer token and follow the examples provided to ensure correct usage of the API. If you encounter any issues or need further clarification, feel free to reach out for assistance.
