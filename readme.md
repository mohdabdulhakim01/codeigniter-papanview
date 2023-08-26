
# PapanView for Codeigniter v3.10

Are you searching for simple and flexible view template for Codeigniter similar to Laravel Blade View ?. This is the right tool for it. It have 70% similar writing method of blade view and have minimal component based mimic with it.

# Reason I develop this tool:
- I was in position where i need to develop using codeigniter only and no laravel and working on older version of codeigniter was quite pain without any view template tool. 
- Sure I've tried twigs,smarty and others but at some point my coding implementation just don't work with this template engine. 
- I need native php script  solution without hassle of installation and capable to support any php version starting PHP v5 and onward. 
- Some template i mentioned were consider abandoning older support so low hope for this template toolkit. 
- So PapanView was born to aid my project.

It support most of the blade syntax such as :
```
- @for
- @if
- @foreach
- @while
- @elseif
- @php
```
But most syntax must end with **::** to make sure engine able to read it properly such as
```
	@for($x = 1;$x>$totalY;$x++)::
	@endfor
	
	@if($x == $y)::
	@elseif($x == $z)::
	@endif
	
	@foreach($x as $y)::
	@endforeach
	
	@while($x > 0)::
	@endwhile
	
	{{$variable}}
	{!! $variable !!}  **--> doesn't return 0 or 1 in view render**
```

it also have syntax to autoconvert array to object when looping for who is love doing $object->data 
```
@object($objectName):;

```

It also support pagination and some basic component.
It also shipped out of the box with 
- Bootstrap Material UI CDN v5
- Fontawesome v4
- JQuery v3
- Google Font Icon
- HandsonTable v8.3.2
- Popper JS

# Component 
- I also try to mimic the view component style like Blade but not fully creatable by me. But basic component pulling like **<x-component/>** will work just fine

```
<x-header/>
<x-footer/>
<x-smart_box/> -- generate modal and render component from other page
<x-alert_box/> -- fancy modal alert box
<x-confirm_box/> -- fancy confirm box
```

# Component Limitation
- No multiple prop and name. but you can use :
``` 
<x-component prop="Whatever"/>
``` 

# Running PapanView
- Inside your controller. add **html_base**, **xcomponent**, and **paginator** helper file
```
$this->load->helper('html_base');
$this->load->helper('xcomponent');
$this->load->helper('paginator');
```
- Since we still comply to codeigniter view rule. we need to use **$data** variable to inject the variable to our view file. we just need to encapsulate the **$data** variable into other variable before inserting to parameter.
### Note
- Filename must end with .papan.php . And when declaring in controller . the view file doesn't need to written with the extension name.
```
public function index(){
    $data['name'] = 'Hakim';
    $papan_data = $data;
    papanView('view_path/filename',$papan_data);
}
```

#Note
- Some bug are unreadable since most of the view bug not return correctly. and for database model error doesn't logged at render so this might make you feel hard to backtrack the errors. 
- But once you use to it, it should be no problem.

## Pros 
- Super Lightweight - less than 1mb ( the Papanview Script File).
- Come with usual development tool such as Bootstrap/Jquery/Fontawesome.
- Come with usual modal tool such as alertbox,confirmbox,and smartbox.
- No setup needed
- Build with pagination similar with Laravel Pagination
- Come with minimal component based
- Compatible with older PHP version.
- Feel almost 70% like Laravel BladeView

## Cons 
- Bugs hard to debug since error is not correctly informed.
- Might prone to xss injection
- Component based functionality doesn't support very well.
- no @switch-case syntax

