# TodoList-Web

## Requirements
- docker
- docker compose

environment: macOS Monterey M1 chips

## Getting Started

setup docker
```
docker-compose build
docker-compose up
```

```
docker exec -it app bash
cd /var/www/html/app
```

install the package
```
cp .env.example .env
composer install
npm install && npm run dev
```

app setting
```
php artisan migrate
php artisan key:generate
```

run test
```
php artisan test
```

it's run in http://localhost:8000/

<img width="1003" alt="image" src="https://user-images.githubusercontent.com/65715513/190925885-6cea8472-324b-4bea-bbbb-9e25badbd7f7.png">
<img width="1004" alt="image" src="https://user-images.githubusercontent.com/65715513/190925904-3d7dfe31-98c6-4a45-9c6f-eb70ebbe65b3.png">
<img width="1002" alt="image" src="https://user-images.githubusercontent.com/65715513/190925921-bfa8cb2a-ca03-450d-aad6-124234f62360.png">
