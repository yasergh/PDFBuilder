# Report Builder

Generate PDF report like (invoice, receipt ) for laravel

## Requirement
* php >= 5.4.0
* Mpdf/Mpdf
* illuminate/support
* illuminate/view
    
----
    
## Install with composer

```bash
composer require snono/pdf-builder
```




## Publish the Configration 

```bash
php artisan vendor:publish 
```



Example Usage:
 First you need add import class ReportBuilder
 
```php
use Snono\PDFBuilder\Builder\Classes\PDFBuilder;
```



see example sample code blow

```php

$invoice = PDFBuilder::make()
            ->setTemplate('default')
            ->setData($data)  
            ->show();
```
### Configuration
to change default configuration of PDFBuilder update file `pdf.conf` in config directory of laravel project   
### Methods
#### Setting Template
Use **setTemplate**() to set HTML template blade for laravel the default path in resources/view/pdf-builder

##### Example
```php
$pdf =  PDFBuilder::make()
    ->setTemplate('pdf')
    ->setData($data)
    ->show()
```  

#### Setting CSS for template 
Use **setCssUrls**() to set array of url string to css stylesheet files 

#####  Example

```php
$pdf =  PDFBuilder::make()
    ->setCssUrls(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'))
    ->setTemplate('pdf')
    ->setData($data)
    ->show()
```

#### Setting Directionality 
Use **setDirectionality**() to ser direction of language take string option ('ltr' OR 'rtl')

##### Example

```php
$pdf =  PDFBuilder::make()
    ->setCssUrls(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'))
    ->setTemplate('pdf')
    ->setData($data)
    ->setDirectionality('rtl')
    ->show();
```

#### Setting Header/Footer For the whole document
Use **setFooter**() and/or **SetHeader**() to set header/footer before writing the document ,The text sting defines three stings divided by `|` which will set a header at the left/centre/right margin of the page

##### Example
```php
$pdf =  PDFBuilder::make()
    ->setCssUrls(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'))
    ->setTemplate('pdf')
    ->setHeader('Document Title')
    ->setFooter('Document Title|{PAGENO}|{DATE j-m-Y}')
    ->setData($data)
    ->setDirectionality('rtl')
    ->show();
```

#### Set Header/Footer from HTML string for the whole document
Use setHTMLHeader() and/or setHTMLFooter() to set HTML headers/footers before writing to the document.
##### Description
void **setHTMLHeader** ( string $html [, string $side [, boolean $write ]]) 

void **setHTMLFooter** ( string $html [, string $side [, boolean $write ]])

##### Parameters
$header
  This parameter specifies the content of the page header as a string of valid HTML code.

   Default: BLANK

$side
   Specify whether to set the header for ODD or EVEN pages in a DOUBLE-SIDED document.

   Values (case-sensitive)

   'O' - set the header for ODD pages

   'E' - set the header for EVEN pages

Default: BLANK, which sets 'O'

$write
    If true it forces the Header to be written immediately to the current page. Use if the header is being set after the new page has been added.

   Default: false
   
#### Generate Pdf file    
Finalise the document and send it to specified destination , you can use one method below
```php
 $pdf->download($filename)
``` 
send to the browser and force a file download with the name given by $filename

```php
$pdf->show($filename) 
```
send the file inline to the browser.
```php
$pdf->save( $filename) 
```
save to a local file with the name given by $filename (may include a path).
```php
$result = $pdf->toString()
```
return the document as a string.

