# KHmart - E-commerce Platform

A modern e-commerce platform built with Laravel, featuring product catalog, shopping cart, user authentication, order management, and KHQR payment integration.

## Features

### Step 1: Core E-commerce Features
- ✅ **Product Catalog** - Browse and search products with category filtering
- ✅ **Product Details** - Detailed product information with images and descriptions
- ✅ **Shopping Cart** - Add, update, and remove items from cart
- ✅ **Checkout Process** - Complete order placement with delivery information

### Step 2: Advanced Features
- ✅ **User Registration & Authentication** - Email-based user accounts
- ✅ **User Profile Management** - View profile, orders, and account statistics
- ✅ **KHQR Integration** - Cambodian QR payment system integration
- ✅ **Telegram Notifications** - Store owner notifications for new orders
- ✅ **Email Invoices** - Automated invoice emails to customers
- ✅ **SEO Optimized** - Meta tags, structured data, and search-friendly URLs

### Step 3: Deployment Ready
- ✅ **Production Configuration** - Environment-based settings
- ✅ **Database Migrations** - Complete database schema
- ✅ **Sample Data** - Seeded products and users for testing

## Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS
- **JavaScript**: Vue.js 3 (CDN)
- **Database**: MySQL/SQLite
- **Styling**: Tailwind CSS 4.0
- **Icons**: Font Awesome 6.4

## Database Schema

```
users (default Laravel table)
├── id, name, email, password, email_verified_at, timestamps

products
├── id, name, price, category, discount, image, description, timestamps

user_carts
├── id, user_id, product_id, qty, timestamps

orders
├── id, user_id, date_time, total, paid, delivery, timestamps

order_details
├── id, order_id, product_id, qty, price, timestamps
```

## Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL or SQLite
- Node.js & NPM (for asset compilation)

### 1. Clone the Repository
```bash
git clone <repository-url>
cd KHmart-app
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=khmart
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 5. Storage Setup
```bash
php artisan storage:link
```

### 6. Build Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

## Default Users

After running the seeder, you'll have these test accounts:

**Admin User:**
- Email: `admin@khmart.com`
- Password: `password123`

**Test Customer:**
- Email: `customer@khmart.com`
- Password: `password123`

## Features in Detail

### Product Management
- Product catalog with search and filtering
- Category-based organization
- Discount pricing support
- Image uploads (placeholder implementation)
- Related products suggestions

### Shopping Cart
- Add products to cart
- Update quantities
- Remove items
- Real-time total calculation
- Persistent cart for logged-in users

### Order Processing
- Checkout with delivery information
- Order confirmation
- Order history and tracking
- Status updates (pending, processing, shipped, delivered)

### User Management
- User registration and login
- Profile management
- Order history
- Account statistics

### Payment Integration
- KHQR payment system (placeholder)
- Cash on delivery
- Bank transfer options
- Payment status tracking

### Notifications
- Telegram notifications for store owners (placeholder)
- Email invoices for customers (placeholder)
- Order status updates

## File Structure

```
KHmart-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # User authentication
│   │   ├── CartController.php      # Shopping cart management
│   │   ├── OrderController.php     # Order processing
│   │   └── ProductController.php   # Product display
│   ├── Models/
│   │   ├── Product.php            # Product model
│   │   ├── UserCart.php           # Cart item model
│   │   ├── Order.php              # Order model
│   │   ├── OrderDetail.php        # Order item model
│   │   └── User.php               # User model (extended)
├── database/
│   ├── migrations/                 # Database schema
│   └── seeders/                    # Sample data
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php      # Main layout
│       ├── products/               # Product views
│       ├── cart/                   # Cart views
│       ├── orders/                 # Order views
│       └── auth/                   # Authentication views
└── routes/
    └── web.php                     # Application routes
```

## API Endpoints

### Public Routes
- `GET /` - Home page (product catalog)
- `GET /products` - Product listing
- `GET /products/{product}` - Product details
- `GET /login` - Login page
- `GET /register` - Registration page

### Protected Routes (Auth Required)
- `GET /profile` - User profile
- `GET /cart` - Shopping cart
- `POST /cart/add` - Add to cart
- `PUT /cart/{cartItem}` - Update cart item
- `DELETE /cart/{cartItem}` - Remove from cart
- `GET /checkout` - Checkout page
- `POST /orders` - Place order
- `GET /orders` - Order history
- `GET /orders/{order}` - Order details

## Customization

### Adding New Payment Methods
1. Extend the `OrderController`
2. Add payment method logic in the `store` method
3. Update checkout view with new payment options

### Telegram Integration
1. Create a Telegram bot
2. Update `sendTelegramNotification` method in `OrderController`
3. Add bot token to `.env` file

### Email Templates
1. Create mail classes in `app/Mail`
2. Update `sendInvoiceEmail` method
3. Customize email templates in `resources/views/mail`

## Deployment

### Production Environment
1. Set `APP_ENV=production` in `.env`
2. Configure production database
3. Set up SSL certificate
4. Configure web server (Apache/Nginx)
5. Set up queue workers for notifications

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

TELEGRAM_BOT_TOKEN=your_bot_token
TELEGRAM_CHAT_ID=your_chat_id
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions:
- Email: support@khmart.com
- Phone: +855 123 456 789

## Roadmap

- [ ] Admin panel for product management
- [ ] Inventory management
- [ ] Customer reviews and ratings
- [ ] Advanced search with filters
- [ ] Wishlist functionality
- [ ] Multi-language support
- [ ] Mobile app development
- [ ] Analytics dashboard
- [ ] Bulk order processing
- [ ] Advanced shipping options
