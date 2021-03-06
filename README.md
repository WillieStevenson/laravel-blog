# laravel-blog
A simple blog using laravel

This is a small, light-weight, no outside dependency (other than what laravel requires) blog app that I built to use as a template for all of my sites.

## Installation

1. Clone the repository.
2. Run `composer install` in the root directory.
3. Run `php artisan key:generate` to generate an application key.
3. Set database credentials.
4. Run `php artisan migrate`.
5. Start the server with `php artisan serve`.
6. Register a single user who can post as admin via the url localhost/register.
7. Close off the register GET and POST routes that `Route::auth()` uses by uncommenting the /register routes found in app/Http/routes.php.
8. Do some exploring.

## Posting

1. You must login to post blog posts. You can login at the url localhost/login.
2. HTML can be used to format the body of your post.
3. If adding images to a blog post, create an images folder (for example, in the public directory) and dump your images there. Use an html img tag and relevant src in the body of the post to link in your images.

## To Do

1. Add a commenting system.
2. Add pagination.
3. Add an easier way to upload images for a post and generate the relative links.