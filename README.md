# Leighton Quito (leighton-quito)

Awesome Motive Developer Applicant Challenge, Part 1

## 1. Project Setup

```
npm install
```

> **Requirement(s):** Node v18.16.0 or later

## 2. Install Required Tools

Run the following command(s) in the `leighton-quito` plugin folder:

```
#!bash
$ cd <path-to-wordpress>/wp-content/plugins/leighton-quito

# Install composer:
$ composer install
```

## 3. Development Scripts

### `npm run dev`

Use Webpack to build plugin scripts and styles while hot-reloading
on every change.

### `npm run tokens`

Build design tokens into `./assets/scss/_utils/_tokens.scss` file.

### `npm run test`

Runs installed unit tests.

## 4. Production Scripts

### `npm run prod`

Compiles plugin files to get them ready for release.

### `npm run release`

Mixes `npm run prod` with other tasks to prepare the plugin for release.

-   Build tokens
-   Compile assets
-   Translate plugin
-   Creates a `dist` temp folder to copy all released files and folders
-   Zips the `dist` folder including the version in the name
