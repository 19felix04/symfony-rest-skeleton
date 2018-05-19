A skeleton application to build a REST-API with Symfony 4. Authentication is based on JSON Web Token.

Installation
------------

* Run `composer install`
* Build private and public key with passphrase "JWT_PASSPHRASE" from your .env-settings
    * `mkdir config/jwt`
    * `openssl genrsa -out config/jwt/private.pem -aes256 4096`
    * `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`
* Build database with `php bin/console doctrine:schema:create`
* (Execute `php bin/console doctrine:fixtures:load`) to load sample user data into database


First steps
------------
* Run `php bin/console server:run` to start build in webserver
* Post to endpoint to receive token `curl -X POST http://127.0.0.1:8000/api/token/create -d _username=martin.garrix -d _password=martin`
* Add _Authorization: Bearer {token}_ to you endpoint-request
* Test the endpoint _/api/users/me_ to get current logged in user as JSON