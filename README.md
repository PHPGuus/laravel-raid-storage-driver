# Laravel RAID Storage

[![Latest Version on Github](https://img.shields.io/github/v/tag/phpguus/laravel-raid-storage-driver?style=plastic)](https://github.com/phpguus/laravel-raid-storage-driver)
[![Latest version on Packagist](https://img.shields.io/packagist/v/phpguus/laravel-raid-storage-driver?style=plastic)](https://packagist.org/packages/phpguus/laravel-raid-storage-driver)
[![StyleCI](https://styleci.io/repos/209052284/shield?branch=master&style=plastic)](https://styleci.io/repos/209052284)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/phpguus/laravel-raid-storage-driver?style=plastic)](https://img.shields.io/scrutinizer/quality/g/phpguus/laravel-raid-storage-driver)
[![Total Downloads](https://img.shields.io/packagist/dt/phpguus/laravel-raid-storage-driver?style=plastic)](https://packagist.org/packages/phpguus/laravel-raid-storage-driver)

laravel-raid-storage-driver provides encapsulation of the
[flysystem-raid](https://github.com/phpguus/flysystem-raid) package for Laravel
applications.

## Installation

Require the package using composer

```bash
composer require phpguus/laravel-raid-storage-driver
```

## Usage

In `config/filesystems.php`, you can now create a disk (in the `disks` subarray)
that has the "raid" driver.

```php
'redundantStorage' => [
    'driver' => 'raid',
    'raidLevel' => 1,
    'disks' => [
         'diskOne', 'diskTwo', 'diskThree'
    ];
];
```

This allows to use the disk as simple as in

```php
Storage::disk('redundantStorage')->write('myfile.txt', 'Something!');
```

... or in case you are handling uploaded files:

```php
$file->store('', 'redundantStorage');
``` 

## Contributing
Pull requests are welcome. For major changes, please open an issue first to
discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](./LICENSE.md)