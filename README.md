![Statamic](https://flat.badgen.net/badge/Statamic/4.0+/FF269E) ![Packagist version](https://flat.badgen.net/packagist/v/aerni/font-awesome/latest) ![Packagist Total Downloads](https://flat.badgen.net/packagist/dt/aerni/font-awesome)

# Font Awesome
This Statamic addon adds a Fieldtype to easily search and select Font Awesome icons. It also comes with a Tag to output selected icons in your template. It supports Font Awesome version `5.x` and `6.x`.

## Prerequisites
To use this addon, you need a Font Awesome account. [Register here](https://fontawesome.com/start) if you don't already have one.

### API Token
You need to get your API Token. You can [generate one here](https://fontawesome.com/account).

### Kit Token
You also need to get the Token of the Kit you want to use. You can [create a Kit here](https://fontawesome.com/kits). The Kit Token is the number of the Kit, e.g. `f481b75381`.

## Installation
Install the addon using Composer:

```bash
composer require aerni/font-awesome
```

You may publish the config of the package:

```bash
php please vendor:publish --tag=font-awesome-config
```

The following config will be published to `config/font-awesome.php`:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | You can get your API Token in your Font Awesome Account Details.
    |
    */

    'api_token' => env('FA_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Kit Token
    |--------------------------------------------------------------------------
    |
    | The Token of the Kit you want to use, e.g. b121fed549.
    |
    */

    'kit_token' => env('FA_KIT_TOKEN'),

];
```

## Configuration
Add your `API Token` and `Kit Token` to your `.env` file:

```env
FA_API_TOKEN=************************************
FA_KIT_TOKEN=************************************
```

## Usage

### Fieldtype

Add the `Font Awesome` Fieldtype to a Blueprint or Fieldset. The Fieldtype provides the option to only make certain icon styles available for selection.

### Template

Add the following Tag to the `<head>` of your layout view to render the Font Awesome script.

```html
{{ font_awesome:kit }}
```

You may use a different Kit in your template using the `token` parameter.

```html
{{ font_awesome:kit token="f481b75381" }}
```

Use the following Tag to render an icon. In this example `icon` is the variable saved in your content.

```html
{{ font_awesome:icon }}
```

## Credits
Developed by [Michael Aerni](https://www.michaelaerni.ch)
