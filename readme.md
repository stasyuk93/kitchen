Laravel v.6.0.3.
Tutorial:
1) clone repository and rename .env.example to .env
2) run command in folder project sudo docker-compose up -d --build;
3) run command sudo docker-compose up -d;
4) run command sudo docker exec -it education_junior_php bash;
5) run command in container:
6) composer install
7) php artisan migrate
8) php artisan db:seed
9) exit
10) run command in folder project npm install && npm run --dev
open http://127.0.0.1:800

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
