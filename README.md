![Statamic](https://flat.badgen.net/badge/Statamic/5.0+/FF269E) ![Packagist version](https://flat.badgen.net/packagist/v/aerni/font-awesome/latest) ![Packagist Total Downloads](https://flat.badgen.net/packagist/dt/aerni/font-awesome)

# Font Awesome
This Statamic addon features an icon fieldtype to browse and select Font Awesome 6.x icons. It also comes with a Tag to output selected icons in your template.

## Installation
Install the addon using Composer:

```bash
composer require aerni/font-awesome
```

You may publish the config of the package:

```bash
php please vendor:publish --tag=font-awesome-config
```

## Configuration
You may choose between using a Kit or hosting Font Awesome yourself.

### Kit Driver
If you want to use a Kit, make sure you set the `driver` option in the config to `kit`:

```php
'driver' => 'kit'
```

Next, add your `API Token` and `Kit Token` to your `.env` file:

```env
FA_API_TOKEN=************************************
FA_KIT_TOKEN=************************************
```

### Local Driver
If you would rather host Font Awesome yourself, you may use the `local` driver:

```php
'driver' => 'local'
```

Next, download [Font Awesome (For The Web)](https://fontawesome.com/download) and place the `metadata` and `css` directories in the locations defined in the config:

```php
'local' => [
    'metadata' => resource_path('fonts/fontawesome/metadata'),
    'css' => '/fonts/fontawesome/css/all.min.css',
],
```

#### Metadata
The files in the `metadata` directory are required to get the information about the icons. I recommend placing the metadata in `resources/fonts/fontawesome/metadata` as these files don't need to be publicly accessible. 

#### CSS
The `css` config option defines the public path to the stylesheet that will be loaded in the Control Panel. The stylesheet must be placed in your `public` directory.

> Hint: The CSS will only be used in the Control Panel. You will still have to add the stylesheet to your frontend layout.

## Usage

### Fieldtype

Add the `Font Awesome` Fieldtype to a Blueprint or Fieldset. The Fieldtype provides a config option that allows you to make only certain icon styles available for selection.

### Tag

If you're using the `kit` driver, add the following Tag to your layout's `<head>` to render the Font Awesome script.

```antlers
{{ font_awesome:kit }}
```

Render an icon by using the handle of a Font Awesome field as the wildcard method.

```antlers
{{ font_awesome:icon_field }}
```

You may also use the shorter tag alias instead.

```antlers
{{ fa:kit }}

{{ fa:icon_field }}
```

## Credits
Developed by [Michael Aerni](https://www.michaelaerni.ch)
