<?php

class QuestionsWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('questions_widget', 'Questions');
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (isset($instance['first'])) {
            $content = apply_filters('widget_title', $instance['first']);
            echo $args['before_title'] . "<input type='submit' id='ask-button' class='choice-button' value='$content' name='question' />" . $args['after_title'];
        }
        if (isset($instance['second'])) {
            $content = apply_filters('widget_title', $instance['second']);
            echo $args['before_title'] . "<input type='submit' class='choice-button' value='$content' name='quiz' />" . $args['after_title'];
        }
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $first = isset($instance['first']) ? $instance['first'] : '';
        $second = isset($instance['second']) ? $instance['second'] : '';
?>
        <p>
            <label for='<?= $this->get_field_name('first') ?>'>Titre du bouton 1</label>
            <input type='text' class='widefat' id='<?= $this->get_field_name('first') ?>' name='<?= $this->get_field_name('first') ?>' value='<?= esc_attr($first) ?>' />

            <label for='<?= $this->get_field_name('second') ?>'>Titre du bouton 2</label>
            <input type='text' class='widefat' id='<?= $this->get_field_name('second') ?>' name='<?= $this->get_field_name('second') ?>' value='<?= esc_attr($second) ?>' />
        </p>
<?php
    }

    public function update($newInstance, $oldInstance)
    {
        return [
            'first' => $newInstance['first'],
            'second' => $newInstance['second']
        ];
    }
}
