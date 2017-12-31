[![Build Status](https://travis-ci.org/roundpartner/backup-service.svg?branch=master)](https://travis-ci.org/roundpartner/backup-service)
# Backup Service
Service for generating back ups

## Usage

### Excel
Get Excel Workbook as a string
```php
$result = ExcelFactory::asString($input);
```
This can then be outputted as a file
```php
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: inline; filename="workbook.xlsx"');
```

## Clean Code

```bash
./vendor/bin/phpcbf --standard=psr2 ./src
./vendor/bin/phpcs --standard=psr2 ./src
```
