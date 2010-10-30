# CodeIgniter-Paginator

CodeIgniter-Paginator is a simple pagination creator. I created this library to have more flexibility and to be able to add e.g. a search string to the uri which is preserved while navigating. In the end, this library is an extract from one of my current projects and not an officially supported library. Feel free to use and / or modify this library or send me an email, if you have questions or suggestions (hello@mooseware.org).


## Requirements

1. PHP 5.1+
2. CodeIgniter 1.7.x - 2.0-dev


## Configuration
	$this->paginator->objects_per_page = 20;
Records to be displayed per page, e.g. 20 per page.
	
	$this->paginator->all_objetcs = xxx;
This should typically be set from a database result. You can find an example in 'examples/'.

	$this->paginator->search_string = "/search_string/".$search_string;
This string is appended to the pagination links to preserve the search while navigating. See example files.

	$this->paginator->start = xxx;
This is the offset for the LIMIT statement. It is going to be extracted from the URI (like the search string)

	$this->paginator->elements_between_dots = 3;
This means the displayed pagination links left and right from the current one, between the three dots (. . .). Play with it, you'll see the impact ;-)

	$this->paginator->pagination_url = "controller/index";
Finally this has to be set to the controller and method in which the pagination should be displayed. I think I will change that to get automatically set in one of the further versions.

## Usage

see example files.


## Todo

- set $this->paginator->pagination_url automatically to the correct controller / method
