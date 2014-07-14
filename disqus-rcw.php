<?php
/*
Plugin Name: Recent Comments Widget For Disqus
Plugin URI: http://www.trickspanda.com
Description: Add a Disqus recent comments widget to your WordPress blog's sidebar
Version: 1.1
Author: Hardeep Asrani
Author URI: http://www.hardeepasrani.com
*/

class tp_disqusrecentcomments extends WP_Widget
{
    function tp_disqusrecentcomments()
    {
        $widget_ops = array(
            'classname' => 'tp_disqusrecentcomments',
            'description' => 'Add Disqus recent comments widget to WordPress sidebar.'
        );
        
        $this->WP_Widget('tp_disqusrecentcomments', 'Disqus Recent Comments Widget', $widget_ops);
    }
    
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance);
        
        if ($instance['commentnumbers'] == "") {
            $instance['commentnumbers'] = "5";
        }
?>

<p>
<label for="<?php
        echo $this->get_field_id('title');
?>">
Title:
<br/>
<input id="<?php
        echo $this->get_field_id('title');
?>" 
name="<?php
        echo $this->get_field_name('title');
?>" type="text" value="<?php
        echo $instance['title'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('siteid');
?>">
Disqus Site ID:
<br/>
<input id="<?php
        echo $this->get_field_id('siteid');
?>" 
name="<?php
        echo $this->get_field_name('siteid');
?>" type="text" value="<?php
        echo $instance['siteid'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('commentnumbers');
?>">
Number of Comments:
<br/>
<input id="<?php
        echo $this->get_field_id('commentnumbers');
?>" 
name="<?php
        echo $this->get_field_name('commentnumbers');
?>" type="number" value="<?php
        echo $instance['commentnumbers'];
?>" />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('hideavataroption');
?>">
Hide Avatars:
<br/>
<input type="hidden" name="<?php
        echo $this->get_field_name('hideavataroption');
?>" value="0" /> <input id="<?php
        echo $this->get_field_id('hideavataroption');
?>" 
name="<?php
        echo $this->get_field_name('hideavataroption');
?>" type="checkbox" value="1" <?php
        if (1 == $instance['hideavataroption'])
            echo 'checked="checked"';
?> />
</label>
<br/>
<label for="<?php
        echo $this->get_field_id('hidemodsoption');
?>">
Hide Moderators:
<br/>
<input type="hidden" name="<?php
        echo $this->get_field_name('hidemodsoption');
?>" value="0" /> <input id="<?php
        echo $this->get_field_id('hidemodsoption');
?>" 
name="<?php
        echo $this->get_field_name('hidemodsoption');
?>" type="checkbox" value="1" <?php
        if (1 == $instance['hidemodsoption'])
            echo 'checked="checked"';
?> />
</label>
</p>

<?php
    }
    function update($new_instance, $old_instance)
    {
        $instance                     = $old_instance;
        $instance['title']           = $new_instance['title'];
        $instance['siteid']           = $new_instance['siteid'];
        $instance['commentnumbers']   = $new_instance['commentnumbers'];
        $instance['hideavataroption'] = $new_instance['hideavataroption'];
        $instance['hidemodsoption']   = $new_instance['hidemodsoption'];
        
        return $instance;
    }
    
    function widget($args, $instance) // widget sidebar output
    {
        extract($args, EXTR_SKIP);
        
        echo $before_widget;
        echo $before_title;
        echo $instance['title'];
        echo $after_title;
        
        $title           = $instance['title'];
        $siteid           = $instance['siteid'];
        $commentnumbers   = $instance['commentnumbers'];
        $hideavataroption = $instance['hideavataroption'];
        $hidemodsoption   = $instance['hidemodsoption'];
        
        echo "<div id='recentcomments' class='dsq-widget'><script type='text/javascript' src='http://$siteid.disqus.com/recent_comments_widget.js?num_items=$commentnumbers&hide_avatars=$hideavataroption&avatar_size=32&excerpt_length=200&hide_mods=$hidemodsoption'></script></div>";
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("tp_disqusrecentcomments");'));

?>