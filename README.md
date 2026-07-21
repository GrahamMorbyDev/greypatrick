# Grey Patrick

Laravel app for the GreyPatrick.com personal brand site.

## Pages

- `/` - landing page
- `/work` - selected work
- `/quote` - website quote request form
- `/contact` - general contact form
- `/robots.txt`
- `/sitemap.xml`

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

The forms use Laravel Mail and send to `grahampatrickdev@gmail.com`.
Local mail defaults to the `log` mailer. Configure SMTP in `.env` for production delivery.

## Tests

```bash
php artisan test
```
