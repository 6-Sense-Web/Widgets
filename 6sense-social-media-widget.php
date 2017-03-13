<?php



class sexestore_Social_Media_Widget extends WP_Widget {



    public $defs, $fieldlabels;



    public function __construct() {



        $this->defs = array(



            'title' => '',



            'facebook' => '',            



            'twitter' => '',            



            'google' => '',                      



            'pinterest' => '',            



        );



        $this->fieldlabels = array(



            'title' => 'Widget Title: ',



            'facebook' => 'Facebook: ',            



            'twitter' => 'Twitter: ',            



            'google' => 'Google Plus: ',                     



            'pinterest' => 'Pinterest: ',            



        );



        parent::__construct(



                'sexestore-social-media', // Base ID  



                __('sexestore Social Media Widget','sexestore'), 



                array(



                    'description' => __('sexestore Social Media Widget', 'sexestore')



                )



        );



    }



    public function form($instance) {



        wp_parse_args((array) $instance, $this->defs);        



        foreach($this->fieldlabels as $key => $label):



            if(!isset($instance[$key]))



                $fieldval = $this->defs[$key];



            else



                $fieldval = $instance[$key];



        ?>



<p>



  <label for="<?php print $this->get_field_id($key); ?>"><?php print $label ?></label>



  <BR/>



  <input type="text" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" value="<?php echo esc_attr($fieldval); ?>" style="width:275px; height:30px;" />



</p>



<?php



        endforeach;



    }



     public function update($new_instance, $old_instance) {



         $instance['title'] = strip_tags($new_instance['title']);



         $k = 0;



         foreach($this->defs as $key => $val):



             $k++;



             if($k > 1)



             $instance[$key] = $new_instance[$key];



         endforeach;



        return $instance;



    }



    public function widget($args, $instance) {



        extract($args);



        print $before_widget;



        if(!empty($instance['title']))



            print $before_title.apply_filters('widget_title', $instance['title'] ).$after_title;



        ?>



<div class="social_widget">



  <ul>



    <?php



        $k = 0;



        foreach($this->defs as $key => $val):



             $k++;



             if($k > 1 && $instance[$key] != '')             



                echo "<li class='{$key}'><a href='{$instance[$key]}' class='tiptip' title='".ucfirst($key)."' target='_blank'>".ucfirst($key)."</a></li>";



         endforeach;



        ?>



  </ul>



</div>



<?php



        print $after_widget;



    }



}



add_action('widgets_init', create_function('', 'register_widget( "sexestore_Social_Media_Widget" );'));