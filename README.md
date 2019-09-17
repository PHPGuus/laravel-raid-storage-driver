# Laravel RAID Storage

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