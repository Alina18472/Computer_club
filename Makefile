key:
	php artisan key:generate

migrate:
	php artisan migrate

serve:
	php artisan serve

drop:
	php artisan migrate:rollback

controller:
	php artisan make:controller $(MODEL)Controller --api --model=$(MODEL) --requests

seed: fresh
	php artisan db:seed

fresh:
	php artisan migrate:fresh
