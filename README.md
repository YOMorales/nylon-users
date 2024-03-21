# Nylon Users

## Installation

### Clone this repository
`git clone git@github.com:YOMorales/nylon-users.git`

`cd nylon-users`

### Then run these commands

`cp .env.example .env`
(Optional: Put a password in the DB_PASSWORD env variable if desired).

---

(Optional: If your computer doesn't have php nor composer installed, run this command, which will use a small image
to install composer dependencies. More info: https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects)

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

---

`composer install`

`./vendor/bin/sail up -d`

(Before starting Sail, you should ensure that no other web servers or databases are running on your local computer).

`./vendor/bin/sail artisan key:generate`

`./vendor/bin/sail npm install`

`./vendor/bin/sail npm run dev`

`./vendor/bin/sail artisan migrate`

### Then visit these links

For the user-facing side: http://localhost/

For the admin page: http://localhost/admin/users/list

And start playing with the form fields, the admin datatable, etc.


## Developer Notes

1) I'm using Laravel 10 and not 11 because Laravel 11 was released several days ago and I havent got the chance to study it.

2) Securing SSNs in a real production app requires more work outside of the scope of this coding exercise. While I used a simple approach of just encrypting the SSNs in the db, more measures would be needed in a real app. For example, using TLS when transmitting them, having the database with the encrypted ssns in another secured server, using credentials and ACL to allow only a few authorized people to see the SSNs, only decrypting them 'on-demand' when necessary (and not just decrypting them all at once when rendering a list), and more.

3) Speaking of security, in a real production app, I would have put login/credentials for the admin page, and also CSRF tokens.

4) Again, speaking of security, bots would have a party with that form for creating users. In a real app, I would have implemented, throttling and captchas. (Or move the SSN-submission part to another page behind authentication).

5) There are more frontend things that I would have implemented if given more time: a better layout, a 'mask' for the SSN field (where it have the hyphens prefilled and the user input would be guided to enter only numbers), better frontend validations and notifications (for example, to render back error messages or success messages in a nice popup notification), etc.

6) I did the admin functionality in the same UsersController, but ideally, a separate Admin controller would have been better, for better segregation and encapsulation of code.

7) Known bugs (which couldn't be solved due to lack of time):

  * The ssn form field is supposed to have an icon for toggling the input to plain-text, but the icon is not rendering. I suspect its an issue with importing the icon set from the Vuetify libraries.
  * After disabling a user, the admin datatable doesn't refresh by itself to show that the user was disabled. This is solved by triggering an event for the datatable component to update itself.
  * Also, deactivating a user simply soft-deletes it and is removed from the admin datatable. This is not ideal, and a better solution is to still show the user but with a flag or indicator that it was deactivated. Finally, a button should also exist to activate the user.

8) I have written a few notes in the code, explaining some decisions I made. Search for 'DEV NOTE' to find them.

9) I would have added unit testing too. I love unit tests.

10) I added a schema dump file in: database/schemas/nylon_db_structure.sql
