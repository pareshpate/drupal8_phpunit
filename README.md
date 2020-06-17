# Drupal 8 (with PHPUnit)

### Installation

To install the drupal 8 with dependencies for PHPUnit.
Install [Composer](https://getcomposer.org/) and run composer install (or try composer update on an existing D8 root).

```sh
$ git clone git@github.com:pareshpate/drupal8_phpunit.git
$ cd drupal8_phpunit
$ composer install
```
The above composer install command will install drupal 8 recommended version with PHP Unit 7 and other dependencies,

### Configure PHPUnit
PHPUnit stores configuration in the phpunit.xml file. Drupal comes with a sample version of this, core/phpunit.xml.dist, which you should copy to get started however, you will find a phpunit.xml with in the root folder of the repository.

Where you place this depends on your workflow:

- The PHPUnit executable expects to find the phpunit.xml file in the current directory. This can be overridden with the -c option.
- If you are using Composer to manage Drupal core, then updating core will overwrite the core/ folder and delete yourphpunit.xml file.

In phpunit.xml make the following changes:

- Set the SIMPLETEST_BASE_URL variable to the URL of your site.
- Set the SIMPLETEST_DB variable to point to the URL of your Drupal database.
- If you are placing phpunit.xml somewhere other than core, change the value of the phpunit tag's 'bootstrap' attribute to reflect the new location.
- For kernel and functional tests, set the BROWSERTEST_OUTPUT_DIRECTORY.
```sh
<phpunit bootstrap="web/tests/bootstrap.php" colors="true"
         beStrictAboutTestsThatDoNotTestAnything="true"
         beStrictAboutOutputDuringTests="true"
         beStrictAboutChangesToGlobalState="true"
         checkForUnintentionallyCoveredCode="false"
         printerClass="\Drupal\Tests\Listeners\HtmlOutputPrinter">

<php>
  <!-- Set error reporting to E_ALL. -->
  <ini name="error_reporting" value="32767"/>
  <!-- Do not limit the amount of memory tests take to run. -->
  <ini name="memory_limit" value="-1"/>
  <!-- Example SIMPLETEST_BASE_URL value: http://localhost -->
  <env name="SIMPLETEST_BASE_URL" value="http://drupal8.localhost"/>
  <!-- Example SIMPLETEST_DB value: mysql://username:password@localhost/databasename#table_prefix -->
  <env name="SIMPLETEST_DB" value="mysql://drupal8:drupal8@localhost/drupal8"/>
  <!-- Example BROWSERTEST_OUTPUT_DIRECTORY value: /path/to/webroot/sites/simpletest/browser_output -->
  <env name="BROWSERTEST_OUTPUT_DIRECTORY" value="web\sites\default\files\simpletest"/>
</php>
</phpunit>
```
- If you want to add the custom testsuite profile, you can add it as per below,
```sh
    <testsuite name="sph_profile">
      <directory>web/modules/custom/sph_config</directory>
    </testsuite>
```
### Custom Module
Copy the module custom/. to web/modules/custom/.

### Running tests
To run the tests of custom module "sph_config":
```sh
$ cd drupal8_phpunit
$ vendor/bin/phpunit --testsuite sph_profile
```
Run one specific test for entire module
```sh
$ cd drupal8_phpunit
$ vendor/bin/phpunit web/modules/custom/sph_config
```
Run one specific test for specific the file
```sh
$ cd drupal8_phpunit
$ vendor/bin/phpunit web/modules/custom/sph_config/tests/src/Kernel/Form/SPHConfigFormTest.php
```
You can also run the tests through Testing module (simpletest).

