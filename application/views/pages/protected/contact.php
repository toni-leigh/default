<?php
/*
 * @package		Template
 * @subpackage	Template Libraries
 * @category	Template Libraries
 * @copyright   Copyright (c) Toni Leigh Sharpe (2012)
 *
*/
?>
<div class='contact_form'>
    <?php
        $this->load->helper('data');

        // open form
            echo form_open('contact/send_contact');

        // special captcha field
            echo form_input(
                array(
                    'name' => 'phone_number',
                    'style'=>'position:absolute;top:-10000px;'
                )
            );

        // contact name
            echo "<h2>Your name</h2>";
            echo form_input(
                array(
                    'name' => 'contact_name',
                    'class' => 'form_field rounded contact_name',
                    'value'=>get_value(null,'contact_name')
                )
            );


        // contact methods
            echo "<h2>How do we contact you?</h2>";
            echo "<p>You must provide at least one if you want us to get back in touch with you</p>";

            // phone number
                echo form_label(
                    'Phone number',
                    'contact_phone',
                    array(
                        'class' => 'form_label'
                    )
                );
                echo form_input(
                    array(
                        'name' => 'contact_phone',
                        'class' => 'form_field rounded contact_phone',
                        'value'=>get_value(null,'contact_phone')
                    )
                );

            echo "<h3>AND / OR</h3>";

            // email address
                echo form_label(
                    'Email Address',
                    'contact_email',
                    array(
                        'class' => 'form_label'
                    )
                );
                echo form_input(
                    array(
                        'name' => 'contact_email',
                        'class' => 'form_field rounded contact_email',
                        'value'=>get_value(null,'contact_email')
                    )
                );

        // message
            echo "<h2>Your message for ".$this->config->item('site_name')."</h2>";
            echo form_textarea(
                array(
                    'name' => 'message',
                    'class' => 'form_field rounded contact_message',
                    'value'=>get_value(null,'message')
                )
            );

        // submit button and close form
            $attr=array(
                'name'=>'submit',
                'id'=>'contact_submit',
                'class'=>'submit'
            );
            echo form_submit($attr,'send contact');
            echo form_close();
    ?>
</div>
<div class='contact_details'>

</div>
