<?php
/**
 * Newsmag functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsmag
 */

/**
 * Start Newsmag theme framework
 */
require_once dirname( __FILE__ ) . '/inc/class-newsmag-autoloader.php';

$newsmag = new Newsmag_Lite();



/**
* Define a constant path to our single template folder
*/
define(SINGLE_PATH, STYLESHEETPATH . '/single');

/**
* Filter the single_template with our custom function
*/
add_filter('single_template', 'my_single_template');

/**
* Single template function which will choose our template
*/
function my_single_template($single) {
	global $wp_query, $post;

/**
* Checks for single template by ID
*/

if(file_exists(SINGLE_PATH . '/single-' . $post->ID . '.php'))
	return SINGLE_PATH . '/single-' . $post->ID . '.php';

	
	/**
	* Checks for single template by category
	* Check by category slug and ID
	*/

foreach((array)get_the_category() as $cat) :

	if(file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
		return SINGLE_PATH . '/single-cat-' . $cat->slug . '.php';

	elseif(file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
		return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';

endforeach;


/**
* Checks for single template by tag
* Check by tag slug and ID
*/
$wp_query->in_the_loop = true;
foreach((array)get_the_tags() as $tag) :

	if(file_exists(SINGLE_PATH . '/single-tag-' . $tag->slug . '.php'))
		return SINGLE_PATH . '/single-tag-' . $tag->slug . '.php';

	elseif(file_exists(SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php'))
		return SINGLE_PATH . '/single-tag-' . $tag->term_id . '.php';

endforeach;
$wp_query->in_the_loop = false;
	
	
/**
* Checks for single template by author
* Check by user nicename and ID
*/
$curauth = get_userdata($wp_query->post->post_author);

if(file_exists(SINGLE_PATH . '/single-author-' . $curauth->user_nicename . '.php'))
	return SINGLE_PATH . '/single-author-' . $curauth->user_nicename . '.php';

elseif(file_exists(SINGLE_PATH . '/single-author-' . $curauth->ID . '.php'))
	return SINGLE_PATH  . '/single-author-' . $curauth->ID . '.php';
		
/**
* Checks for default single post files within the single folder
*/
if(file_exists(SINGLE_PATH . '/single.php'))
	return SINGLE_PATH . '/single.php';

elseif(file_exists(SINGLE_PATH . '/default.php'))
	return SINGLE_PATH . '/default.php';
	
return $single;

}



/* 
LAS MIAS DE ADIEL  

*/

function fechas($opcion){
	$mes = date("F");
		if (($mes=='May')or($mes=='June') or ($mes=='September') or ($mes=='October'))
		{	
			if ($opcion == 'temporada')
			{
				echo "Temporada Actual: Baja";
			}
			if ($opcion == 'precio')
			{
				$msg_precio = types_render_field( "precio-temporada-baja-alojamiento", array( ));
				echo "&nbsp;&nbsp;"; 
				echo $msg_precio;
			}
			
			if ($opcion == 'temporada-actual')
			{
				$tempo="baja";
				return $tempo;
			}
			
			
		}
		if ( ($mes=='July')or ($mes=='August') or ($mes=='November') or ($mes=='Diciembre') or ($mes=='January') or ($mes=='February') or ($mes=='March') or ($mes=='April'))
		{
			if ($opcion == 'temporada')
			{
				echo "Temporada Actual: Alta";	
			}
			if ($opcion == 'precio') 
			{
				$msg_precio = types_render_field( "precio-temporada-alta-alojamiento", array( ));
				echo "&nbsp;&nbsp;"; 
				echo $msg_precio;
			}
			if ($opcion == 'temporada-actual')
			{
				$tempo="alta";
				return $tempo;
			}
		}
		
}


/* FUNCION PARA CANTIDAD DE CARACTERES EN LOS EXTRACTOS */

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}



/*
Quitar version a enlaces CSS y JS en WP
07/04/2014 A LAS 18:45
Para mejorar la cache de nuestro wordpress es aconsejable quitar la variable “?ver=” de las urls que apuntan a nuestros ficheros CSS y JS.
Esto lo conseguimos añadiendo el siguiente código al fichero functions.php de nuestro theme.
*/

function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
 
add_filter( 'style_loader_src', 'remove_cssjs_ver' );
add_filter( 'script_loader_src', 'remove_cssjs_ver');



require_once dirname( __FILE__ ) . '/inc/newsmag-deprecated.php';



/*
PLANTILLA PERSONALIZADA PARA  EL RESULTADO DE BUSQUEDA DEL BOOKING
*/

function wpse_load_custom_search_template(){
    if( isset($_REQUEST['tag']) == 'advanced' ) {
        require('template-parts/advanced-search-result.php');
        die();
    }
}
add_action('init','wpse_load_custom_search_template');




/* Sidebar Opciones */
if(function_exists('register_sidebar')) {
    register_sidebar(array(
       'id'            => 'opcionalito',
		'name'          => __( 'Opcionles', 'newsmag' ),
		'description'   => __( 'Opcionales barra siodebar.', 'newsmag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));
}

/* Sidebar Show Category Alojamientos */
if(function_exists('register_sidebar')) {
    register_sidebar(array(
       'id'            => 'categorria_alojamientos',
		'name'          => __( 'Categoria Alojamientos', 'newsmag' ),
		'description'   => __( 'Mostrar los artículos de la categoria Alojamientos.', 'newsmag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));
}

/* Sidebar Show Category Opcionales Front Page */
if(function_exists('register_sidebar')) {
    register_sidebar(array(
       'id'            => 'content-areaa',
		'name'          => __( 'Homepage- Content area Opcionales', 'newsmag' ),
		'description'   => __( 'Mostrar los artículos de la categoria Opcionales.', 'newsmag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));
}


/* Flexslider para Galerías */

// CSS
add_action('wp_enqueue_scripts', 'my_add_styles');
add_action('wp_enqueue_scripts', 'my_add_scripts');
add_action('wp_head', 'fsng_addScriptt');

function my_add_styles() {
    wp_enqueue_style('Flexslider-css', get_stylesheet_directory_uri().'/assets/vendors/flexslider-plugin/flexslider.css');
	wp_enqueue_style('FlexsliderNav-css', get_stylesheet_directory_uri().'/assets/vendors/flexslider/flexslider-direction-nav.css');
}

// JS
function my_add_scripts() {
    //wp_enqueue_script('jquery');
    wp_enqueue_script('flexslider', get_stylesheet_directory_uri().'/assets/vendors/flexslider-plugin/jquery.flexslider-min.js', array('jquery'));
    //wp_enqueue_script('flexslider-init', get_stylesheet_directory_uri().'/assets/vendors/flexslider/flexslider-init.js', array('jquery', 'flexslider'));
}

function fsng_addScriptt(){
echo '<script type="text/javascript" charset="utf-8">
  jQuery(window).load(function() {
    jQuery(\'#carousel\').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
	itemMargin: 0,
    asNavFor: \'#slider\'
  });
 
  jQuery(\'#slider\').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
    });
  });
</script>';
}	



/*
remove_shortcode('gallery', 'gallery_shortcode'); // removes the original shortcode
add_shortcode('gallery', 'my_awesome_gallery_shortcode'); // add your own shortcode

/*
function my_awesome_gallery_shortcode($attr) {
$output = 'Codex is your friend' ;
return $output;
}
*/

//remove_shortcode('gallery', 'gallery_shortcode'); 



