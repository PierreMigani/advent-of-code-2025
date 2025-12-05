# Advent of Code 2025 - PHP Project

This project provides a PHP web application framework for solving Advent of Code programming challenges.

## Features

- **Docker-based setup** with PHP 8.4 and Nginx
- **PSR-7 compliant** HTTP message implementation
- **Clean architecture** with controllers, services, and templates
- **Template engine** using League/Plates
- **Simple routing** for day-based challenges

## Architecture Overview

### Directory Structure

```
advent-of-code-2025/
├── public/               # Web root
│   └── index.php        # Application entry point
├── src/
│   ├── Controller/      # Request handlers
│   ├── Factory/         # Object factories
│   ├── Message/         # PSR-7 Request implementation
│   ├── RequestHandler/  # Request routing and handling
│   ├── Response/        # PSR-7 Response implementation
│   ├── Service/         # Day solution implementations
│   ├── Stream/          # PSR-7 Stream implementation
│   └── Uri.php          # PSR-7 Uri implementation
├── templates/           # HTML templates
├── phpdocker/          # Docker configuration
└── composer.json       # PHP dependencies

```

### How It Works

1. **Request Flow**: 
   - All requests go through `public/index.php`
   - RequestHandler routes requests to appropriate controllers
   - Controllers use services to process logic
   - Responses are rendered using Plates templates

2. **Adding a New Day**:
   - Create a new service class in `src/Service/` (e.g., `Day1.php`)
   - Implement the `DayInterface` with three methods:
     - `parse(array $inputLines): void` - Parse the input
     - `computePartOne(): mixed` - Solve part 1
     - `computePartTwo(): mixed` - Solve part 2
   - The controller factory automatically routes `/day1`, `/day2`, etc. to the corresponding service

## Prerequisites

- [Docker](https://docs.docker.com/engine/installation)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd advent-of-code-2025
   ```

2. **Install PHP dependencies** (run outside of Docker to avoid permission issues):
   ```bash
   composer install
   ```

3. **Start the Docker containers**:
   ```bash
   docker-compose up -d
   ```

4. **Access the application**:
   - Open your browser and navigate to: http://localhost:29000

## Usage

### Creating a Solution for a Day

1. **Create a service class** in `src/Service/`:

```php
<?php

namespace Service;

class Day1 implements DayInterface {
    private array $data = [];

    public function parse(array $inputLines): void
    {
        // Parse your input here
        $this->data = array_map('intval', $inputLines);
    }

    public function computePartOne(): mixed
    {
        // Your solution logic for part 1
        return array_sum($this->data);
    }

    public function computePartTwo(): mixed
    {
        // Your solution logic for part 2
        return array_sum($this->data) * 2;
    }
}
```

2. **Access the day in your browser**:
   - Navigate to http://localhost:29000/day1
   - Paste your input data
   - Submit to see results

### Customizing Result Templates

Results are displayed using templates in `templates/results/`. You can customize the default template at `templates/results/day.php` or create day-specific templates.

## Docker Commands

- **Start containers**: `docker-compose up -d`
- **Stop containers**: `docker-compose stop`
- **View logs**: `docker-compose logs`
- **Shell into PHP container**: `docker-compose exec php-fpm bash`
- **Restart containers**: `docker-compose restart`

## Development Tips

### File Permissions

If you encounter permission issues:
```bash
docker-compose exec php-fpm chown -R www-data:www-data /application
```

### Running Composer Commands

Always run composer outside of Docker to avoid permission issues:
```bash
composer install
composer require package-name
```

### Debugging

The project uses PHP 8.4 features like:
- Constructor property promotion
- Named arguments
- Union types

For debugging, you can enable Xdebug by following the instructions in `phpdocker/README.md`.

## Project Design Decisions

### PSR-7 Implementation

This project includes custom implementations of PSR-7 interfaces (Request, Response, Uri, Stream) rather than using third-party libraries. This provides:
- **Learning opportunity**: Understanding HTTP message interfaces
- **Lightweight solution**: No extra dependencies for basic HTTP handling
- **Control**: Full control over implementation details

### Simple Routing

The routing is intentionally simple - matching `/dayN` patterns to `Service\DayN` classes. This keeps the focus on solving challenges rather than building complex routing systems.

### Template Engine

Uses League/Plates for:
- Native PHP templates (no new syntax to learn)
- Automatic output escaping
- Template inheritance and sections

## Testing

To add tests, you can set up PHPUnit:

```bash
composer require --dev phpunit/phpunit
```

Then create tests in a `tests/` directory following PHPUnit conventions.

## Troubleshooting

### "Factory class not found" errors
Make sure you've run `composer install` to generate the autoloader.

### "Day service not found" errors
Ensure your service class:
- Is in the `src/Service/` directory
- Is named `DayN.php` where N is the day number
- Implements the `DayInterface`
- Uses the correct namespace: `namespace Service;`

### Port already in use
If port 29000 is in use, edit `docker-compose.yml` and change the port mapping:
```yaml
ports:
  - '8080:80'  # Use 8080 instead
```

## Contributing

Feel free to improve this project! Consider adding:
- Unit tests
- More sophisticated routing
- Database support for storing results
- API endpoints for programmatic access
- Benchmarking tools

## License

This project is provided as-is for solving Advent of Code challenges.

## Resources

- [Advent of Code](https://adventofcode.com/)
- [PHP-FIG PSR-7 Documentation](https://www.php-fig.org/psr/psr-7/)
- [League/Plates Documentation](https://platesphp.com/)
