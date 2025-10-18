[![PHP Code style](https://github.com/Opblaasmaatje/Line/actions/workflows/style.yml/badge.svg)](https://github.com/Opblaasmaatje/Line/actions/workflows/style.yml)
[![Php-stan](https://github.com/Opblaasmaatje/Line/actions/workflows/phpstan.yml/badge.svg)](https://github.com/Opblaasmaatje/Line/actions/workflows/phpstan.yml)
[![Tests](https://github.com/Opblaasmaatje/Line/actions/workflows/tests.yml/badge.svg)](https://github.com/Opblaasmaatje/Line/actions/workflows/tests.yml)

# Line

Discord bot for managing and tracking Old School RuneScape (OSRS) clan data, built on Laracord (Laravel Zero-based) and integrating with Wise Old Man.

Note: This README reflects the current repository state. Unknowns are explicitly marked as TODOs.

## Overview
- Tech stack: PHP 8.4, Composer, Laracord framework (Laravel Zero style), Symfony Console, PHPUnit, PHPStan, Laravel Pint, Easy Coding Standard (ECS).
- Entry point: ./laracord (CLI).
- Packaging: box.json present for PHAR builds (see Packaging section).
- Database: Laravel-style migrations supported.

## Requirements
- PHP: ^8.4
- Composer
- Extensions: Standard PHP extensions required by dependencies (see composer install for any missing ext- errors).
- Database: A supported database configured via Laravel config (e.g., SQLite/MySQL/PostgreSQL). TODO: Document the default driver used by this project.

## Setup
1. Clone the repository.
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Initialize environment:
   ```bash
   cp .env.example .env
   # Fill in required values (see Environment variables)
   ```
5. Configure your database in .env (see Laravel database configuration).
6. Run database migrations (if used by your commands):
   ```bash
   ./laracord migrate
   # or
   php laracord migrate
   ```

## Running the bot
- Start the CLI application (will run the default Laracord command or your custom commands):
  ```bash
  ./laracord
  ```
- List available commands:
  ```bash
  ./laracord list
  ```

## Scripts and developer tooling
These tools are available via Composer-installed binaries:
- Tests:
  ```bash
  ./vendor/bin/phpunit
  ```
- Static analysis (PHPStan):
  ```bash
  ./vendor/bin/phpstan analyse
  ```
- Coding standards (ECS):
  ```bash
  ./vendor/bin/ecs check
  ./vendor/bin/ecs fix   # to fix automatically
  ```

## Environment variables
From .env.example:
- APP_NAME=Laracord
- APP_ENV=development
- DISCORD_TOKEN= (Discord bot token)
- WISE_OLD_MAN_API_KEY=
- WISE_OLD_MAN_GROUP_ID=001
- WISE_OLD_MAN_GROUP_CODE=001
- PET_REVIEW_CHANNEL=

## Diagram
Data structure / ER graph:

![graph.png](graph.png)
