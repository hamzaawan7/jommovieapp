<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 			= "home";
$route['404_override'] 					= 'error';
$route['watch/(:any)'] 					= 'watch/index/$1';
$route['watch/(:any)/(:any)'] 			= 'watch/index/$1/$2';
$route['watch/(:any)/(:any)/(:any)'] 	= 'watch/index/$1/$2/$3';
$route['blog/:num'] 					= 'blog/index';
$route['blog/category/(:any)'] 			= 'blog/category/$1';
$route['blog/(:any)'] 					= 'blog/details/$1';
$route['country/(:any)'] 				= 'country/index/$1';
$route['country/(:any)/:num'] 			= 'country/index/$1';
$route['genre/(:any)'] 					= 'genre/index/$1';
$route['genre/(:any)/:num'] 			= 'genre/index/$1';
$route['request-movies'] 				= 'home/request_movies';
$route['contact-us'] 					= 'home/contact';
$route['send_message'] 					= 'home/send_message';
$route['contact_process'] 				= 'home/contact_process';
$route['send_movie_requiest'] 			= 'home/send_movie_requiest';
$route['search'] 						= 'home/search';
$route['movies'] 						= 'home/movies';
$route['about-us'] 						= 'page/about_us';
$route['request-movies'] 				= 'home/request_movies';
$route['tv-series'] 					= 'home/tv_series';
$route['trailers'] 						= 'home/trailers';
$route['request-for-movies'] 			= 'home/request_for_movies';
//$route['about-us'] = 'home/about';
$route['dmca'] 							= 'home/dmca';
$route['policy'] 						= 'home/policy';
$route['terms'] 						= 'home/terms';
$route['star/(:any)'] 					= 'star/index/$1';
$route['star/(:any)/:num'] 				= 'star/index/$1';
$route['director/(:any)'] 				= 'director/index/$1';
$route['director/(:any)/:num'] 			= 'director/index/$1';
$route['tags/(:any)'] 					= 'tags/index/$1';
$route['tags/(:any)/:num'] 				= 'tags/index/$1';
$route['year'] 							= 'year/find';
$route['year/(:any)'] 					= 'year/find/$1';
$route['year/(:any)/:num'] 				= 'year/find/$1';
$route['page/(:any)'] 					= 'page/index/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */