---
title: task-management-system v1.0.0
language_tabs:
  - shell: Shell
  - http: HTTP
  - javascript: JavaScript
  - ruby: Ruby
  - python: Python
  - php: PHP
  - java: Java
  - go: Go
toc_footers: []
includes: []
search: true
code_clipboard: true
highlight_theme: darkula
headingLevel: 2
generator: "@tarslib/widdershins v4.0.17"

---

# task-management-system

> v1.0.0

Base URLs:

* <a href="http://localhost">Develop Env: http://localhost</a>

# auth

## POST login

POST /api/auth/login

> Body Parameters

```yaml
email: admin@example.ir
password: "123456"

```

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|body|body|object| no |none|
|» email|body|string| yes |none|
|» password|body|string| yes |none|

> Response Examples

> 200 OK

```json
{
  "user": {
    "id": 1,
    "name": "Test User",
    "email": "test@example.com",
    "email_verified_at": "2024-08-21T20:07:28.000000Z",
    "created_at": "2024-08-21T20:07:28.000000Z"
  },
  "token": "2|DZfHYRnmoZAhhIf1i3TPDCrU76mcXYYlXshXd2bn1ba867cd"
}
```

> 422 password required

```json
{
  "message": "The password field is required.",
  "errors": {
    "password": [
      "The password field is required."
    ]
  }
}
```

> 422 provided credentials don't match

```json
{
  "message": "The provided credentials don't match"
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|200 OK|Inline|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|422 password required|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|422 provided credentials don't match|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» user|object|true|none||none|
|»» id|integer|true|none||none|
|»» name|string|true|none||none|
|»» email|string|true|none||none|
|»» email_verified_at|string|true|none||none|
|»» created_at|string|true|none||none|
|» token|string|true|none||none|

HTTP Status Code **422**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|
|» errors|object|true|none||none|
|»» password|[string]|true|none||none|

HTTP Status Code **500**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

## POST register

POST /api/auth/register

> Body Parameters

```yaml
name: user test
email: test@example.com
password: password
password_confirmation: password

