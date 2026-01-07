# 🛡️ Filament Shield Implementation Documentation

Welcome to the comprehensive guide for the **Role & Permission Management** system implementing `bezhansalleh/filament-shield`. This document covers everything from architectural concepts to practical installation and usage.

---

## 📋 Overview

The **SIMKA Next Web** application utilizes **Filament Shield** to provide a robust, secure, and intuitive Role-Based Access Control (RBAC) system. Shield integrates directly with standard Laravel policies and Spatie's permission library, offering a "GUI-first" approach to security.

> **Goal:** empower administrators to manage user access rights dynamically without needing to touch the codebase.

---

## 🚀 Key Features

-   **GUI-Based Role Management**: Create, edit, and delete roles directly from the Admin Panel.
-   **Automatic Policy Generation**: policies are automatically generated relative to your Models.
-   **Super Admin Access**: Bypasses all checks instantly for maintenance/root users.
-   **Granular Permissions**: Toggle permissions for `view`, `view_any`, `create`, `update`, `delete`, `delete_any`, and special actions.
-   **Developer Friendly**: Uses standard Laravel `can()` methods and Spatie traits.

---

## 🛠️ Technology Stack

| Technology             | Version | Purpose                       |
| :--------------------- | :------ | :---------------------------- |
| **Laravel**            | 12.x    | Core PHP Framework            |
| **Filament**           | v4      | Admin Panel & Form Builder    |
| **Spatie Permissions** | v6.x    | Backend Permission Handling   |
| **Filament Shield**    | 3.x     | Interface & Policy Automation |
| **SQLite / MySQL**     | -       | Database Driver               |

---

## 📋 Prerequisites

Before proceeding, ensure your environment meets these requirements:

1.  **PHP** >= 8.2
2.  **Composer** installed globally.
3.  **Database** configured in `.env`.
4.  Existing **Filament Admin Panel**.

---

## 📂 Project Structure

Key files and directories modified during this implementation:

```tree
app/
├── Models/
│   └── User.php                # 🟢 Added HasRoles & FilamentUser
├── Policies/                   # 🟢 Shield generates policies here
│   ├── UserPolicy.php
│   └── RolePolicy.php
├── Providers/
│   └── Filament/
│       └── AdminPanelProvider.php # 🔌 Plugin Registration
config/
├── filament-shield.php         # ⚙️ General Configuration
└── permission.php              # ⚙️ Spatie Configuration
database/
└── migrations/                 # 🗄️ Permission tables
```

---

## ⚙️ Installation & Setup Manual

If you are setting this up from scratch, follow these chronological steps:

### 1. Install via Composer

```bash
composer require bezhansalleh/filament-shield
```

### 2. Publish Configuration

Publish the config files for Shield and Spatie:

```bash
php artisan vendor:publish --tag=filament-shield-config
```

### 3. Setup the User Model

Modify `app/Models/User.php` to include necessary traits:

```php
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles; // 👈 Crucial for permissions

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Shield handles the rest via policies
    }
}
```

### 4. Register the Plugin

In `app/Providers/Filament/AdminPanelProvider.php`:

```php
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentShieldPlugin::make(), // 🔌 Activate Shield
        ]);
}
```

### 5. Install & Migrate

Run the setup command to publish migrations, create policies, and seed the initial role.

```bash
php artisan shield:install --panel=admin
```

---

## 📖 Operational Guide

### 👑 Creating a Super Admin

The Super Admin has bypass access to everything. Create the first user via backend terminal:

```bash
# 1. Create a User (if none exists)
php artisan tinker
>>> App\Models\User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('password')]);

# 2. Assign Super Admin Role
php artisan shield:super-admin --user=1 --panel=admin
```

### 🌿 Alternative: User Seeding (Recommended)

Instead of using the terminal manually, you can automate this in your `DatabaseSeeder.php`. This is best for consistency across environments.

**File:** `database/seeders/DatabaseSeeder.php`

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

public function run(): void
{
    // 1. Create the user
    $user = User::firstOrCreate(
        ['email' => 'admin@simka.com'], // Identifier
        [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
    );

    // 2. Assign the role (defined in config/filament-shield.php)
    $user->assignRole('super_admin');
}
```

Run it using:

```bash
php artisan db:seed
```

### 🔐 Managing Roles via UI

1.  Navigate to **Shield > Roles** in the sidebar.
2.  Click **Create Role**.
3.  **Select Permissions**: Toggle specific resources (e.g., `User`, `Post`, `Settings`).
4.  Save. The policies are immediately active.

### 🔄 Updating Policies

When you create new Resources or Models, run this to generate their permissions:

```bash
php artisan shield:generate --all
```

---

## 🧠 Logic & Deep Dive

### How Auth Works Here?

1.  **Middleware**: Filament intercepts the request.
2.  **`canAccessPanel`**: Checks if the user is allowed into the admin area.
3.  **Policy Check**: When a user clicks a resource (e.g., "Users"), Laravel's `@can` directive checks the generated `UserPolicy`.
4.  **Shield Logic**: The policy checks the database via Spatie to see if the user's Role has the specific permission (e.g., `view_any_user`).

### Custom Permissions

You can define logical permissions that aren't tied to a database model in `config/filament-shield.php`:

```php
'permission_prefixes' => [
    'resource' => [
        'view',
        'view_any',
        'create',
        'update',
        'delete',
        'delete_any',
        'export',     // ➕ Added custom action
    ],
],
```

---

### ✅ Troubleshooting

-   **"403 Forbidden"**: Ensure the user has the `super_admin` role OR correct permissions for that resource.
-   **"Table 'permissions' already exists"**: Run `migrate:fresh` to reset if in development.
-   **Missing Styles**: Ensure `php artisan filament:upgrade` has been run.

---

_Maintained by the Development Team - 2026_
