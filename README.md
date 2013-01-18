# MicroTwig

MicroTwig is an extension for the [Micro framework libraries](https://github.com/Xeoncross/Micro). It connects Micro to the [Twig templating library](http://twig.sensiolabs.org/).

### Use
To use, first [make sure your templates will work in Twig](http://twig.sensiolabs.org/doc/templates.html). Then, when you need to use a view, instantiate the MicroTwig view:

```php
// You only need to set $directory once
\MicroTwig\View::$directory = '/path/to/your/views';
$view = new \MicroTwig\View('Layout');
```

### License
MicroTwig is released under the MIT license.
