<?php
/*
Plugin Name: Mina Plugin
Description: Plugin para crear el formulario de BROOBE
Version: 1.0
Author: Mina
*/

// Funcion del custom post type
function create_posttype() {
 
    register_post_type( 'jobapplications',
    // CPT Opciones
        array(
            'labels' => array(
                'name' => __( 'Job Applications' ),
                'singular_name' => __( 'Job Application' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'jobapplications'),
            'show_in_rest' => true,
 
        )
    );
}
// Inicializo el CPT en el theme
add_action( 'init', 'create_posttype' );


 
function custom_post_type() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Job Applications', 'Post Type General Name', 'twentytwentyone' ),
            'singular_name'       => _x( 'Job Application', 'Post Type Singular Name', 'twentytwentyone' ),
            'menu_name'           => __( 'Job Applications', 'twentytwentyone' ),
            'parent_item_colon'   => __( 'Parent Job Application', 'twentytwentyone' ),
            'all_items'           => __( 'All Job Applications', 'twentytwentyone' ),
            'view_item'           => __( 'View Job Application', 'twentytwentyone' ),
            'add_new_item'        => __( 'Add New Job Application', 'twentytwentyone' ),
            'add_new'             => __( 'Add New', 'twentytwentyone' ),
            'edit_item'           => __( 'Edit Job Application', 'twentytwentyone' ),
            'update_item'         => __( 'Update Job Application', 'twentytwentyone' ),
            'search_items'        => __( 'Search Job Application', 'twentytwentyone' ),
            'not_found'           => __( 'Not Found', 'twentytwentyone' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
        );
         
    // Otras opciones Custom Post Type
         
        $args = array(
            'label'               => __( 'jobapplications', 'twentytwentyone' ),
            'description'         => __( 'Job Applications', 'twentytwentyone' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor','content', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( '' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );
         
        // Registro mi Custom Post Type
        register_post_type( 'jobapplications', $args );
     
    }


    // Mostrar custom post type en la home
    add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'jobapplications' ) );
    return $query;
}

/**
     * Agrega los meta boxes para el Custom Post Type Job Applications
     * https://developer.wordpress.org/reference/functions/add_meta_box/
     */
    function broobe_register_meta_boxes(){
            add_meta_box('broobe-info', 'Información', 'broobe_output_meta_box', 'jobapplications', 'normal', 'high');
    }


    function broobe_output_meta_box(){

            // Los campos se graban en la base de datos con un subrayado bajo como prefijo
        // WP indica así por defecto que son campos metas
        $email = get_post_meta($post->ID, '_email', true);
        $empleo = get_post_meta($post->ID, '_empleo', true);
        $edad = get_post_meta($post->ID, '_edad', true);
            echo('<label for="email">' . __('Email', 'text_domain') . '</label>');
            echo('<input type="text" name="email" id="email" value="' . esc_attr($email) . '"><br>');
            echo('<label for="empleo">' . __('Empleo', 'text_domain') . '</label>');
            echo('<select name="empleo" id="empleo">');
            echo('<option value="' . esc_attr($empleo) . '">' . __('Part Time', 'text_domain') . '</option>');
            echo('<option value="' . esc_attr($empleo) . '">' . __('Full Time', 'text_domain') . '</option></select> <br>');
            echo('<label for="edad">' . __('Edad', 'text_domain') . '</label>');
            echo('<input type="number" name="edad" id="edad" value="' . esc_attr($edad) . '">');
        }


    add_action('add_meta_boxes', 'broobe_register_meta_boxes');


    function broobe_save_meta_boxes($post_id)
    {
        
        // Comprueba que el tipo de post es jobapplications
        if ('jobapplications' == $_POST['post_type']) {
            return $post_id;
        }
        
        // Comprueba que el usuario actual tiene permiso para editar esto
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        
        // Ahora puedes grabar los datos con tranquilidad
        // Observa que cuando vienen del formulario los campos meta no vienen con el prefijo subrayado bajo pero cuando los grabas en el post hay que poner el prefijo, igual que cuando los leías del post
        $email = ($_POST['email']);
        update_post_meta($post_id, '_email', $email);
        $empleo = ($_POST['empleo']);
        update_post_meta($post_id, '_empleo', $empleo);
        $edad = ($_POST['edad']);
        update_post_meta($post_id, '_edad', $edad);
        return true;
    }
    
    add_action('save_post', 'broobe_save_meta_boxes');

    function broobe_add_custom_fields_to_content( $content ) 
{
    $custom_fields = get_post_custom();
    $content .= "<ul>";
    if( isset( $custom_fields['_email'] ) ) {
        $content .= '<li> Email: '. $custom_fields['_email'][0] . '</li>';
    }
    if( isset( $custom_fields['_empleo'] ) ) {
        $content .= '<li> Tipo de Empleo: ' . $custom_fields['_empleo'][0] . '</li>';
    }
    if( isset( $custom_fields['_edad'] ) ) {
        $content .= '<li> Edad: ' . $custom_fields['_edad'][0] . '</li>';
    }
    $content .= '</ul>';
    
    return $content;
}

