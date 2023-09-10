# EcoSwap

## Description

EcoSwap is a sustainability-focused platform for the exchange and barter of goods and services. Instead of buying new products or discarding unused items, users can trade them to give these items a second life.

## Installation

### Prerequisites

- PHP 7.4 or higher
- Composer (to manage dependencies)
- Symfony CLI (to run Symfony commands)

### Installation Steps

1. Clone this repository to your local machine:

```shell
git clone https://github.com/julienbutty/local-swap.git
```

2. Install dependencies by running the following command in the project directory:

```shell
composer install
```

3. Configure the database by editing the `.env` file to match your database configuration.

4. Launch Docker containers

```shell
docker-compose up -d
```

5. Create the database and run migrations:

```shel
bin/console doctrine:database:create
bin/console doctrine:migration:migrate
```

6. Access the application in your browser by visiting [http://localhost:8080](http://localhost:8080).

## Usage

- **Sign Up and Login**: Create an account or log in to your existing account.
- **List of Items**: Add items you want to trade, with photos and descriptions.
- **Search and Filters**: Easily find what you're looking for using search and filtering features.
- **Credit System**: Earn credits for the items you offer and use them to "purchase" other items on the platform.
- **Trust Profiles**: Rate and leave comments about other users after an exchange to build trust in the community.
- **Community Forum**: Share sustainability tips, ask questions to the community, and share success stories.

## Contribution

We welcome contributions to EcoSwap! If you'd like to contribute, please follow these steps:

1. Fork the repository.
2. Create a branch for your feature (`git checkout -b amazing-feature`).
3. Commit your changes (`git commit -m 'Add an amazing feature'`).
4. Push to your fork (`git push origin amazing-feature`).
5. Open a pull request to the main branch of the project.

## License

EcoSwap is just a project for fun


