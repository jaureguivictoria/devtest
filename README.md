# DevTest

This is a Laravel Application that allows you to upload a CSV with Food items and it's nutritional information and stores it in the database. It has an API to be consumed by anyone with two endpoints: one to upload the food items, and another one to list them.

An example CSV can be found in the repository. Download it [here](https://github.com/jaureguivictoria/devtest/blob/main/samplefooddata.csv);

## Configuration

### Prerequisites

- [Laravel](https://laravel.com/docs/10.x#laravel-and-docker)
- [Docker desktop](https://laravel.com/docs/10.x#laravel-and-docker)

### Installation

- Checkout this repo
```console
git clone git@github.com:jaureguivictoria/devtest.git
```

- Run sail build
```console
./vendor/bin/sail build
```
- Run sail up
```console
./vendor/bin/sail up
```

- Go to [localhost:80](localhost:80) to see the frontend


## API Documentation

The API Documentation can be found here: [https://documenter.getpostman.com/view/6448092/2s93Y6rdnV](https://documenter.getpostman.com/view/6448092/2s93Y6rdnV). 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
