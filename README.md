# Installation
From host machine
```
docker-compose up -d

docker exec -it cushon_app bash
```
Then, from within container
```
composer install

vendor/bin/phinx migrate && vendor/bin/phinx seed:run

vendor/bin/codecept run
```


# Design considerations

* Even though the spec suggested we keep the retail customer investment code separate from the employer customer investment code, the account and fund code is not aware of the concept of a retail customer, so that can be reused for other types of account holders. It is better to have one, centralised, well-tested subsystem to handle funds.
* The codebase is not aware of any specific framework (PSR-15 request handlers + PSR-7 requests)
* An account can be made of many funds, in anticipation for the future requirement mentioned
* The fund balance summary code could be done in the database, but I wanted to do a bit of work in PHP to demonstrate a class that isn't just an entity
* Dependency injection everywhere makes everything testable
* Used event sourcing to derive account balance, so it is all traceable in the database
* Used the moneyphp/money library to avoid floating point issues when dealing with money
* Code that is responsible for presenting data is separated from code that is responsible for modelling data - one can change without breaking lots of unrelated code
* Favoured composition and interfaces over inheritance where possible to allow for more decoupled code
* Database schema evolution and test data is versioned to improve testability and development workflows
* A Fund is currently an enum with one entry. Originally I made Fund an interface, but the concrete classes didn't add much, so I changed it to the enum. If the model evolves in such a way that Funds become a bigger component, then it may benefit from switching this back.

# Not implemented

* Didn't implement all the entities represented in the DB tables
* Customer PUT deposit endpoint would be a good next thing to implement
* Validation / ACL checks
* Supporting additional currencies
* Defining business rules in an OO way, i.e. CustomerCanAddFundCheck
* Authentication
* More unit tests for edge-cases
* Test naming could be better