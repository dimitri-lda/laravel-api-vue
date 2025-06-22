# laravel-api

Pet project for learning Laravel API + Swagger + OpenAPI + Docket + PostgreSQL  
Front: Vue.js  
NoSQL will be added in the future versions.

installation:
```bash
composer install
npm install
docker-compose up -d --build
```

run Laravel backend:
```task up``` or ```task upd```
local url: http://127.0.0.1/  
swagger: http://127.0.0.1/api/documentation  
api example: http://127.0.0.1/api/example?id=5  

run Vue.js frontend:  
```npm run dev```
Frontend url (Vue.js): http://127.0.0.1/show-api

![public/images/img.png](public/images/img.png)

Tennis API
Fill database with data:
```bash
./vendor/bin/sail artisan db:seed
