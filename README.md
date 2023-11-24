# Laravel Team Management

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stats4sd/laravel-team-management.svg?style=flat-square)](https://packagist.org/packages/stats4sd/laravel-team-management)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/stats4sd/laravel-team-management/run-tests?label=tests)](https://github.com/stats4sd/laravel-team-management/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/stats4sd/laravel-team-management/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/stats4sd/laravel-team-management/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/stats4sd/laravel-team-management.svg?style=flat-square)](https://packagist.org/packages/stats4sd/laravel-team-management)

This package is an opinionated way to add teams of users to your Laravel application. It includes multiple ways to invite new users via email, and integrates with Laravel Backpack so you can manage teams and user invites via a clean CRUD panel interface.    

The package is intended for use in a Laravel Backpack application, and works best when you also use Laravel Backpack Permission Manager / Spatie Permission Manager to assign users site-wide roles. You can use it in an application that doesn't use Backpack at all, but it will take some extra work to build the pages and integrate the team management blade templates.

## Installation

You can install the package via composer:

```bash
composer require stats4sd/laravel-team-management
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="team-management-migrations"
php artisan migrate
```

You can also choose to publish the config file, but we recommend instead that you set the needed config items in your .env file. 

```bash
php artisan vendor:publish --tag="team-management-config"
```
    
If you want to overwrite or modify the package routes, you can publish the routes file. The package's internal routes will not be loaded if this file (`/routes/backpack/team-management.php`) exists in your application.

```bash
php artisan vendor:publish --tag="team-management-routes"
```

## Setup

To link users to teams, the package needs to know what your application's 'User' model is. The default is to look for '\App\Models\User'. If you use a different model, please add the following entry in your .env file:

```
TEAM_MANAGEMENT_USER_MODEL='\Fqdn\Of\Your\Model'
``` 

You should also add the `HasTeamMemberships` trait to your User model. This trait defines the required relationships to the team, and adds some functionality to enable the invites feature to work as intended.

If you use Permission Manager, you should also define the `SITE_ADMIN_ROLE`. Users with this role will have full access to all teams. By default, this is set to `admin`, but if you use a different convention, please add it to your .env file.

### CRUD Panels
The package includes 3 crud panels. The links to these panels are:
 - **TeamCrudController**: `backpack_url("team")`
 - **InviteCrudController** `backpack_url("invite")`
 - **RoleInviteCrudController** `backpack_url("role-invite")`

You can run the following command to automatically add links at the bottom of your `resources/views/vendor/backpack/base/inc/sidebar_content.blade.php` file:

```bash
php artisan team-management:crud
```

You can also manually add those links to your sidebar, or anywhere else in your application.  

## Package Features

### Team Management

- Users are linked to teams via a many-many relationship. 
- Users can be "members" or "admins" of a team, which is defined on the relationship pivot table with an "is_admin" boolean field.
- Only team admins or site admins can manage the members of a team. 
  - This is defined in the TeamPolicy class, which is referenced in the TeamCrudController to authorise requests. 

The TeamCrudController provides the basic pages required to:
- Create a new team.
- Edit an existing team.
- Manage the team members (via the 'preview' link). This uses the Backpack 'show' operation with a custom blade template. From this page, you can invite or add new members, set existing members as team admins or regular members, or remove users from the team. 
![](https://github.com/stats4sd/laravel-team-management/assets/5711101/c0a6439b-cedb-49f7-8d1c-82762294f03a)


### Invite Users to a Team

![](https://github.com/stats4sd/laravel-team-management/assets/5711101/dc52bf90-b0c2-46c1-b651-bf6a7b6d83e6)


The invite members form has 2 ways to add members. You can search the existing application users and add them directly, or you can send an email invite to people outside of the platform. You can add as many email addresses as you want to the form, and each address will be emailed separately. 

- The invite email uses the template in "/resources/views/emails/invite.blade.php". 
- The registration link is expected to be a route named 'register' (`route('register')`).
- The emailed link includes a `token` query parameter that is set to the `$invite->token`. 
  - If you wish, you may use this token to restrict registrations to *only* people with a valid invite. 
  - By default, this restriction is not included in the package.
- Upon registering, the user is automatically added to any teams they have been invited to. This is done by matching their *email address* to any pending invites, so it is important for users to register using the email that the invite was sent to. 
- By default, new users are team members, not admins. They can be given the admin role by an existing team or site admin. 

### Invite Users to the whole site with a specific role

You may also wish to invite users to your application without assigning them to a team. This package includes a "RoleInvite" model, migration and CrudController to let you manage this. 

- To invite a new user, add a new Role Invite using the CrudController.
- After creating the invite, the email will be sent. The invite email uses the template in `/resources/views/emails/role_invite.blade.php`.
- Similar to a team invite: 
  - the registration link is expected to be defined as a route named 'register' (`route('register')`), 
  - it includes a `token` query parameter, which can be used to only allow registrations by people with a valid invite. 
  - Upon registering, the user is automatically assigned the role from the Role Invite, which is done by matching their *email address* to any pending role invites.
- At present, you can only invite a single email address and assign a single role. 
  - You can get around this limitation by sending multiple role invites - one for each role. However, this will result in multiple emails being sent, so it's probably better to invite a user with one role, then manually add other roles as required once they have registered. 


    
## Credits

- [Stats4SD](https://github.com/stats4sd)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