add_filter( 'the_content', 'broobe_add_custom_fields_to_content' );


// Cuando el plugin se active se crea la tabla para recoger los datos si no existe
register_activation_hook(__FILE__, 'guardarDatos');

function guardarDatos() {
    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
    // Crea la tabla sólo si no existe
    // Utiliza el mismo prefijo del resto de tablas
    $tabla_broobe = $wpdb->prefix . 'broobe';
    // Utiliza el mismo tipo de orden de la base de datos
    $charset_collate = $wpdb->get_charset_collate();
    // Prepara la consulta
    $query = "CREATE TABLE IF NOT EXISTS $tabla_broobe (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre varchar(40) NOT NULL,
        email varchar(100) NOT NULL,
        empleo varchar(40) NOT NULL,
        edad smallint(4),
        perfil varchar(100),
        UNIQUE (id)
        ) $charset_collate;";
    // La función dbDelta permite crear tablas de manera segura se
    // define en el archivo upgrade.php que se incluye a continuación
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query); // Lanza la consulta para crear la tabla de manera segura
}



// Creación de short code
add_shortcode('formulario', 'formulario_job_applications');


function formulario_job_applications() {
    



    global $wpdb; // Este objeto global permite acceder a la base de datos de WP
    // Si viene del formulario  graba en la base de datos
    // Cuidado con el último igual de la condición del if que es doble
    if ($_POST['nombre'] != ''
        AND is_email($_POST['email'])
        AND $_POST['empleo'] != ''
        AND $_POST['edad'] > 0    
    ) {
        $tabla_broobe = $wpdb->prefix . 'broobe'; 
        $nombre = sanitize_text_field($_POST['nombre']);
        $email = $_POST['email'];
        $empleo = $_POST['empleo'];
        $edad = (int)$_POST['edad'];
        $perfil = sanitize_text_field($_POST['perfil']);

        $wpdb->insert(
            $tabla_broobe,
            array(
                'nombre' => $nombre,
                'email' => $email,
                'empleo' => $empleo,
                'edad' => $edad,
                'perfil' => $perfil,
            )
        );
        echo "<p class='exito'><b>Tus datos han sido registrados</b>. Gracias 
            por tu interés.<p>";
    }

    ob_start();
    ?> 
    <form action="" method="post" id="broobe-form">

            <div class="elem-group" id="item-1">
                <label for="nombre">Nombre y Apellido </label>
                    <input  type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre y apellido" required/>
            </div>     

            <div class="elem-group" id="item-2">
                <label for="email">Email</label>
                    <input  type="text" id="email" name="email" placeholder="Ingrese su email" required/>
            </div>

            <div class="elem-group" id="item-3">
                <label for="empleo">Tipo de Empleo</label>
                    <select  type="text" id="empleo" name="empleo" required>
                        <option value="">Select</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Full Time">Full Time</option>
                    </select>
            </div>

            <div class="elem-group" id="item-4">
                <label for="edad">Edad</label>
                    <input  type="number" id="edad" name="edad" placeholder="Ingrese su edad"/>
            </div>

            <div class="elem-group" id="item-5">
                <label for="perfil">Perfil</label>
                    <textarea  id="perfil" name="perfil" placeholder="Describa su perfil"></textarea>
            </div>        
            
        <button id="form-button" type="submit">Enviar</button>

        <input type="hidden" name="action" value="new_post" />
   </form>

   <?php

     // Agregando los campos al custom post type 'Job Applications'
     $new_post = array(
        'post_title'    => $nombre,
        'post_content'  => $perfil,
        'post_status'   => 'publish', 
        'post_type' => 'jobapplications'  
    );
    //guardo el post
    $pid = wp_insert_post($new_post); 
  
     
     // Devuelve el contenido del buffer de salida
     return ob_get_clean();
 
}