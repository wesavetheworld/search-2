# DO NOT USE - IN DEVELOPMENT

Search
======

AntiMattr Search is a library that provides a common interface for Search backends.

Installation
============

Add the following to your composer.json file:

```json
{
    "require": {
        "antimattr/search": "dev-master"
    }
}
```

Install the libraries by running:

```bash
composer install
```

If everything worked, the Content MongoDB Bundle can now be found at vendor/antimattr/search.

Features
========

 * Create a simplified interface for interaction with search clients
   
   ```php
   $processor->find($paginationIterator);
   $processor->create($record);
   $processor->update($record);
   $processor->delete($record);   
   ```

Additional features
===================

 * Dependency Injection ready
   * Symfony2 compliant
   * All dependency arguments are by Interface.
   * Library doesn't work exactly they way you require? Then implement your own instance of the interface and inject it in!
 * Multiple search processors can be instantiated. Use the processor factory

   ```php
   $processor = $processorFactory->getProcessor('alias', $client, $eventDispatcher, $eventFactory); 
   ```

 * Messy Controller Code? Refactor your search processing to listen on the following events
   
   ```text
   antimattr.search_processor.default.pre_create
   antimattr.search_processor.default.post_create
   antimattr.search_processor.default.pre_update
   antimattr.search_processor.default.post_update
   antimattr.search_processor.default.pre_delete
   antimattr.search_processor.default.post_delete 
   ```

Pull Requests
=============

Pull Requests - PSR Standards
-----------------------------

Please use the pre-commit hook to run the fix all code to PSR standards

Install once with

```bash
./bin/install.sh 
Copying /antimattr-search/bin/pre-commit.sh -> /antimattr-search/bin/../.git/hooks/pre-commit
```

Pull Requests - Testing
-----------------------

Please make sure tests pass

```bash
$ vendor/bin/phpunit tests
```

Pull Requests - Code Sniffer and Fixer
--------------------------------------

Don't have the pre-commit hook running, please make sure to run the fixer/sniffer manually

```bash
$ vendor/bin/php-cs-fixer fix src/
$ vendor/bin/php-cs-fixer fix tests/
