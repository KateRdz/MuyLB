<?php 
/**
* Blossom Shop Metabox for Sidebar Layout
*
* @package Blossom_Shop
*
*/ 

function blossom_shop_add_sidebar_layout_box(){
    $post_id   = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $template  = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = array( 'templates/blossom-portfolio.php' );
    
    //for post
    add_meta_box( 
        'blossom_shop_sidebar_layout',
        __( 'Sidebar Layout', 'blossom-shop' ),
        'blossom_shop_sidebar_layout_callback', 
        'post',
        'normal',
        'high'
    );

    if( ! in_array( $template, $templates ) ){
        add_meta_box( 
            'blossom_shop_sidebar_layout',
            __( 'Sidebar Layout', 'blossom-shop' ),
            'blossom_shop_sidebar_layout_callback', 
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'blossom_shop_add_sidebar_layout_box' );

$blossom_shop_sidebar_layout = array(    
    'default-sidebar'=> array(
         'value'     => 'default-sidebar',
         'label'     => __( 'Default Sidebar', 'blossom-shop' ),
         'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
    ),
    'no-sidebar'     => array(
         'value'     => 'no-sidebar',
         'label'     => __( 'Full Width', 'blossom-shop' ),
         'thumbnail' => get_template_directory_uri() . '/images/full-width.png'
    ),
    'centered'     => array(
         'value'     => 'centered',
         'label'     => __( 'Full Width Centered', 'blossom-shop' ),
         'thumbnail' => get_template_directory_uri() . '/images/full-width-centered.png'
    ),    
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
         'label'     => __( 'Left Sidebar', 'blossom-shop' ),
         'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'         
    ),
    'right-sidebar' => array(
         'value'     => 'right-sidebar',
         'label'     => __( 'Right Sidebar', 'blossom-shop' ),
         'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'         
     )    
);

function blossom_shop_sidebar_layout_callback(){
    global $post , $blossom_shop_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'blossom_shop_nonce' ); ?> 
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'blossom-shop' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php  
                    foreach( $blossom_shop_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_blossom_shop_sidebar_layout', true ); ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="blossom_shop_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="thumbnail" />
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table> 
<?php 
}

function blossom_shop_save_sidebar_layout( $post_id ){
    global $blossom_shop_sidebar_layout , $post;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'blossom_shop_nonce' ] ) || !wp_verify_nonce( $_POST[ 'blossom_shop_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;

    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }

    foreach( $blossom_shop_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, '_blossom_shop_sidebar_layout', true ); 
        $new = sanitize_text_field( $_POST['blossom_shop_sidebar_layout'] );
        if( $new && $new != $old ) {  
            update_post_meta( $post_id, '_blossom_shop_sidebar_layout', $new );  
        }elseif( '' == $new && $old ) {  
            delete_post_meta( $post_id, '_blossom_shop_sidebar_layout', $old );  
        } 
     } // end foreach     
}
add_action( 'save_post' , 'blossom_shop_save_sidebar_layout' );