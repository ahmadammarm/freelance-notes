# Freelance Notes
<p>Hi everyone ! <br>
This is our project repository about freelance notes with downloadable invoice <br>
Hope u happy to used it</p>

### Tech in This Project

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)



<!-- Proudly created with GPRM ( https://gprm.itsvg.in ) -->
### Prerequisites
Before you begin, ensure you have met the following requirements :

* [Git](https://git-scm.com/downloads "Download Git") must be installed on your operating system.

### Clone Repository
To run in the locally, run this command on your git bash to clone this repo :
```bash
git clone https://github.com/ahmadammarm/freelance-notes.git
```

### Change Directory
Change the directory to the project :
```bash
cd freelance-notes
```

### Install the Composer
To run in the locally, run this command on your git bash to clone this repo :
```bash
composer install
```

### Configure Database in ur .env File :
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=freelance-notes
DB_USERNAME=root
DB_PASSWORD=
```

### Or you can just copy the .env.example using this command :
```
cp .env.example .env
```

### Generate your APP KEY :
```
php artisan key:generate
```

### Migrate ur Database in the Terminal :
```bash
php artisan migrate
```

### Make user from filament
```bash
php artisan make:filament-user
```

### Open in the Other Terminal and Run this Command to Run the Project:
```bash
php artisan serve
```

### Login in admin page :
```bash
Email : your_email
Password : your_password
```

Now you can accees in localhost:8000/admin
