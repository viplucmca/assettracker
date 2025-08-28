# Asset Tracker

A comprehensive Laravel-based asset management system designed for business entities to track, manage, and maintain their assets with document management and business intelligence features.

## 🚀 Features

### Core Asset Management
- **Multi-Type Asset Support**: Cars, Houses (Owned/Rented), Warehouses, Land, Offices, Shops, Real Estate
- **Asset Lifecycle Tracking**: Acquisition, maintenance, insurance, registration, and disposal
- **Financial Tracking**: Acquisition costs, current values, rental income, and depreciation
- **Due Date Management**: Registration renewals, insurance renewals, service schedules, council rates, land tax

### Business Entity Management
- **Entity Types**: Sole Trader, Company, Trust, Partnership
- **Compliance Tracking**: ABN, ACN, TFN, ASIC renewal dates
- **Contact Management**: Entity persons with multiple roles and responsibilities
- **Document Storage**: Centralized document management for all entities

### Document Management
- **Multi-Format Support**: Document storage for various file types (images, documents, spreadsheets)
- **Centralized Storage**: Organized document management for all business entities
- **Secure Access**: Role-based access control for document viewing and management

### Financial Management
- **Bank Account Integration**: Multiple bank accounts per business entity
- **Transaction Tracking**: Manual and automated transaction entry
- **Receipt Management**: Digital receipt storage and categorization
- **Transaction Management**: Manual transaction entry and tracking

### Security & Authentication
- **Two-Factor Authentication**: Enhanced security with email-based 2FA
- **Role-Based Access Control**: Granular permissions for different user types
- **Secure File Storage**: Encrypted document storage with access controls

### Cloud Storage Integration
- **AWS S3 Integration**: Secure cloud storage for documents and receipts
- **AWS S3 Support**: Alternative cloud storage option
- **Local Storage**: Fallback to local storage when needed

### Reminder System
- **Smart Notifications**: Due date reminders for all asset types
- **Customizable Alerts**: Configurable reminder frequencies and priorities
- **Bulk Operations**: Mass reminder management and completion

### Communication Tools
- **Email Templates**: Pre-built templates for common communications
- **Contact Lists**: Organized contact management for business relationships
- **Email Templates**: Pre-built templates for common communications

## 🏗️ Architecture

### Technology Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL with comprehensive migrations

- **Cloud Storage**: AWS S3 support
- **Authentication**: Laravel Breeze with custom 2FA

### Key Models
- **BusinessEntity**: Core business unit management
- **Asset**: Multi-type asset tracking with type-specific fields
- **EntityPerson**: People associated with business entities
- **Document**: Centralized document management
- **Transaction**: Financial transaction tracking
- **Reminder**: Due date and task management
- **BankAccount**: Banking information and statements

### Services

- **AWS S3 Integration**: Cloud storage integration
- **FileHelper**: File management utilities
- **UrlHelper**: URL generation and validation

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.0 or higher
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL 13+

- AWS S3 credentials (for cloud storage)

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd assettracker
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure environment variables**
   ```env
   # Database
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=assettracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password



   # AWS S3
AWS_ACCESS_KEY_ID=your_aws_key
AWS_SECRET_ACCESS_KEY=your_aws_secret
AWS_DEFAULT_REGION=your_aws_region
AWS_BUCKET=your_bucket_name

   # AWS S3 (optional)
   AWS_ACCESS_KEY_ID=your_aws_key
   AWS_SECRET_ACCESS_KEY=your_aws_secret
   AWS_DEFAULT_REGION=your_aws_region
   AWS_BUCKET=your_bucket_name
   
   # Gmail API (for Emails section)
   GMAIL_ENABLED=false
   GMAIL_CLIENT_ID=
   GMAIL_CLIENT_SECRET=
   GMAIL_REFRESH_TOKEN=
   GMAIL_USER_EMAIL=
   GMAIL_LABEL=INBOX
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

### Emails Section

- Access via Dashboard → Emails
- Sync Gmail: uses credentials above. When `GMAIL_ENABLED=false` or creds missing, a dummy sync runs.
- Upload emails: Emails → Upload; accepts `.eml`/`.msg` files (10MB each). Files stored under `storage/app/emails/uploads/{user_id}` and listed as `uploaded`.

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🚀 Quick Start

1. **Register a new account** at `/register`
2. **Complete two-factor authentication** setup
3. **Create your first business entity** with company details
4. **Add assets** (cars, properties, equipment)
5. **Upload documents** and manage them securely
6. **Set up reminders** for important due dates
7. **Track transactions** and manage bank accounts

## 📱 Usage Examples

### Creating a Business Entity
```php
// Business entity with company details
$entity = BusinessEntity::create([
    'legal_name' => 'Acme Corporation Pty Ltd',
    'entity_type' => 'Company',
    'abn' => '12345678901',
    'acn' => '123456789',
    'registered_address' => '123 Business St, Sydney NSW 2000'
]);
```

### Adding an Asset
```php
// Car asset with registration and insurance
$asset = $entity->assets()->create([
    'asset_type' => 'Car',
    'name' => 'Company Fleet Vehicle',
    'registration_number' => 'ABC123',
    'registration_due_date' => '2024-12-31',
    'insurance_due_date' => '2024-06-30'
]);
```



## 🔧 Development

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
```

### Code Quality
```bash
# Code formatting
./vendor/bin/pint

# Static analysis
./vendor/bin/phpstan analyse
```

### Development Commands
```bash
# Start development environment
composer run dev

# Monitor logs
php artisan pail

# Queue processing
php artisan queue:work
```

## 📊 Database Schema

The application uses a comprehensive database schema with the following key tables:

- **business_entities**: Core business information
- **assets**: Multi-type asset management
- **entity_persons**: People and roles
- **documents**: File storage and metadata
- **transactions**: Financial records
- **bank_accounts**: Banking information
- **reminders**: Due date management
- **notes**: General notes and comments

## 🔐 Security Features

- **Two-Factor Authentication**: Email-based 2FA for enhanced security
- **CSRF Protection**: Built-in Laravel CSRF token validation
- **SQL Injection Prevention**: Eloquent ORM with parameterized queries
- **File Upload Security**: Secure file handling and validation
- **Role-Based Access**: Granular permission system

## 🌐 API Endpoints

The application provides RESTful API endpoints for:

- Business entity management
- Asset operations
- Document uploads and retrieval
- Transaction processing
- Reminder management

## 📈 Performance

- **Database Optimization**: Efficient queries with proper indexing
- **File Caching**: Intelligent file caching and storage
- **Queue Processing**: Background job processing for heavy operations
- **Asset Compilation**: Optimized frontend asset building

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:

- **Documentation**: Check the Laravel documentation for framework-specific questions
- **Issues**: Report bugs and feature requests through GitHub Issues
- **Community**: Join Laravel community forums and discussions

## 🔮 Roadmap

- **Mobile App**: Native mobile applications for iOS and Android
- **Advanced Analytics**: Business intelligence and reporting dashboard
- **Integration APIs**: Third-party service integrations
- **Multi-Tenancy**: Support for multiple organizations
- **Business Intelligence**: Enhanced reporting and analytics

---

**Built with ❤️ using Laravel and modern web technologies**
