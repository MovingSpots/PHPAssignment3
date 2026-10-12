# PHPAssignment3 SportsPro Technical Support

## MWD4A PHP and MySQL Development Assignment 3

This project completes the four projects listed in the Assignment 3 rubric using the supplied SportsPro `tech_support` database:

- Project 6-5 Create Incident
- Project 7-1 Use a Drop-down List
- Project 8-1 Improve Controller Code
- Project 10-1 Improve Date Handling

The assignment instructions specify a new repository named `PHPAssignment3`. The supplied rubric template says `PHPAssignment2` in Criteria 1, which appears inconsistent with the assignment number. This solution follows the assignment instructions and uses `PHPAssignment3`. Confirm the name with Professor Doug Jasper if required.

## Rubric mapping

| Project | Required behaviour | Where implemented |
| --- | --- | --- |
| 6-5 Create Incident | Retrieve a customer by email | `incident_manager/index.php`, `model/customer_db.php` |
| 6-5 Create Incident | Show only products registered by that customer | `model/registration_db.php`, `incident_manager/incident_create.php` |
| 6-5 Create Incident | Insert a new incident and display success | `model/incident_db.php`, `incident_manager/incident_success.php` |
| 7-1 Drop-down List | Retrieve every country from `countries` | `model/country_db.php` |
| 7-1 Drop-down List | Select the customer’s current country | `customer_manager/customer_update.php` |
| 7-1 Drop-down List | Update the selected country/customer record | `customer_manager/index.php`, `model/customer_db.php` |
| 8-1 Controller Code | Route actions with `switch` statements | All three project `index.php` controllers |
| 10-1 Date Handling | Accept standard release-date formats | `product_manager/index.php` uses `date_create()` |
| 10-1 Date Handling | Display dates without time and leading zeros | `product_manager/product_list.php` uses format `n-j-Y` |

## Application structure

```text
PHPAssignment3/
├── index.php
├── config.php
├── main.css
├── README.md
├── customer_manager/
│   ├── index.php
│   ├── customer_search.php
│   └── customer_update.php
├── incident_manager/
│   ├── index.php
│   ├── customer_lookup.php
│   ├── incident_create.php
│   └── incident_success.php
├── product_manager/
│   ├── index.php
│   ├── product_add.php
│   └── product_list.php
├── model/
│   ├── database.php
│   ├── country_db.php
│   ├── customer_db.php
│   ├── incident_db.php
│   ├── product_db.php
│   └── registration_db.php
├── errors/
│   ├── database_error.php
│   └── error.php
├── view/
│   ├── header.php
│   └── footer.php
└── sql/
    └── tech_support.sql
```

## Install with XAMPP on macOS

1. Extract the ZIP.
2. Copy the inner `PHPAssignment3` folder into:

   ```text
   /Applications/XAMPP/xamppfiles/htdocs/
   ```

3. Confirm that this file exists:

   ```text
   /Applications/XAMPP/xamppfiles/htdocs/PHPAssignment3/index.php
   ```

4. Start **Apache** and **MySQL** in XAMPP Manager.
5. Open `http://localhost/phpmyadmin/`.
6. Select **Import**, choose `PHPAssignment3/sql/tech_support.sql`, and click **Import/Go**.
7. Open `http://localhost/PHPAssignment3/`.

The provided SQL script recreates the complete `tech_support` database and its sample data. Importing it again resets changes made during testing.

### Database credentials

The supplied SQL creates the classroom account used by `model/database.php`:

```text
Database: tech_support
Username: ts_user
Password: pa55word
Host: 127.0.0.1
```

If phpMyAdmin reports an error only on the final `GRANT` statement, your MySQL/MariaDB version may use different account-creation syntax. For local XAMPP testing, either create `ts_user` with the listed password and grant access to `tech_support`, or temporarily change `model/database.php` to the local `root` account and its configured password.

The folder must remain named `PHPAssignment3`. If you deliberately use another folder name, update `BASE_URL` in `config.php`.

## How each project works

### Project 6-5 Create Incident

