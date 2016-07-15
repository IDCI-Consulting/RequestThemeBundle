Theme
=====

## Overview


## How to define your own theme


## How to render your theme templates
```php
return $this->render(
    sprintf(
        '@%s/step/navigation.html.twig',
        ThemeInterface::TEMPLATE_NAMESPACE
    ),
    array()
);
```

## How to extends theme templates
```twig
{% extends theme_path("/base.html.twig") %}
```

## How to install theme assets