<?php
/*
 * @author jegbagus
 */

define('JEG_WIDGET_TEMPLATE_PATH'	, JEG_ADMIN_TEMPLATE_PATH . 'widget/');

/** base class of widget **/
class Jeg_Widget extends WP_Widget
{
    protected $jtemplate;
    protected $fields;

    public function __construct($id_base = false, $name, $widget_options = array(), $control_options = array())
    {
        parent::__construct( $id_base,$name , $widget_options , $control_options );
        $this->jtemplate = new JTemplate(JEG_WIDGET_TEMPLATE_PATH);
    }

    public function render_form($fields, $instance) {

        foreach ($fields as $key => $field) :

            //** type text widget input **/
            if($field['type'] == 'type-text') {
                $this->jtemplate->render('type-text', array(
                    'title'		=> $field['title'] ,
                    'desc'		=> $field['desc'] ,
                    'fieldid'	=> $this->get_field_id( $key ) ,
                    'fieldname'	=> $this->get_field_name( $key ) ,
                    'value'		=> $instance[$key]
                ), true);
            }

        endforeach;
    }
}

/** Register widget **/
function jeg_register_widget () {
    register_widget("jeg_flickr_widget");
    register_widget("jeg_facebook_fans_widget");
}

add_action( 'widgets_init', 'jeg_register_widget' );
/** Register widget **/


/**
 * Adds Jeg_Flickr_Widget widget.
 */
class Jeg_Flickr_Widget extends Jeg_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $this->fields = array (
            'title'		=> array(
                'title' 	=> __( 'Title'),
                'desc' 		=> '',
                'type'		=> 'type-text'
            ),
            'totalimage'	=> array(
                'title' 	=> __( 'Number of flickr image'),
                'desc' 		=> '',
                'type'		=> 'type-text'
            ),
            'flickrid'	=> array(
                'title' 	=> __( 'Flickr NSID'),
                'desc' 		=> '<a href="http://www.flickr.com/services/api/explore/flickr.people.getInfo" target="_blank">click here</a> to find your nsid, (ex : 31446365@N05)',
                'type'		=> 'type-text'
            ),
            'flickrapi'	=>	array(
                'title' 	=> __( 'Flickr API'),
                'desc' 		=> 'Get Flickr api id from
								<a target="_blank" href="http://www.flickr.com/services/api/misc.api_keys.html">Here</a>',
                'type'		=> 'type-text'
            )
        );

        parent::__construct(
            'jeg_flickr_widget', // Base ID
            'Flickr Widget (Jegtheme)', // Name
            array( 'description' => __( 'Flickr sidebar widget for ' . JEG_THEMENAME ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        $this->jtemplate->render('flickr-widget', $instance, true);

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        j_update_option('flickr_last_check', 0);

        foreach ($this->fields as $key => $field) :
            $instance[$key] = strip_tags( $new_instance[$key] );
        endforeach;

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $this->render_form($this->fields, $instance);
    }

}



/**
 * Adds Facebook Fans Widget.
 */
class Jeg_Facebook_Fans_Widget extends Jeg_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $this->fields = array (
            'title'		=> array(
                'title' 	=> __( 'Title'),
                'desc' 		=> 'Title on Widget header',
                'type'		=> 'type-text'
            ),
            'facebookurl'	=> array(
                'title' 	=> __( 'Facebook Page URL'),
                'desc' 		=> 'Your widget page url like : http://www.facebook.com/jegbagusbarbershop',
                'type'		=> 'type-text'
            )
        );

        parent::__construct(
            'jeg_facebook_fans_widget', // Base ID
            'Facebook Fans Widget (Jegtheme)', // Name
            array( 'description' => __( 'Sidebar Facebook fans widget for ' . JEG_THEMENAME ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        $this->jtemplate->render('facebook-widget', $instance, true);

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        foreach ($this->fields as $key => $field) :
            $instance[$key] = strip_tags( $new_instance[$key] );
        endforeach;

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $this->render_form($this->fields, $instance);
    }

} 



