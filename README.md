# Description

This is a small tool built in [Laravel Lumen](https://lumen.laravel.com/docs) to preview & send emails. It was built to be used with [mailtrap](https://mailtrap.io), but, should work with anothers mailers as well.


# How to install

* Clone this repository
* Create the `.env` file from `.env.example` on project root folder
* Make sure to set the `APP_URL`, `MAIL_USERNAME` and `MAIL_PASSWORD` environment variables
* Serve the application with the command `php -S localhost:8000 -t public` (not necessary if using [Laravel Valet](https://laravel.com/docs/7.x/valet) or equivalent)


# How to use

* Copy your `html` or `php` email template to `/resources/views` folder.
* Access `http://{APP_URL}/send/{view-file}` to send an email with the template content.
* Alternatively, access `http://{APP_URL}/preview/{view-file}` to render the email template content.