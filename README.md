## Setup

- Clone this repository
- Copy the `.env.example` file to `.env`
- Set your database credentials in `.env`
- Run `composer install`
- You can use `sail` to run the application

Run the following commands in your docker container:

```bash
php artisan key:generate
php artisan migrate
npm install
npm run dev or npm run watch
