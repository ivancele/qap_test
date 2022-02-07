# QuickAdminPanel testing

Just a small project for testing and playing with QAP projects

## Quick start

- setup the .env file (with your db credentials)
- for product->photo->getUrl() ensure url is set to `http://127.0.0.1:8000` (could be my localhost)
- then run `php artisan dhe:boot-app` (you can ignore the warning if storage is already linked)
- testing accounts (already created) user: `ivan@test.com`, password: `P@ssw0rd` and `customer@test.com` also `P@ssw0rd`

## Changes made

### mods branch

- UsersTableSeeder: changed insert to create
- Added 2 more users (user role and customer role)
- Created Customer role with less permissions (a customer shoulnd't be able to add products for example)
- Default password for the 2 new accounts is P@ssw0rd
- Modified seeders files and migration files to avoid having to create test users all the time after migration reset

### req_3

I did not understand the instruction here, I am sorry, I was going to attempt it, I can still do, if you can just elaborate.

### req_4

I couldn't install the package on the document sent, due to dependency issues it seems, so I found another [Cart Package](https://github.com/darryldecode/laravelshoppingcart)

## Other notes

To avoid adding users and products all the time, I tweaked seeders, added a few commands to setup the demo shop
I made use of [Fake Store API](https://fakestoreapi.com/docs)
