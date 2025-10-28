# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 8 API for a review creation system. The application allows clients to create customizable review forms with questions, collect user reviews, and store them with associated details. Forms are identified by unique 24-character codes generated using Hashids.

## Development Commands

### Setup
```bash
# Install dependencies
composer install

# Copy environment file and configure
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Run database seeders (if needed)
php artisan db:seed
```

### Development Server
```bash
# Start the development server
php artisan serve
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/Controller/FormControllerTest.php

# Run tests with coverage
php artisan test --coverage
```

### Database Operations
```bash
# Create a new migration
php artisan make:migration migration_name

# Rollback last migration
php artisan migrate:rollback

# Reset database and run all migrations
php artisan migrate:fresh

# Seed the database
php artisan db:seed
```

### Code Generation
```bash
# Create a new controller
php artisan make:controller ControllerName

# Create a new model with migration and factory
php artisan make:model ModelName -mf

# Create a new test
php artisan make:test TestName
```

## Architecture

### Database Schema

The application revolves around four main tables with the following relationships:

**forms** - Main review form configuration
- Contains form metadata (name, description, client_id, unique code)
- Has fields for URL conditions, button text customization, and facility introduction (intro/keyword)
- Uses a 24-character unique code generated via Hashids for identification
- Has one-to-many relationship with form_questions

**form_questions** - Questions within a form
- Linked to forms via form_id
- Supports multiple question types (1:text, 2:checkbox, 3:radio)
- Has sort_order for question ordering
- Contains question_part_texts for multi-part questions and review_format for formatting

**reviews** - User-submitted reviews
- Linked to forms via form_id
- Contains star rating and message
- Has one-to-many relationship with review_details

**review_details** - Individual answers to form questions
- Linked to reviews via review_id
- Linked to form_questions via form_question_id
- Stores the actual answer text

**form_versions** - Version tracking for forms (newer addition)
- Tracks current_version for each form_id

### API Routes

Routes are defined in `routes/api.php`:

**Public Routes:**
- `GET /api/forms/{formCode}` - Retrieve form and its questions by code
- `POST /api/reviews/{formCode}` - Submit a review for a form

**Protected Routes (auth:sanctum):**
- Form Management:
  - `POST /api/forms/create/{clientId}` - Create new form
  - `DELETE /api/forms/destroy/{formCode}` - Delete form (also deletes associated questions)
  - `PUT /api/forms/update/{formCode}` - Update form status

- Form Question Management:
  - `POST /api/form-questions/create/{formCode}` - Create question
  - `DELETE /api/form-questions/destroy/{formQuestionId}` - Delete question
  - `PUT /api/form-questions/update/{formQuestionId}` - Update question
  - `POST /api/form-questions/change-sort-order/{formQuestionId}` - Reorder questions

### Controllers

**FormController** (app/Http/Controllers/FormController.php)
- Uses Hashids library to generate unique 24-character codes for forms
- Pattern: '0123456789ABCDEFGHIJKMLNOPQRSTUVWKYZ'
- The destroy method cascades deletion to associated FormQuestions

**FormQuestionController** (app/Http/Controllers/FormQuestionController.php)
- Manages CRUD operations for form questions
- Handles question ordering via changeSortOrder method

**ReviewController** (app/Http/Controllers/ReviewController.php)
- Saves reviews with associated detail records
- Expects request format with 'questions' and 'answers' arrays
- Logs errors but returns generic error messages to users

### Models

Models use Eloquent ORM and are located in `app/Models/`:
- `Form` - Has many FormQuestions relationship
- `Review` - Has many ReviewDetails relationship
- `FormQuestion`, `ReviewDetail` - Standard Eloquent models

### Authentication

The API uses Laravel Sanctum for authentication on protected routes.

## Testing

Tests are organized in `tests/`:
- `tests/Feature/Controller/` - Controller integration tests
- `tests/Unit/` - Unit tests

The project uses PHPUnit with Laravel's testing utilities. Tests use the testing environment configuration defined in `phpunit.xml`.

## Important Notes

### Form Code Generation
Forms use a unique 24-character code generated from client_id using Hashids. The alphabet excludes certain characters to avoid confusion (no 'X' in the pattern string suggests intentional character selection).

### Cascade Deletions
When a form is deleted via FormController::destroy(), all associated FormQuestions are also deleted. However, reviews are NOT automatically deleted - handle with care.

### Recent Schema Changes
A recent migration (2025_10_21_112411_alter_form_version.php) added the form_versions table for version tracking. The reviews and review_details tables were separated in recent commits (see: commit dbfcc97).
