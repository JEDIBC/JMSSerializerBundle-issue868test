# JEDIBC/JMSSerializerBundle-issue868test

This project is mainly to reproduce https://github.com/schmittjoh/JMSSerializerBundle/issues/868

## Way to reproduce

* `composer update -o`
* `bin/console doctrine:migrations:migrate`
* `vendor/bin/phpunit`

With `jms/serializer-bundle` version `3.6` the tests pass.
With version `3.7` it fails.
