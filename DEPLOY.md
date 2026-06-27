# Deployment (Hostinger — Cloud Startup)

This project deploys from GitHub:
`https://github.com/OwaisHameed92/datacapture-forms`

Front-end assets (`public/build`) are **committed**, so the server does **not** need
Node.js. The server only needs **PHP 8.2+** and **Composer** (both available on
Cloud Startup via SSH).

> Connect over SSH: hPanel → **Advanced → SSH Access** (note the host, username and
> port — Hostinger usually uses port **65002**), then:
> `ssh u298593213@<host> -p 65002`

---

## One-time setup

1. **Clone the repo** (ideally *next to*, not inside, the web root):
   ```bash
   cd ~                      # your account home
   git clone https://github.com/OwaisHameed92/datacapture-forms.git app
   cd app
   ```

2. **Create `.env` on the server** (it is intentionally NOT in git). Copy your
   existing production `.env` here, or start from `.env.example` and fill in:
   - `APP_KEY` (run `php artisan key:generate` only on a fresh install — never
     regenerate it once customer data is encrypted)
   - `DB_*` — your existing MySQL credentials
   - `MAIL_*` — real SMTP so notifications actually send
   - `KYC_NOTIFY_EMAIL=you@switchandsave.co.uk`

3. **Install PHP dependencies & build steps:**
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan kyc:backfill-email-hashes      # only if customers already exist
   php artisan storage:link                    # if you use the public disk
   php artisan config:cache route:cache view:cache
   ```

4. **Point the site's Document Root at `public/`**
   (hPanel → Websites → forms.sspos.co.uk → **Advanced**). This is the secure
   setup — the app source then sits outside the web root.
   *If you cannot change the document root*, the committed root `.htaccess`
   rewrites requests into `public/` and blocks `.env`, `.git`, `vendor`, etc.

5. **Permissions:**
   ```bash
   chmod -R ug+rwx storage bootstrap/cache
   ```

---

## Routine deploy (every update)

```bash
cd ~/app
git pull
composer install --no-dev --optimize-autoloader   # only if PHP deps changed
php artisan migrate --force
php artisan config:cache route:cache view:cache    # rebuild caches
```

That's it — no `npm` needed, because `public/build` ships in the repo.

---

## Local workflow (your machine)

When you change CSS/JS, rebuild and commit the assets so the server gets them:

```bash
nvm use 20
npm run build
git add -A
git commit -m "..."
git push
```

---

## Notes
- **Never commit `.env`** — it holds DB and mail secrets. It stays on the server only.
- After this first deploy, **rotate the DB password** that was previously exposed.
- `APP_KEY` encrypts customer email/phone/bank fields *and* keys the email blind
  index — do not change it without a re-encryption migration.
