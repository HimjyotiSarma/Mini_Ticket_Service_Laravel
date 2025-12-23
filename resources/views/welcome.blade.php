<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mini Ticketing System API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu;
            background-color: #f9fafb;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        header {
            background: #111827;
            color: #fff;
            padding: 2rem;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        header p {
            margin-top: .5rem;
            color: #9ca3af;
        }

        .container {
            max-width: 960px;
            margin: auto;
            padding: 2rem;
        }

        section {
            margin-bottom: 2.5rem;
        }

        h2 {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: .5rem;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        h3 {
            margin-top: 1.5rem;
            font-size: 1.1rem;
        }

        ul {
            padding-left: 1.2rem;
        }

        li {
            margin-bottom: .5rem;
        }

        code,
        pre {
            background: #111827;
            color: #e5e7eb;
            padding: .75rem;
            border-radius: 6px;
            display: block;
            overflow-x: auto;
            margin-top: .5rem;
            font-size: .9rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            font-size: .9rem;
            color: #6b7280;
        }

        .badge {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: .2rem .6rem;
            border-radius: 4px;
            font-size: .75rem;
            margin-left: .5rem;
        }
    </style>
</head>

<body>

    <header>
        <h1>Mini Ticketing System <span class="badge">API</span></h1>
        <p>Laravel · Sanctum · JSON-only · Policy-based Authorization</p>
    </header>

    <div class="container">

        <section>
            <h2>Overview</h2>
            <p>
                This project is a <strong>RESTful API-only</strong> mini ticketing system built using
                <strong>Laravel</strong>. It supports authentication, ticket management, and replies
                with role-based authorization.
            </p>
            <p>
                Authentication is handled using <strong>Laravel Sanctum (personal access tokens)</strong>,
                and all responses are returned as <strong>JSON</strong>.
            </p>
        </section>

        <section>
            <h2>Features</h2>

            <h3>Authentication</h3>
            <ul>
                <li>User registration</li>
                <li>User login (token-based)</li>
                <li>User logout (token revocation)</li>
                <li>Authenticated user profile</li>
            </ul>

            <h3>Ticket Management</h3>
            <ul>
                <li>Create, view, update, and close tickets</li>
                <li>Users can access only their own tickets</li>
                <li>Admins can view all tickets</li>
                <li>Ticket lifecycle: <code>open</code>, <code>in_progress</code>, <code>closed</code></li>
            </ul>

            <h3>Replies</h3>
            <ul>
                <li>Replies are nested under tickets</li>
                <li>Only authorized users can reply</li>
                <li>Replies are blocked for closed tickets</li>
            </ul>
        </section>

        <section>
            <h2>API Endpoints</h2>

            <h3>Authentication</h3>
            <pre>
POST /api/register
POST /api/login
POST /api/logout
GET  /api/user
        </pre>

            <h3>Tickets</h3>
            <pre>
POST /api/tickets
GET  /api/tickets            (admin only)
GET  /api/tickets/{ticket}
PUT  /api/tickets/{ticket}
POST /api/tickets/{ticket}/close
        </pre>

            <h3>Replies</h3>
            <pre>
GET  /api/tickets/{ticket}/replies
POST /api/tickets/{ticket}/replies
        </pre>
        </section>

        <section>
            <h2>Authentication Headers</h2>
            <pre>
Authorization: Bearer {access_token}
Accept: application/json
Content-Type: application/json
        </pre>
        </section>

        <section>
            <h2>Error Handling</h2>
            <ul>
                <li><strong>401</strong> – Unauthenticated</li>
                <li><strong>422</strong> – Validation / domain errors</li>
                <li><strong>404</strong> – Resource not found</li>
            </ul>
            <p>
                Custom middleware and exception handling ensure API requests never redirect to HTML pages.
            </p>
        </section>

        <section>
            <h2>Tech Stack</h2>
            <ul>
                <li>Laravel</li>
                <li>Laravel Sanctum</li>
                <li>SQLite (development)</li>
                <li>RESTful JSON API</li>
            </ul>
        </section>

        <section>
            <h2>Interview Note</h2>
            <p>
                <em>
                    “The application is built as a pure REST API. Authentication is handled using Laravel
                    Sanctum personal access tokens, and authorization is enforced using policies.
                    All API routes consistently return JSON responses.”
                </em>
            </p>
        </section>

    </div>

    <footer>
        Mini Ticketing System · Laravel API Assignment
    </footer>

</body>

</html>
