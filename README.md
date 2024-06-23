## Installation

DOCKER
-  
- Run <code>docker-compose up -d --build</code>
- Wait <b><i>editor_php</i></b> container finish by checking docker logs


BUILT IN SERVER
- Create database.sqlite file in folder database
- RUN <code>composer install --ignore-platform-req=ext-fileinfo</code>
- RUN <code>copy .env.example .env</code>
- RUN <code>php artisan key:generate</code>
- RUN <code>php artisan migrate</code>
- SET <code>.env APP_URL, ONLYOFFICE_SERVER_URL, ONLYOFFICE_JWT_SECRET</code>
