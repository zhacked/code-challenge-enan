# code-challenge-enan
This challenge requires you to create an API that will import data from a third party API and be able to display it. This challenge should demonstrate how you structure your code and apply any appropriate design patterns. Please read through everything before starting.

# Features:
● Import customers from a 3rd party data provider and save to the database.
● Display a list of customers from the database.
● Select and display details of a single customer from the database.

# Framework
• Use Laravel or Symfony to write the following backend services in a single
project.
Data Importer
● Fetch and store a minimum of 100 users from this data provider:
https://randomuser.me/api. See official documentation for fetching
multiple users API Documentation
● The user data retrieved from the data provider must be stored in a SQL
Type database and must be called customers table.
● Only import customers that have the Australian nationality, Refer to
API Documentation.
● The importer service should be constructed in a way that it can be used in any
part of the Application -Services or Controllers such as API controllers,
Command, Job, etc.
● The importer should be designed so the data provider could be replaced later
with minimal impact on the codebase.
● Create a console command to be able to execute the importer.
● If the data provider returns customer that already exist by email - Update
the customer.
