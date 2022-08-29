<?php
/**
 * Functions for WordPress
 *
 * @package function
 * Description: File for write custom function for hmmhfrontend theme
 */

/**
  * Connect styles and scripts to theme
  */
function hmmhfrontend_connect_files() {
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/main.css', '', '1.0', 'all');
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', '', '1.0', 'all' );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/scripts.js',  array('jquery'), '1.0', false );
}
add_action( 'wp_enqueue_scripts', 'hmmhfrontend_connect_files' );

/**
 * Register nav menus
 **/
function techhunt_register_menus() {
    register_nav_menus();
}
add_action( 'after_setup_theme', 'techhunt_register_menus' );

/**
 * Register Custom Block Editor
 */
function hmmhfrontend_block_editor() {
    if( function_exists( 'acf_register_block_type' ) ) {
        acf_register_block_type(
            array (
                'name'              => 'case_study',
                'title'             => __( 'Case Study' ),
                'description'       => __( 'A custom block for create Case Study.' ),
                'render_callback'   => 'my_acf_block_render_callback',
                'category'          => 'formatting',
                'icon'              => 'book',
                'keywords'          => array( 'case_study', 'study' ),
            )
        );
    }
}
add_action( 'acf/init', 'hmmhfrontend_block_editor' );


/**
 * Case Study Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
function my_acf_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
$id = 'case_study-' . $block['id'];
if( !empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

$className = 'case-study';
if( !empty( $block['className'] ) ) {
    $className .= ' ' . $block['className'];
}
if( !empty( $block['align'] ) ) {
    $className .= ' align' . $block['align'];
}

$text   = get_field('case_study');
$type   = get_field( 'case_study_type' );
$title  = get_field('case_study_title');
$image  = get_field('case_study_image');
$link   = get_field( 'case_study_link' );

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>" type="<?php echo $text;?>">
    <div class="case-image-wrap">
        <img src="<?php echo $image ?>" alt="Case Study Image">
    </div>
    <div class="case-study-type">
        <p><?php echo esc_html( $text ); ?> / <span><?php echo esc_html( $type ) ?></span></p>
    </div>
    <div class="case-study-title">
        <h1><?php esc_html_e( $title );?></h1>
    </div>
    <div class="case-study-link">
        <a href="<?php echo $link[ 'url' ] ?>"><?php esc_html_e( $link[ 'title' ] );?></a>
    </div>
</div>
<?php
}

/**
 * Function for get type and filtering cases
 */
function hmmhfrontend_get_type_case() {
    $post_blocks_tech = parse_blocks( get_the_content() );
    ?>
    <a href="" class="type-case current-item" type="all"><?php esc_html_e( 'All' )?></a>
    <?php
        foreach ($post_blocks_tech as $value)  :
            if  ($value['blockName']) {
                $post_block_clear = $value['attrs']['data']['case_study']; ?>
                <button class="type-case" type="<?php esc_html_e( $post_block_clear ); ?>"><?php esc_html_e( $post_block_clear ); ?></button>
                <?php
            }
        endforeach;
}

