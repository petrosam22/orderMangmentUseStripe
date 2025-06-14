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


 - cd orderMangmentUseStripe
2- composer install

   
3-cp .env.example .env


4-php artisan key:generate


5-Configure .env File
Update these variables:
DB_DATABASE,DB_USERNAME,DB_PASSWORD,STRIPE_KEY,STRIPE_SECRET,


 6-php artisan migrate
 
7-Link Storage (for image/video uploads)
php artisan storage:link
Import Postman Collection
Select postman_collection.json from the root directory of this project


