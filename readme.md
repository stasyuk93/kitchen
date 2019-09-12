Laravel v.6.0.3.
Tutorial:

clone repository and rename .env.example to .env
run command in folder project sudo docker-compose up -d --build;
run command sudo docker-compose up -d;
run command sudo docker exec -it education_junior_php bash;
run command in container:
composer install
php artisan migrate
php artisan db:seed
exit
run command in folder project npm install && npm run --dev
open http://127.0.0.1:800

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
