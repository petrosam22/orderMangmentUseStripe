# Laravel POS System

A clean and modular Point of Sale (POS) backend built using **Laravel**, following the **SOLID principles** and **clean code architecture**. This system includes:

- Admin-authenticated product management
- Image compression on upload
- Video upload  
- Stripe integration for secure product purchases
- Repository & Service pattern for maintainability

---

## 🚀 Features
- 🔐 Admin-authenticated product management
- 🖼️ Image upload with compression
- 🎬 Video upload (FFmpeg-ready)
- 💳 Stripe payment integration for product purchases
- 🧱 Clean code: Service, Repository, Interface layers
- 🧾 Postman collection included
- 
## 📦 Installation Guide
-git clone https://github.com/petrosam22/orderMangmentUseStripe.git
 -  cd orderMangmentUseStripe
2-Install Dependencies
 composer install
3-Set Environment Variables
cp .env.example .env
php artisan key:generate
4-Configure .env File
Update these variables:
DB_DATABASE=your_database
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
 5-Run Migrations
 php artisan migrate
6-Link Storage (for image/video uploads)
php artisan storage:link
Import Postman Collection
Select postman_collection.json from the root directory of this project


