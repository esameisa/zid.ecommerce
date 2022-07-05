# E-commerce

-   Visitors can register/login either as merchants or end consumers.
-   Merchants can set their store name.
-   Merchants can decide if the VAT is included in the products price or should be calculated from the products price.
-   (optional) Merchants can set shipping cost
-   Merchants can set VAT percentage in case the VAT isn’t included in the product’s price.
-   Merchants can add products with multilingual names and descriptions and prices.
-   Merchants can end-consumers to add products to their carts.
-   Calculate the cart’s total considering these subtotals:
    -   Cart’s products prices.
    -   Store VAT settings.
    -   (optional) Store shipping cost.

# Requirements

-   php 8.0
-   composer

# Installation

```sh
composer install
configure .env vars [cp .env.example .env, php artisan key:generate]
php artisan migrate --seed
```

# Contact
- Email: esameisa12345@gmail.com
- Phone: +201098950608
- LinkedIn: [@esameisa](https://www.linkedin.com/in/esameisa/)