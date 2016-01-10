<?php
/*
 * @package		Template
 * @subpackage	Template Libraries
 * @category	Template Libraries
 * @copyright   Copyright (c) Toni Leigh Sharpe (2012)
 *
*/
?>
<?php
    echo "<div id='filter_panel'>";
    echo "<span id='filter_heading'>filter by name:</span>";
    echo "<input id='filter' class='form_field rounded' type='text' onkeyup='fe_filter()' placeholder='enter text to filter panels'/>";
    echo "</div>";
    ?>
        <script type='text/javascript'>
            if (window.focus)
            {
                function fe_filter()
                {
                    var value=$('#filter').val();
                    if (value!='')
                    {
                        $('.fe_list').css('display','none');
                        value=value.replace(/\W/g, '');
                        value=value.toLowerCase();
                        $("[id*="+value+"]").css('display', '');
                    }
                    else
                    {
                        $('#list .fe_list').css('display', '');
                    }
                }
            }
        </script>
    <?php
        // open list
            switch ($node['url'])
            {
                case 'blog':
                    echo "<div id='list' itemscope itemtype='http://schema.org/Blog'>";
                    break;
                case 'products':
                    echo "<div id='list' itemscope itemtype='http://schema.org/SomeProducts'>";
                    break;
                default:
                    echo "<div id='list' itemscope itemtype='http://schema.org/ItemList'>";
                    break;

            }

        // list nodes
            foreach ($node_list as $panel)
            {
                // common values array
                    $more_data=array(
                        'filter_id' => strtolower(preg_replace("/[^A-Za-z0-9]/",'',$panel['name'].$panel['tags'].$panel['user_name'].$panel['type'].date('My MY Fy FY Dd ld Dj lj Ds',strtotime($panel['created'])))),
                        'panel'=>$panel
                    );

                echo $this->load->view("node_element/".$panel['type']."/list_panel",$more_data);
            }

        // close list div
            echo "</div>";
    ?>
<?=$this->load->view('template/node/map');
