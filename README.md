# DevTest

This is a Laravel Application that allows you to upload a CSV with Food items and it's nutritional information and stores it in the database. It has an API to be consumed by anyone with two endpoints: one to upload the food items, and another one to list them.

An example CSV can be found in the repository. Download it [here](https://github.com/jaureguivictoria/devtest/blob/main/samplefooddata.csv);

The frontend is built using [Livewire](https://laravel-livewire.com/). It is pretty basic functionality, allowing the listing and searching of items by name.

## Configuration

The project works out of the box with Laravel Sail using Docker.

### Prerequisites

- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/docs/10.x#laravel-and-docker)
- [Docker](https://laravel.com/docs/10.x#laravel-and-docker)

### Installation

- Checkout this repo
```console
git clone git@github.com:jaureguivictoria/devtest.git
```

- Enter the new project folder
```console
cd devtest
```

- Run composer install
```console
composer install
```

- Set your own environment keys
```console
cp .env.example .env
```

- Run sail build
```console
./vendor/bin/sail build
```

- Run sail up
```console
./vendor/bin/sail up
```

- Run the migrations
```console
./vendor/bin/sail artisan migrate
```

## Frontend

Go to [localhost:80](localhost:80) to see the frontend. There is a single page which contains a paginated table of all the food items, as well as a search by name filter.


## API Documentation

The API Documentation is in Postman, and can be found here: [https://documenter.getpostman.com/view/6448092/2s93Y6rdnV](https://documenter.getpostman.com/view/6448092/2s93Y6rdnV). 


## Tests

The API Feature tests are inside the ```app/tests/``` folder.

They can be run using the following command:

```console
./vendor/bin/sail artisan test
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
