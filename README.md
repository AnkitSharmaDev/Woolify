# Woolify - Wool Journey Monitoring System

## About Woolify

Woolify is a comprehensive wool tracking system designed to monitor and manage the journey of wool from farms to fabric. This system ensures transparency, quality control, and efficiency in the wool industry by tracking each stage of production, processing, and distribution.

## Features

- Multi-role user authentication (Admin, Farm Owners, Processing Units, Distributors, Customers)
- Real-time wool batch tracking with QR codes
- Quality control and certification management
- Comprehensive reporting and analytics
- Interactive dashboards for each user role
- Supply chain management and monitoring

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Frontend:** Blade + Tailwind CSS + AdminLTE
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Additional Tools:** Google Maps API, QR Code Generation

## Installation

1. Clone the repository:
```bash
git clone https://github.com/AnkitSharmaDev/woolify.git
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=woolify
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations:
```bash
php artisan migrate
```

8. Start the development server:
```bash
php artisan serve
```

9. In a new terminal, start the Vite development server:
```bash
npm run dev
```

## Contributing

Please read our [Contributing Guidelines](CONTRIBUTING.md) before submitting a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please email [ankitsharma64604@gmail.com]
