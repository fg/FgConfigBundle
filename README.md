FgConfigBundle
--------

This bundle helps you to store your settings for application layer. This settings are stored based on scope such as general, user groups, user and can be accessedfrom any layer later.

An example:

Let say we have 30 quota available for Math class:

```json
{
    "id": 1,
    "scope_group_type": "labs",
    "scope_by_id": 2,
    "section": "registration",
    "name": "quota",
    "value": 30,
    "created_at" : "2015-08-13 00:00:00",
    "updated_at" : "2015-08-13 00:00:00"
}
```

1. Installation
------------
#### 1.1 Install Repository
You can install via [composer](http://getcomposer.org/download/).

```sh
composer require fg/config-bundle
```

or add to require section of `composer.json:`

```json
"fg/config-bundle": "dev-master"
```

#### 1.2 Enable Bundle in app/AppKernel.php

```php
public function registerBundles() {
    $bundles = array(
        // ...
        new Fg\Bundle\ConfigBundle\FgConfigBundle()
    );
    // ...
}
```

#### 1.3 Run migration

```sh
php app/console doctrine:schema:update --force
```

2. Usage
------------
### 2.1 Creating a ne setting
There are three different ways to create a new setting.

#### 2.1.1 By using Command Line Interface (CLI)
You can create a new setting by runnig `php app/console fg:config:create` command from cli.

#### 2.1.2 By calling create method of SettingService
You can create a new setting by calling  the create method of `SettingService` which previously passed to service container.

```php
$settingService = $this->get('fg_config.service.setting_service');
#create($name, $value, $scopeGroupType, $section, $scopeById = 0)
$setting = $settingService->create('test', 'test', 'general', 'general')
```

#### 2.1.3 By using web user interface
`http://localhost/path/to/management/setting`


### 2.2 Accessing

#### 2.2.1 Accessing from controller layer

```php
...
$settingService = $this->get('fg_config.service.setting_service');
$settingObject  = $settingService->getAllSettingByScope('quota', 'labs', 'registration', 2);
...
```

#### 2.2.2 Accessing from Twig

```twig
...
{{ get_setting('phone') }} //get setting object of name phone
{{ get_setting_value('phone') }} //get value of name phone
...
```
