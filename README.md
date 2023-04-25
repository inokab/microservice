# Order Microservice

## Installing the project

### Requirements

- PHP 8.1 or higher
- Composer
- MySQL or any other database supported by Laravel
- Node.js and NPM

### Steps

Clone the project from the repository

```bash
git clone https://github.com/inokab/microservice.git
```
Navigate to the project directory

```bash
cd microservice
```
Install the project dependencies using Composer

```bash
composer install
```
Copy the example environment file and update it with your database and other settings

```bash
cp .env.example .env
```
Generate the `APP_KEY`

```bash
php artisan key:generate

```
Run database migrations

```bash
php artisan migrate --seed
```
Install frontend dependencies using NPM and compile frontend assets

```bash
npm install
npm run build
```
Start the development server

```bash
php artisan serve
```

The server will start at http://127.0.0.1:8000 by default.

## Docker Usage

Start the containers

```bash
docker-compose up -d
```

Stop the containers

```bash
docker-compose down
```

## Technical Notes



## cURL Requests

```bash
curl --location 'http://127.0.0.1:8000/api/orders/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "shipping_method": 1,
    "billing_address_id": 1,
    "shipping_address_id": 1,
    "products": [
        {
            "id": 1,
            "quantity": 2
        },
        {
            "id": 5,
            "quantity": 1
        }
    ]
}'
```

```bash
curl --location 'http://127.0.0.1:8000/api/orders/list' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
   "id": 1,
   "status": 2,
   "start_date": "2023-04-24 19:00:00",
   "end_date": "2023-04-24 18:54:00"
}'

curl --location 'http://127.0.0.1:8000/api/orders/list' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'id=1' \
--data-urlencode 'status=2' \
--data-urlencode 'start_date=2023-04-24 18:00:00' \
--data-urlencode 'end_date=2023-04-24 19:00:00'
```

```bash
curl --location 'http://127.0.0.1:8000/api/orders/update' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
   "id": 1,
   "status": 2
}'
```
