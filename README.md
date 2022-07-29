
# Integerate Stripe Payment Gateway In Laravel

This tutorial is about how to integerate with Stripe using laravel in Urdu/Hindi

## Url

Complete Project Source uploaded at Git

## Stripe Website

Go to stripe website and login to Stripe_developer

```bash
    * https://dashboard.stripe.com/test 
```


## Stripe Publishable Key and Secret

Go to stripe website and login to Stripe_developer

```bash
    * https://dashboard.stripe.com/test 

    * Copy Publishable_Key and Stripe_Secret located at bottom right
```

## Env

Go to env file and paste **Publishable_Key** and **Stripe_Secret**

```bash
    * StripeKey = "YOUR STRIPE PUBLISHABLE KEY"

    * StripeSecret = "YOUR STRIPE SECRET KEY"

```


## Make a laravel project

Install Laravel project by running this command in cmd

```bash
    * composer create-project --prefer-dist laravel/laravel StripePayment 
```

## Installation Stripe Package

Install Stripe Package by running this command in cmd

```bash
    * composer require stripe/stripe-php 
```

## Route

Make Following route files in [routes/web/]

```bash
    * Route::post('place-order-with-stripe','FrontendCheckoutController@stripeorder');
```

## Controller

Make a controller by running this command

```bash
    * php artisan make:controller FrontendCheckoutController
```

## Use

Use these lines at bottom of namespace

```bash
    * use Stripe\Charge;
    
    * use Stripe\Stripe;
```


## Methods

Make Methods in FrontendCheckoutController

```bash
    * stripeorder
```

## Finally! make payment by running this command in Compand Prompt 

```bash
    * php artisan serve
```

## Run this URL 

```bash
    * 127.0.0.1:8000/
```