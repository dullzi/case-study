# Library Management System

full-stack library management application built with Laravel 11, Vue 3, and Inertia.js. It features a modern design, real-time search, and robust Role-Based Access Control (RBAC).

---

## Features

- Inventory Management: Full CRUD for Books, Authors, and Publishers.
- Dual Authentication: 
  - Web: Session-based auth via Laravel Breeze & Inertia.
  - API: JWT-based auth via `php-open-source-saver/jwt-auth`.
- Role-Based Access Control (RBAC):
  - Admin: Full control (Create, Read, Update, Delete).
  - User: Read-only access with real-time search.
- Advanced Search: Instant, real-time filtering for all entities.
- Modern UI/UX: Premium dark-mode dashboard with glassmorphism aesthetics.
- Responsive Design: Optimized for mobile, tablet, and desktop.
- API Documentation: Integrated Swagger/OpenAPI documentation.

---

##  Requirement Fulfillment Audit

| Requirement | Status | Implementation Detail |
| :--- | :---: | :--- |
| Manage Books, Authors, Publishers | ✅ | Full Eloquent Models & Controllers |
| One Author to many Books | ✅ | `HasMany` relationship implemented |
| One Book to one Publisher | ✅ | `BelongsTo` relationship implemented |
| Authentication: JWT | ✅ | Implemented in `routes/api.php` |
| Authorization: All CRUD | ✅ | Protected by `AdminMiddleware` & `auth` |
| Seeder & Migration | ✅ | Available in `database/` |
| Pagination & Filtering | ✅ | Implemented in both Web & API |
| Frontend Framework: Laravel/Vue | ✅ | Inertia.js with Vue 3 |
| UI/UX: TailwindCSS | ✅ | Premium custom design system |

---

##  Installation

1. Clone the repository
   ```bash
   git clone <repository-url>
   cd case-study
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Environment Setup
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan jwt:secret
   ```

4. Configure Database
   Update your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=case_study
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run Migrations & Seeders
   This will create the tables and populate data (including Admin & User accounts).
   ```bash
   php artisan migrate:fresh --seed


6. Start the Application
   ```bash
   # Terminal 1
   php artisan serve
   
   # Terminal 2
   npm run dev
   

## Credentials (Demo)

| Role | Email | Password |
| :--- | :--- | :--- |
| Administrator | `admin@example.com` | `password` |
| Regular User | `user@example.com` | `password` |


## 📖 API Documentation

Access the Swagger UI documentation at:
`http://localhost:8000/api/documentation`

To regenerate docs after changing annotations:
```bash
php artisan l5-swagger:generate

## POSTMAN
Link : https://dul-2365939.postman.co/workspace/Melidul~1fdb021a-51f1-4212-94da-25d67ac728e3/collection/undefined?action=share&creator=45439220
