# IndexNow setup

IndexNow notifies participating search engines of changed URLs. Receipt (200 or
202) is not a guarantee of crawling or indexing. Google Search indexing is not
provided by this integration.

## Activate after deployment

1. Deploy the code and `public/83e42611bb1c4865ab57c57d58f78a19.txt` to the site's
   document root. On Hostinger, ensure the file reaches `public_html` if public
   assets are copied separately. Confirm the public HTTPS key URL returns the
   exact key as plain text, without authentication or redirects.
2. In the server `.env`, set `APP_URL` to the site's canonical HTTPS origin,
   `INDEXNOW_ENABLED=true` and `INDEXNOW_QUEUE_CONNECTION=database`. Keep this
   disabled on local and staging environments.
3. Run `php artisan config:cache` and `php artisan queue:restart`.
   Existing queue migrations must already have been applied.
4. Run `php artisan indexnow:submit --all --dry-run` to review public URLs,
   then `php artisan indexnow:submit --all` once for the initial submission.
5. Process the database queue continuously with a supervised worker, or add a
   Hostinger cron every minute using the absolute PHP and artisan paths:

   ```sh
   cd /absolute/path/to/project && php artisan queue:work database --stop-when-empty --max-time=50 --timeout=30 --tries=5
   ```

   Use the PHP version configured for the app. Do not add a duplicate cron if a
   worker already processes the database default queue. On shared hosting,
   configure cron locking or the hosting platform's overlap protection.

## Ongoing use

Blog creation, edits, slug changes, unpublishing and deletion enqueue relevant
URLs plus `/blog` after the database transaction commits. Drafts are excluded.
Future publications create delayed jobs that check the current publication
time and status before submitting. Cancelled or rescheduled jobs are ignored.
Future posts scheduled before activation need to be saved again to enqueue
their publication notification.

For a static tool or page changed in code, submit its canonical URL after
deployment:

```sh
php artisan indexnow:submit https://your-domain.example/image-resizer
```

`--all` reuses the public sitemap. It excludes draft blogs, admin and temporary
download URLs. Do not run full submissions on every visit or every minute.

HTTP errors and connection failures retry with increasing delays. Check
`php artisan queue:failed` and application logs; after fixing the cause, use
`php artisan queue:retry <id>`. Enqueue failures are logged without interrupting
blog saves; resubmit affected URLs with the command after recovery. Model bulk
updates/deletes through the query builder bypass Eloquent events and require
manual URL submission.

Protocol reference: https://www.indexnow.org/documentation