```

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|body|body|object| no |none|
|» name|body|string| yes |none|
|» email|body|string| yes |none|
|» password|body|string| yes |none|
|» password_confirmation|body|string| yes |none|

> Response Examples

> 200 OK

```json
{
  "message": "The registration is completed successfully."
}
```

> 422 Duplicate entry/Email

```json
{
  "message": "Duplicate entry 'test@example.com'",
  "errors": {
    "email": [
      "Duplicate entry 'test@example.com'"
    ]
  }
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|200 OK|Inline|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|422 Duplicate entry/Email|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

HTTP Status Code **422**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|
|» errors|object|true|none||none|
|»» email|[string]|true|none||none|

# tasks

## GET list

GET /api/tasks

> Response Examples

> paginate

```json
{
  "data": [
    {
      "id": 1,
      "title": "rerum",
      "description": "Accusamus tempore qui atque optio ea qui aut consequuntur. Enim aliquid consequatur ipsa vitae voluptas beatae illum fugit. Aliquam voluptates ab ut quia.",
      "due_date": "2024-08-26 13:12:52",
      "status": "On Hold",
      "priority": "Low",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 6,
      "status_id": 4,
      "priority_id": 1,
      "user": {
        "id": 6,
        "name": "Flossie Fritsch",
        "email": "elnora.cremin@example.net",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 2,
      "title": "sed",
      "description": "Modi molestias incidunt illum dolores. Mollitia repellendus sequi iusto dignissimos odio. Tenetur suscipit inventore quidem fugiat est ipsa ratione sunt.",
      "due_date": "2024-08-27 13:12:52",
      "status": "In Progress",
      "priority": "High",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 5,
      "status_id": 2,
      "priority_id": 3,
      "user": {
        "id": 5,
        "name": "Mrs. Libbie Langworth II",
        "email": "gonzalo.boyle@example.com",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 3,
      "title": "nostrum",
      "description": "Distinctio dolores rerum quaerat voluptas impedit officiis. Nulla repudiandae illum quis hic blanditiis debitis et. Commodi est et ut odio repellat.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Completed",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 3,
      "priority_id": 2,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 4,
      "title": "saepe",
      "description": "A minima quis impedit unde. Sed itaque accusamus eos natus ut molestiae nisi.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Pending",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 1,
      "priority_id": 2,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 5,
      "title": "iure",
      "description": "Rerum quia in architecto aperiam. Et consequatur molestiae at est. Non maxime velit autem doloremque.",
      "due_date": "2024-08-26 13:12:52",
      "status": "In Progress",
      "priority": "High",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 2,
      "status_id": 2,
      "priority_id": 3,
      "user": {
        "id": 2,
        "name": "Mrs. Anjali Boehm",
        "email": "moore.electa@example.net",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 6,
      "title": "autem",
      "description": "Quis non eos et quidem aut quasi qui. Distinctio aut odio illum neque sint officiis harum. Ab quis dolorum est qui laboriosam.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Pending",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 1,
      "priority_id": 4,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 7,
      "title": "et",
      "description": "Odio eveniet asperiores delectus quasi. Aut aut qui maxime nulla. Repudiandae voluptas occaecati adipisci.",
      "due_date": "2024-08-24 13:12:52",
      "status": "In Progress",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 4,
      "status_id": 2,
      "priority_id": 4,
      "user": {
        "id": 4,
        "name": "Abel Hand",
        "email": "bertrand.kautzer@example.org",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 8,
      "title": "omnis",
      "description": "Totam quia fugit qui tempore ut. At voluptates sed consequatur autem quos. Ut nulla labore eum eum quo. Odio totam et qui quaerat illum dolorem corporis. Sed dolore est non.",
      "due_date": "2024-08-23 13:12:52",
      "status": "In Progress",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 3,
      "status_id": 2,
      "priority_id": 2,
      "user": {
        "id": 3,
        "name": "Marcelle Gusikowski",
        "email": "nia.hodkiewicz@example.com",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 9,
      "title": "odit",
      "description": "Quasi veniam aut omnis voluptas voluptas. Voluptate totam ut aliquam accusantium. Ab sequi et est numquam et rem voluptas. Quidem consequatur ut consequatur.",
      "due_date": "2024-08-25 13:12:52",
      "status": "Completed",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 3,
      "status_id": 3,
      "priority_id": 2,
      "user": {
        "id": 3,
        "name": "Marcelle Gusikowski",
        "email": "nia.hodkiewicz@example.com",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 10,
      "title": "quae",
      "description": "Et mollitia omnis at numquam distinctio officia et nesciunt. Eum et dolores dolor beatae illum est. Animi aliquid est fuga ut ut ipsa maxime. In non odit voluptatibus. Qui dolores ab vero rerum.",
      "due_date": "2024-08-26 13:12:52",
      "status": "In Progress",
      "priority": "High",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 6,
      "status_id": 2,
      "priority_id": 3,
      "user": {
        "id": 6,
        "name": "Flossie Fritsch",
        "email": "elnora.cremin@example.net",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 11,
      "title": "error",
      "description": "Eos earum velit recusandae sapiente. Quos ut facere placeat iusto et dolores alias. Praesentium dolores voluptatem ea nam sunt quidem consectetur. Optio sit blanditiis sunt pariatur repellat.",
      "due_date": "2024-08-23 13:12:52",
      "status": "Pending",
      "priority": "Low",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 4,
      "status_id": 1,
      "priority_id": 1,
      "user": {
        "id": 4,
        "name": "Abel Hand",
        "email": "bertrand.kautzer@example.org",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 12,
      "title": "voluptate",
      "description": "Totam non ipsa et ut autem. Magnam dolores doloremque aut id adipisci facilis omnis. At harum perferendis ut qui et. Neque aperiam nobis quaerat quasi.",
      "due_date": "2024-08-25 13:12:52",
      "status": "In Progress",
      "priority": "Low",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 3,
      "status_id": 2,
      "priority_id": 1,
      "user": {
        "id": 3,
        "name": "Marcelle Gusikowski",
        "email": "nia.hodkiewicz@example.com",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 13,
      "title": "voluptates",
      "description": "Ratione veniam possimus dolor et consequuntur repellat dolores. Quis voluptas rerum facilis pariatur nihil amet ea perspiciatis. A consequatur nulla asperiores quis iusto rem dolor sapiente.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Pending",
      "priority": "High",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 5,
      "status_id": 1,
      "priority_id": 3,
      "user": {
        "id": 5,
        "name": "Mrs. Libbie Langworth II",
        "email": "gonzalo.boyle@example.com",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 14,
      "title": "eum",
      "description": "Corporis consequuntur quos ad recusandae autem quia ducimus. Nemo et sequi debitis ullam non sit. Dignissimos ducimus velit est alias fugit enim dolorum.",
      "due_date": "2024-08-27 13:12:52",
      "status": "On Hold",
      "priority": "Low",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 4,
      "priority_id": 1,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 15,
      "title": "numquam",
      "description": "Et iure et sapiente rerum est itaque. Earum eum veniam quisquam et quis. Consequuntur explicabo sed dolores cumque temporibus placeat aut.",
      "due_date": "2024-08-23 13:12:52",
      "status": "Pending",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 4,
      "status_id": 1,
      "priority_id": 4,
      "user": {
        "id": 4,
        "name": "Abel Hand",
        "email": "bertrand.kautzer@example.org",
        "email_verified_at": "2024-08-22T13:12:52.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    }
  ],
  "links": {
    "first": "http://localhost/api/tasks?page=1",
    "last": "http://localhost/api/tasks?page=4",
    "prev": null,
    "next": "http://localhost/api/tasks?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 4,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://localhost/api/tasks?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": "http://localhost/api/tasks?page=2",
        "label": "2",
        "active": false
      },
      {
        "url": "http://localhost/api/tasks?page=3",
        "label": "3",
        "active": false
      },
      {
        "url": "http://localhost/api/tasks?page=4",
        "label": "4",
        "active": false
      },
      {
        "url": "http://localhost/api/tasks?page=2",
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http://localhost/api/tasks",
    "per_page": 15,
    "to": 15,
    "total": 50
  }
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|paginate|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» data|[object]|true|none||none|
|»» id|integer|true|none||none|
|»» title|string|true|none||none|
|»» description|string|true|none||none|
|»» due_date|string|true|none||none|
|»» status|string|true|none||none|
|»» priority|string|true|none||none|
|»» created_at|string|true|none||none|
|»» updated_at|string|true|none||none|
|»» user_id|integer|true|none||none|
|»» status_id|integer|true|none||none|
|»» priority_id|integer|true|none||none|
|»» user|object|true|none||none|
|»»» id|integer|true|none||none|
|»»» name|string|true|none||none|
|»»» email|string|true|none||none|
|»»» email_verified_at|string|true|none||none|
|»»» created_at|string|true|none||none|
|» links|object|true|none||none|
|»» first|string|true|none||none|
|»» last|string|true|none||none|
|»» prev|null|true|none||none|
|»» next|string|true|none||none|
|» meta|object|true|none||none|
|»» current_page|integer|true|none||none|
|»» from|integer|true|none||none|
|»» last_page|integer|true|none||none|
|»» links|[object]|true|none||none|
|»»» url|string¦null|true|none||none|
|»»» label|string|true|none||none|
|»»» active|boolean|true|none||none|
|»» path|string|true|none||none|
|»» per_page|integer|true|none||none|
|»» to|integer|true|none||none|
|»» total|integer|true|none||none|

## GET show

GET /api/tasks/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

> Response Examples

> show

```json
{
  "data": {
    "id": 1,
    "title": "rerum",
    "description": "Accusamus tempore qui atque optio ea qui aut consequuntur. Enim aliquid consequatur ipsa vitae voluptas beatae illum fugit. Aliquam voluptates ab ut quia.",
    "due_date": "2024-08-26 13:12:52",
    "status": "On Hold",
    "priority": "Low",
    "created_at": "2024-08-22 13:12:52",
    "updated_at": "2024-08-22 13:12:52",
    "user_id": 6,
    "status_id": 4,
    "priority_id": 1,
    "user": {
      "id": 6,
      "name": "Flossie Fritsch",
      "email": "elnora.cremin@example.net",
      "email_verified_at": "2024-08-22T13:12:52.000000Z",
      "created_at": "2024-08-22T13:12:52.000000Z"
    }
  }
}
```

> 404 Not Found

```json
{
  "message": "The requested task does not exist."
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|show|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|404 Not Found|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» data|object|true|none||none|
|»» id|integer|true|none||none|
|»» title|string|true|none||none|
|»» description|string|true|none||none|
|»» due_date|string|true|none||none|
|»» status|string|true|none||none|
|»» priority|string|true|none||none|
|»» created_at|string|true|none||none|
|»» updated_at|string|true|none||none|
|»» user_id|integer|true|none||none|
|»» status_id|integer|true|none||none|
|»» priority_id|integer|true|none||none|
|»» user|object|true|none||none|
|»»» id|integer|true|none||none|
|»»» name|string|true|none||none|
|»»» email|string|true|none||none|
|»»» email_verified_at|string|true|none||none|
|»»» created_at|string|true|none||none|

HTTP Status Code **404**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

# tasks/secured

## POST create

POST /api/tasks

> Body Parameters

```yaml
title: new task
description: new description
status_id: "1"
priority_id: "2"
due_date: 2024-08-30

```

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|body|body|object| no |none|
|» title|body|string| yes |none|
|» description|body|string| yes |none|
|» status_id|body|string| yes |none|
|» priority_id|body|string| yes |none|
|» due_date|body|string| yes |none|

> Response Examples

> 201 Created

```json
{
  "message": "The task created successfully.",
  "data": {
    "id": 51,
    "title": "new task",
    "description": "new description",
    "due_date": "2024-08-30",
    "status": "Pending",
    "priority": "Medium",
    "created_at": "2024-08-22 14:05:37",
    "updated_at": "2024-08-22 14:05:37",
    "user_id": 1,
    "status_id": "1",
    "priority_id": "2"
  }
}
```

> 422 empty form

```json
{
  "message": "The title field is required. (and 2 more errors)",
  "errors": {
    "title": [
      "The title field is required."
    ],
    "status_id": [
      "The status id field is required."
    ],
    "priority_id": [
      "The priority id field is required."
    ]
  }
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|201 Created|Inline|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|422 empty form|Inline|

### Responses Data Schema

HTTP Status Code **201**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|
|» data|object|true|none||none|
|»» id|integer|true|none||none|
|»» title|string|true|none||none|
|»» description|string|true|none||none|
|»» due_date|string|true|none||none|
|»» status|string|true|none||none|
|»» priority|string|true|none||none|
|»» created_at|string|true|none||none|
|»» updated_at|string|true|none||none|
|»» user_id|integer|true|none||none|
|»» status_id|string|true|none||none|
|»» priority_id|string|true|none||none|

HTTP Status Code **422**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|
|» errors|object|true|none||none|
|»» title|[string]|true|none||none|
|»» status_id|[string]|true|none||none|
|»» priority_id|[string]|true|none||none|

## POST update

POST /api/tasks/{id}

> Body Parameters

```yaml
title: updated task
description: updated description
status_id: "3"
priority_id: "2"
due_date: 2024-08-30

```

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|
|_method|query|string| yes |none|
|body|body|object| no |none|
|» title|body|string| yes |none|
|» description|body|string| yes |none|
|» status_id|body|string| yes |none|
|» priority_id|body|string| yes |none|
|» due_date|body|string| yes |none|

> Response Examples

> 200 OK

```json
{
  "message": "The task updated successfully."
}
```

> 422 status id is invalid

```json
{
  "message": "The selected status id is invalid.",
  "errors": {
    "status_id": [
      "The selected status id is invalid."
    ]
  }
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|200 OK|Inline|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|422 status id is invalid|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

HTTP Status Code **422**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|
|» errors|object|true|none||none|
|»» status_id|[string]|true|none||none|

## DELETE delete

DELETE /api/tasks/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

> Response Examples

> 200 OK

```json
{
  "message": "The task deleted successfully."
}
```

> 403 Forbidden

```json
{
  "message": "This action is unauthorized."
}
```

> 404 Not Found

```json
{
  "message": "Task not found with ID: 4111"
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|200 OK|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|403 Forbidden|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|404 Not Found|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

HTTP Status Code **403**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

HTTP Status Code **404**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» message|string|true|none||none|

## GET getUserTasks

GET /api/tasks/user

> Response Examples

> list

```json
{
  "data": [
    {
      "id": 3,
      "title": "nostrum",
      "description": "Distinctio dolores rerum quaerat voluptas impedit officiis. Nulla repudiandae illum quis hic blanditiis debitis et. Commodi est et ut odio repellat.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Completed",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 3,
      "priority_id": 2,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 4,
      "title": "saepe",
      "description": "A minima quis impedit unde. Sed itaque accusamus eos natus ut molestiae nisi.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Pending",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 1,
      "priority_id": 2,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 6,
      "title": "autem",
      "description": "Quis non eos et quidem aut quasi qui. Distinctio aut odio illum neque sint officiis harum. Ab quis dolorum est qui laboriosam.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Pending",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 1,
      "priority_id": 4,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 14,
      "title": "eum",
      "description": "Corporis consequuntur quos ad recusandae autem quia ducimus. Nemo et sequi debitis ullam non sit. Dignissimos ducimus velit est alias fugit enim dolorum.",
      "due_date": "2024-08-27 13:12:52",
      "status": "On Hold",
      "priority": "Low",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 4,
      "priority_id": 1,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 23,
      "title": "sapiente",
      "description": "Sit fuga sint consequatur omnis dolores ut. Et illo et consectetur dolore tempore. Voluptatem a aperiam consequatur quam aut quam. Quae recusandae consequatur non aut.",
      "due_date": "2024-08-27 13:12:52",
      "status": "Completed",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 3,
      "priority_id": 4,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 43,
      "title": "eum",
      "description": "Magnam facilis autem fuga qui eligendi modi qui. Sit voluptas quae earum est rem illo. Ad sed rerum non maiores. Molestiae recusandae animi eligendi expedita in.",
      "due_date": "2024-08-23 13:12:52",
      "status": "In Progress",
      "priority": "Medium",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 2,
      "priority_id": 2,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    },
    {
      "id": 47,
      "title": "veniam",
      "description": "Repudiandae reprehenderit fugit corrupti perspiciatis inventore tempora eum minus. Qui voluptatum tempore fugiat eius voluptatibus voluptatem. Fugit placeat laudantium vero id blanditiis natus.",
      "due_date": "2024-08-26 13:12:52",
      "status": "Completed",
      "priority": "Critical",
      "created_at": "2024-08-22 13:12:52",
      "updated_at": "2024-08-22 13:12:52",
      "user_id": 1,
      "status_id": 3,
      "priority_id": 4,
      "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.ir",
        "email_verified_at": "2024-08-22T13:12:51.000000Z",
        "created_at": "2024-08-22T13:12:52.000000Z"
      }
    }
  ],
  "links": {
    "first": "http://localhost/api/tasks/user?page=1",
    "last": "http://localhost/api/tasks/user?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://localhost/api/tasks/user?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http://localhost/api/tasks/user",
    "per_page": 15,
    "to": 7,
    "total": 7
  }
}
```

### Responses

|HTTP Status Code |Meaning|Description|Data schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|list|Inline|

### Responses Data Schema

HTTP Status Code **200**

|Name|Type|Required|Restrictions|Title|description|
|---|---|---|---|---|---|
|» data|[object]|true|none||none|
|»» id|integer|true|none||none|
|»» title|string|true|none||none|
|»» description|string|true|none||none|
|»» due_date|string|true|none||none|
|»» status|string|true|none||none|
|»» priority|string|true|none||none|
|»» created_at|string|true|none||none|
|»» updated_at|string|true|none||none|
|»» user_id|integer|true|none||none|
|»» status_id|integer|true|none||none|
|»» priority_id|integer|true|none||none|
|»» user|object|true|none||none|
|»»» id|integer|true|none||none|
|»»» name|string|true|none||none|
|»»» email|string|true|none||none|
|»»» email_verified_at|string|true|none||none|
|»»» created_at|string|true|none||none|
|» links|object|true|none||none|
|»» first|string|true|none||none|
|»» last|string|true|none||none|
|»» prev|null|true|none||none|
|»» next|null|true|none||none|
|» meta|object|true|none||none|
|»» current_page|integer|true|none||none|
|»» from|integer|true|none||none|
|»» last_page|integer|true|none||none|
|»» links|[object]|true|none||none|
|»»» url|string¦null|true|none||none|
|»»» label|string|true|none||none|
|»»» active|boolean|true|none||none|
|»» path|string|true|none||none|
|»» per_page|integer|true|none||none|
|»» to|integer|true|none||none|
|»» total|integer|true|none||none|