1. The controller displays the Get Customer page.
2. The user enters a customer email address.
3. A prepared query retrieves the customer.
4. A joined query retrieves only products in `registrations` for that customer.
5. The user selects one registered product and enters a title and description.
6. The server verifies the selected product is registered to that customer.
7. A new row is inserted into `incidents` with `NOW()` as `dateOpened`, a null technician, and a null close date.
8. The success page displays the new incident ID and product code.

Test with:

```text
kenzie@jobtrak.com
```

This sample customer has multiple registered products.

### Project 7-1 Country Drop-down

1. Search for a customer by last name.
2. Select the customer from the result table.
3. The application retrieves all rows from `countries`.
4. The matching `<option>` receives the `selected` attribute.
5. Selecting another country and clicking **Update Customer** updates `customers.countryCode`.

Test with the last name:

```text
Quinn
```

### Project 8-1 Switch Controllers

The following controllers obtain an `action` from POST or GET and route the request with `switch`:

- `product_manager/index.php`
- `customer_manager/index.php`
- `incident_manager/index.php`

This replaces long action-selection `if/else` chains while keeping related actions together.

### Project 10-1 Date Handling

The Add Product page accepts standard dates such as:

```text
October 7, 2026
2026-10-07
10/7/2026
```

PHP parses the value with `date_create()` and stores the MySQL-compatible format. The Product List displays it with `n-j-Y`, such as `10-7-2026`, without a time or leading zeros.

## Complete test checklist

### Product Manager

1. Open **Manage Products** and confirm the supplied products appear.
2. Confirm release dates display like `3-1-2019`, with no time.
3. Select **Add Product**.
4. Enter code `TEST10`, name `Test Product`, version `1.0`, and date `October 7, 2026`.
5. Confirm the product appears with date `10-7-2026`.
6. Delete `TEST10` and confirm it disappears.
7. Submit the add form with a required field blank and confirm validation appears.

### Customer Manager

1. Search for `Quinn`.
2. Select Kenzie Quinn.
3. Confirm United States is selected in the Country drop-down.
4. Change the country, update, search again, and confirm the change.
5. Change the country back to United States to restore the sample record.

### Incident Manager

1. Search for `kenzie@jobtrak.com`.
2. Confirm only Kenzie’s registered products appear in the drop-down.
3. Choose a product, add a title and description, and create the incident.
4. Confirm the success page displays the new incident ID and product code.
5. In phpMyAdmin, browse `incidents` and verify the inserted row.
6. Try an unknown email and confirm the friendly error message.

### Controller evidence

Open each controller in VS Code and show the `switch ($action)` statement. This provides clear evidence for Project 8-1.

## GitHub repository setup

Create a new, empty public GitHub repository named `PHPAssignment3`. Do not add a GitHub README, `.gitignore`, or license during creation because the local project already contains files.

Open the VS Code terminal inside the local `PHPAssignment3` folder and run:

```bash
git init
git branch -M main
git add .
git commit -m "Complete MWD4A Assignment 3 SportsPro projects"
git remote add origin https://github.com/MovingSpots/PHPAssignment3.git
git push -u origin main
```

Verify that the repository contains all project folders and `sql/tech_support.sql`:

```text
https://github.com/MovingSpots/PHPAssignment3
```

Submit this Git URL:

```text
https://github.com/MovingSpots/PHPAssignment3.git
```

If `origin` already exists but is incorrect, use:

```bash
git remote set-url origin https://github.com/MovingSpots/PHPAssignment3.git
```

Do not force-push. If GitHub already contains a commit, pull it safely with `git pull origin main --no-rebase --allow-unrelated-histories`, resolve any reported conflicts, commit the merge, and then push.

## Suggested submission message

Dear Professor Jasper,

I have completed MWD4A Assignment 3. My SportsPro Technical Support application implements Project 6-5 Create Incident, Project 7-1 Country Drop-down, Project 8-1 Switch-based Controllers, and Project 10-1 Improved Date Handling.

Repository: https://github.com/MovingSpots/PHPAssignment3.git

Thank you,  
Selvaraj Thyagarajan
