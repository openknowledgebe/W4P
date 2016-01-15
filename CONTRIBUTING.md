# How to contribute

Thanks for taking the time to take a look at contributing to W4P.

## Bug reports

You can report bugs on the [GitHub issues](https://github.com/openknowledgebe/W4P/issues) page.

## Feature additions

You can add a feature to W4P yourself, but it might be useful to discuss the topic first before starting development (if you intend for your changes to be applied to this repository). You are free to fork and forget, but meaningful changes are always welcomed via pull request.

Remember, any additions or bug fixes **must have all tests passing**, with **new tests for new functionality**.

## Unit tests

Of course, W4P contains unit tests. There are two test suites included in the application:

* setup: Creates the database and does migrations. Also tests the setup wizard.
* application: Tests the W4P application (pledges, payments, etc). Assumes you ran 'setup' test suite at least once. (Does not do migrations etc.)

By running `phpunit`, you will run both suites in the correct order (first 'setup', then 'application') and run all tests.

**For any given pull request, all unit tests should pass.**

## Licensing

By opening a pull request, you agree that your code is licensed under the same license as the project. (This ensures that all our code remais open-source.)