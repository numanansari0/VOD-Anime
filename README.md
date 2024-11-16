
# VOD Anime Project

This is a Laravel-based project that fetches the top 100 anime using the Jikan API and displays them with a visually appealing UI. The project also includes an API endpoint to retrieve anime details by slug.
![Screenshot of the Application](/docs/main.png)

---

## Features
- Fetch top anime from Jikan API.
- Display anime in a responsive and interactive UI.
- API endpoint to fetch anime details by slug.
- Includes error handling and rate limiting.

---

## Prerequisites
To run this project, ensure you have the following installed:
- **PHP 8.3+**
- **Composer**
- **Node.js & npm**
- **MySQL 8+**
- **Laravel 11**

---

## Installation Steps

### 1. Clone the Repository
```bash
git clone https://github.com/numanansari0/vod-anime
cd vod-anime
```

### 2. Install Dependencies
Run the following commands to install PHP and JavaScript dependencies:
```bash
composer install
npm install
```

### 3. Configure the Environment
- Copy the `.env.example` file to `.env`:
  ```bash
  cp .env.example .env
  ```
- Update the `.env` file with your database credentials:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=vod_anime
  DB_USERNAME=root
  DB_PASSWORD=your_password
  ```

### 4. Generate the Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
Create the database structure:
```bash
php artisan migrate
```

### 6. Fetch Anime Data
Run the following command to fetch the top 100 anime from the Jikan API:
```bash
php artisan app:fetch-anime-data
```

### 7. Compile Frontend Assets
Compile the Tailwind CSS and other frontend assets:
```bash
npm run dev
```

---

## Running the Project

### 1. Start the Development Server
Start the Laravel development server:
```bash
php artisan serve
```
The application will be accessible at:
```
http://127.0.0.1:8000
```

### 2. API Endpoint
You can use the following API endpoint to fetch anime details by slug:
```
GET /api/anime/{slug}
```
Example:
```
http://127.0.0.1:8000/api/anime/fullmetal-alchemist
```
![Screenshot of the Application](/docs/api1.png)
![Screenshot of the Application](/docs/Api2.png)

---

## Project Structure

- `app/Console/Commands/FetchAnimeData.php` - Command to fetch anime data from the Jikan API.
- `app/Http/Controllers/AnimeController.php` - Handles API requests for fetching anime by slug.
- `resources/views` - Blade templates for the frontend.
- `routes/api.php` - API routes.
- `routes/web.php` - Web routes.

---

## Troubleshooting

### Common Issues
1. **Error: Database connection failed**:
   - Ensure your `.env` file has correct database credentials.
   - Check if MySQL is running.

2. **Error: Jikan API rate limiting**:
   - The application retries failed API requests up to 5 times with a 1-second delay. If the error persists, wait for a few minutes and try again.

3. **Error: Missing dependencies**:
   - Run `composer install` and `npm install` to ensure all dependencies are installed.

---

## License
This project is licensed under the MIT License.
