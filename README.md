# Scoupy Test App

## Task

Create a list of running cashback campaigns similar to the main page of the scoupy.com website.

![png](https://i.imgur.com/k28JA2t.png)

## Requirements

- Create a page with the list of cashback coupons (type = cashback), no pagination, no opening detail page views; visual style does not have to match our website.
- Provide a way to hide individual coupons from the UI, using coupon/hide endpoint.
- Provide a callable service command to restore all hidden coupons back. It should fetch hidden coupons using coupon/list endpoint and then “unhide” them all by using coupon/unhide endpoint.

## Tech Stack

### Frontend:

- JavaScript
- [React.js](https://react.dev/)
- [AntDesign](https://ant.design)

### Backend:

- PHP 8.2
- [Laravel](https://laravel.com/)

## Prerequisites

- docker
- docker-compose

## Installation

### Setting up the .env file

- clone the git repository

```bash
git clone git@github.com:fahadbinashraf/scoupy_test.git
```

- cd into the backend folder

```bash
cd scoupy_test/backend
```

- copy the .env.example

```bash
cp .env.example .env
```

Now add the requried scoupy identifiers in the .env file

### Using Docker and docker-compose

```bash
docker-comopse up --build
```

Generate App Key

```bash
docker exec -it scoupy_test_backend php artisan key:generate
```

### Without Docker

Make sure you have the following installed on your system:

- PHP 8.2
- Composer 2
- Node v19
- NPM 9.5

Backend Application:

- cd into the backend folder:

```bash
cd backend
```

- Install dependencies:

```bash
composer install
```

- Run server

```bash
php artisan serve
```

Frontend Application:

- open a new terminal and cd into the frontend folder:

```bash
cd frontend
```

- install dependencies

```bash
npm install
```

- run app

```bash

npm run dev

```

## Usage

Open [localhost:3000](http://localhost:3000) in your web browser.

### Running the console command to unhide coupons

From the Docker container:

```bash
cd backend
docker exec -it scoupy_test_backend php artisan app:unhide-coupons
```

With PHP installed:

```bash
php artisan app:unhide-coupons
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
