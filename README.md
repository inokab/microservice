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
Copy the example environment file and update it with your database and other settings. If you are using Docker set the `DB_HOST` to `mysql`

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

## How To Use

After the installation steps import the collection `(Microservice.postman_collection.json)` to Postman or use cURL from CLI. You will find requests for each route.

## cURL Requests

Here you can find the cURL request that you can test. I exported them from Postman and also attached the collection `(Microservice.postman_collection.json)` 

```bash
curl --location 'http://127.0.0.1:8000/api/orders/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "shipping_method": "pickup",
    "billing_address_id": 1,
    "shipping_address_id": 2,
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
   "status": "new",
   "start_date": "2023-04-24 19:00:00",
   "end_date": "2023-04-24 18:54:00"
}'

curl --location 'http://127.0.0.1:8000/api/orders/list' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'id=1' \
--data-urlencode 'status=new' \
--data-urlencode 'start_date=2023-04-24 18:00:00' \
--data-urlencode 'end_date=2023-04-24 19:00:00'
```

```bash
curl --location 'http://127.0.0.1:8000/api/orders/update' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
   "id": 1,
   "status": "new"
}'
```

```bash
curl --location 'http://127.0.0.1:8000/api/addresses/create' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "home",
    "zip_code": "1234",
    "city": "Budapest",
    "street": "Example street 1",
    "type": "shipping"
}'
```

## Technical Notes

My goal was to achieve simplicity in the implementation process. The following steps were taken:

### Database Schema

The database schema was created first, along with the models and the corresponding migration files. Relationships were 
added to the models, and for some columns, such as status, delivery mode, and address types, enums were used instead of 
dedicated tables for simplicity.

### Model Factories

The model factories were used for creating dummy data for each model.

### Controllers

Each endpoint was assigned its own controller and data validation was done in form request classes. In the incoming 
data at the order creation, the assumption was that the addresses were already saved, so the ids were used instead of 
the full address model. The given functions return a JsonResource, or where there is no return value, a response with 
HTTP code 204.
