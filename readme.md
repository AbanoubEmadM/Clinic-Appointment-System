#  Clinix - Clinic Management System

> A full-stack clinic management system built with Laravel and Next.js that digitizes the complete patient journey, from appointment booking to electronic medical records and billing.

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![Next.js](https://img.shields.io/badge/Next.js-React-black?logo=next.js)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-blue?logo=postgresql)
![License](https://img.shields.io/badge/license-MIT-green)

---

## Overview

Clinix is a modern clinic management system designed to replace traditional paper-based workflows with a centralized digital platform.

The system manages the complete lifecycle of a patient's visit, including appointment scheduling, medical records, prescriptions, billing, payments, and doctor reviews while providing dedicated dashboards for administrators, receptionists, doctors, and patients.

---

# The Problem

Many small and medium-sized clinics still rely on:

- Paper medical records
- Phone-based appointment booking
- Manual billing
- Fragmented patient information

These processes often result in:

- Appointment conflicts
- Lost medical history
- Difficult patient follow-up
- Billing inconsistencies
- Poor operational visibility

Clinix addresses these challenges through a centralized, role-based web application.

---

# Features

## Authentication & Authorization

- Secure authentication using Laravel Sanctum
- Role-Based Access Control (RBAC)
- Four user roles:
    - Admin
    - Receptionist
    - Doctor
    - Patient

---

## Appointment Management

Patients can:

- Register an account
- Browse doctors
- Browse specialties
- Book appointments
- Track appointment status

Receptionists can:

- Confirm appointments
- Reject appointments
- Cancel appointments
- Mark no-shows

Doctors can:

- View daily schedules
- Access appointment details

### Appointment Lifecycle

```text
Pending
   │
   ▼
Confirmed
   │
   ▼
Checked In
   │
   ▼
In Progress
   │
   ▼
Completed
```

Alternative flows:

```
Pending → Rejected

Confirmed → Cancelled

Confirmed → No Show
```

Each cancellation stores its corresponding cancellation reason.

---

## Electronic Medical Records (EMR)

Every patient automatically receives a medical record during registration.

Medical records include:

- Visit history
- Examination notes
- Diagnosis
- Treatment plan
- Prescriptions

The complete medical history remains available across future visits.

---

## Prescription Management

Each visit can contain multiple prescriptions.

Every prescription stores:

- Medication
- Dosage
- Frequency
- Duration
- Instructions

---

## Billing System

When a visit is completed:

- An invoice is automatically generated.

The billing system supports:

- Partial payments
- Multiple payments
- Cash payments
- Card payments
- Insurance payments

Invoice status is automatically derived from payment records instead of being manually maintained.

---

## Doctor Reviews

Patients can review doctors only after:

- Completing an appointment
- Visiting that specific doctor

This prevents fake or unauthorized reviews.

---

## Dashboards

### Admin Dashboard

- Manage staff accounts
- Manage doctors
- Manage receptionists
- View system statistics

### Receptionist Dashboard

- Appointment approval
- Appointment management
- Invoice management
- Payment processing

### Doctor Dashboard

- Daily schedule
- Visit management
- Patient history
- Prescription management

### Patient Dashboard

- Book appointments
- Appointment history
- Medical history
- Prescriptions
- Invoices
- Payments
- Doctor reviews

---

# Tech Stack

## Backend

- Laravel
- PostgreSQL
- Laravel Sanctum
- Eloquent ORM
- Form Requests
- API Resources
- Database Transactions

## Frontend

- Next.js
- React
- Tailwind CSS

---

# Architecture Highlights

## Role-Based Authorization

The application separates responsibilities across four user roles while enforcing permissions at the API level.

---

## Normalized Database Design

Prescriptions are stored as a dedicated one-to-many relationship with visits instead of flat database columns, allowing flexible medication management.

---

## Computed Invoice Status

Invoice status is calculated dynamically based on associated payment records rather than stored as a mutable database field.

This prevents synchronization issues between invoices and payments.

---

## Electronic Medical Records

Medical records are automatically created for every patient and preserve the complete longitudinal history of visits, diagnoses, and treatments.

---

## Transactional Business Logic

Critical operations involving multiple tables are wrapped in database transactions to ensure data consistency.

Examples include:

- Completing visits
- Invoice generation
- Recording payments

---

## RESTful API

The backend exposes a RESTful API consumed by the Next.js frontend.

Features include:

- Authentication
- Authorization
- Validation
- Consistent JSON responses
- Resource transformation

---

# Project Structure

```
Clinix
│
├── backend/          # Laravel API
│
├── frontend/         # Next.js Application
│
└── README.md
```

---

# Future Improvements

- Email notifications
- SMS appointment reminders
- Queue workers
- Redis caching
- Docker support
- CI/CD pipeline
- API documentation (OpenAPI / Swagger)
- File uploads
- Calendar integration
- Reporting dashboard
- Multi-clinic support
- Insurance claim management

---

# Learning Objectives

This project demonstrates:

- REST API development
- Role-Based Access Control
- Authentication & Authorization
- Relational Database Design
- Business Rule Implementation
- Database Transactions
- API Design
- Frontend & Backend Integration
- Clean Architecture Principles

---

# License

This project is licensed under the MIT License.
