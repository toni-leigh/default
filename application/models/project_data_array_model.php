<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once (APPPATH.'models/universal_model.php');
/*
 class Project_data_array_model

 * @package		Template
 * @subpackage	Template Libraries
 * @category	Template Libraries
 * @author		Toni Leigh Sharpe
 * @copyright   Copyright (c) Toni Leigh Sharpe (2012)
*/
    class Project_data_array_model extends Universal_model {

    public function __construct()
    {
        parent::__construct();
    }

    /* *************************************************************************
     project_specific_template_data() - gets template data for this project only
     @param string
     @param numeric
     @param array
     @return
    */
    public function project_specific_template_data($panel,$data,$user)
    {
        /* BENCHMARK */ $this->benchmark->mark('func_project_specific_template_data_start');

        $dev=0;

        if (1==$dev)
        {
            $variation_types=$this->db->simple_query('select * from var_type where var_type_name not in ("price","post calc")') or die(mysql_error());
            $vtypes=array();
            $pl=array();
            while ($vt=mysql_fetch_array($variation_types))
            {
                $variation_values=$this->db->simple_query('select * from var_value where var_type_id='.$vt['var_type_id']) or die(mysql_error());

                while($v=mysql_fetch_array($variation_values))
                {
                    $key=$vt['var_type_id']."_".$v['var_value_id'];

                    $vtypes[$key]=array(
                        'details'=>array(
                            'var_type'=>$vt['var_type_name'],
                            'var_value'=>$v['var_value']
                        ),
                        'count'=>0
                    );
                }
            }

            $c=0;
            $this->benchmark->mark('get_products_start');

            $this->benchmark->mark('products_sql_start');

            $product_details=array();

            $products=$this->db->simple_query('select name, url, price, image, nvar_keys from node, product where node.id=product.node_id');
            /* $products=$this->db->simple_query('select id, name, url, price, image from node where type="product"');
            $pdetails=$this->db->simple_query('select node_id, nvar_keys from product');

            while ($pd=mysql_fetch_array($pdetails))
            {
                $product_details[$pd['node_id']]=$pd['nvar_keys'];
            } */

            $this->benchmark->mark('products_sql_end');

            /* BENCHMARK */ $this->benchmark->mark('iteration_start');

            $pcount=mysql_num_rows($products);
            $pcount_restrict=0;
            $vcount=0;

            $filters=array(
                '17'=>array(
                    '75'/*,
                    '76'*/
                ),
                '14'=>array(
                    '52'
                )
            );
            $filters=array('17_75','14_52'/*,'17_76','16_70','16_71'*/);

            $filter_count=count($filters);

            $pc=0;

            $filter_matching='and';

            while($p=mysql_fetch_array($products))
            {
                // store product flag, we should only store the product once
                    $product_flag=1;

                // get keys
                    $keys=json_decode($p['nvar_keys'],true);

                // count for demo output
                    $vcount=$vcount+=count($keys);

                // store the unique variations for this product, don't count all size etc. as new products
                    $unique_vars=array();

                // process keys
                    foreach ($keys as $k)
                    {
                        $vals=explode('-',$k);
                        //$types=explode('_',$k);

                        $stock=array_pop($vals);

                        // only if in stock
                        if ($stock>0)
                        {
                            /* $types=array();
                            $values=array();
                            foreach ($vals as $v)
                            {
                                $exploded=explode("_", $v);
                                $types[]=$exploded[0];
                                $values[]=$exploded[1];
                            } */
                            // passes filter, and or or
                                if ('and'==$filter_matching)
                                {
                                    $passes=0;

                                    if (count(array_intersect($filters, $vals))==$filter_count)
                                    {
                                        $passes=1;
                                    }
                                }
                                else
                                {
                                    $passes=count(array_intersect($filters, $vals));
                                }

                            // process passed
                                if ($passes>0)
                                {
                                    // on first hit store the product for output
                                    if (1==$product_flag)
                                    {
                                        if ($c<200)
                                        {
                                            $pl[$c]=$p;
                                        }
                                        $c++;

                                        $product_flag=0;

                                        $pcount_restrict++;
                                    }

                                    // now count as we are taking the filters into account
                                    foreach ($vals as $v)
                                    {
                                        if (!in_array($v, $unique_vars))
                                        {
                                            $unique_vars[]=$v;
                                        }
                                    }
                                }
                        }
                    }

                foreach ($unique_vars as $uv)
                {
                    $vtypes[$uv]['count']++;
                }

                $pc++;

                unset($keys);
            }

            /* BENCHMARK */ $this->benchmark->mark('iteration_end');

            $this->benchmark->mark('get_products_end');

            $data['vcount']=$vcount;
            $data['pcount']=$pcount;
            $data['pcount_restrict']=count($pl);
            $data['prestrict']=$pcount_restrict;
            $data['variations']=$vtypes;
            $data['product_list']=$pl;
            $data['filters']=$filters;
        }

        $dev=0;

        if (1==$dev)
        {
            $this->load->model('node_admin_model');

            $query=$this->db->select('*')->from('node')->where(array('type'=>'product'))->where_in('id',array(1513,1514,1515,1516,1517));
            $res=$query->get();
            $product_nodes=$res->result_array();

            //dev_dump($product_nodes);

            $query=$this->db->select('*')->from('product')->where_in('node_id',array(1513,1514,1515,1516,1517));
            $res=$query->get();
            $products=$res->result_array();

            $prods=array();
            foreach ($products as $p)
            {
                $prods[$p['node_id']]=$p;
            }

            //dev_dump($products);

            for ($x=1;$x<=1600;$x++)
            {
                echo $x."<br/><br/>";

                foreach ($product_nodes as $pn)
                {
                    $p=$prods[$pn['id']];

                    unset($pn['id']);

                    $pn['name']=$pn['name']." ".$x;
                    $pn['url']=$pn['url']."-".$x;

                    $this->db->insert('node',$pn);

                    $nid=$this->db->insert_id();

                    unset($p['node_id']);
                    $p['node_id']=$nid;

                    $this->db->insert('product',$p);
                }
            }

            die();
        }

        return $data;

        /* BENCHMARK */ $this->benchmark->mark('func_project_specific_template_data_end');
    }

    /* *************************************************************************
         admin_form_fields() -
         @param string
         @param numeric
         @param array
         @return
    */
    public function admin_form_fields($edit_node,$type)
    {
        switch ($type)
        {

        }

        return "";
    }

    /* *************************************************************************
         save_specific() - a function for doing specific things on project specific node type
         @param string
         @param numeric
         @param array
         @return
    */
    public function save_specific($post,$id,$type,$create=0)
    {
        /* BENCHMARK */ $this->benchmark->mark('func_save_specific_start');

        return $id;

        /* BENCHMARK */ $this->benchmark->mark('func_save_specific_end');
    }

    /* *************************************************************************
         set_specific_type_format() - sets the human readable output text for different types
         @param string $human_type
         @param numeric
         @param array
         @return
    */
    public function set_specific_type_format($type,$human_type)
    {
        /* BENCHMARK */ $this->benchmark->mark('func_set_specific_type_format_start');

        switch ($type)
        {
            case 'groupnode':
                $human_type='group';
                break;
        }

        /* BENCHMARK */ $this->benchmark->mark('func_set_specific_type_format_end');

        return $human_type;
    }

    /* *************************************************************************
         set_nav_name() - sets the name for naviagtion tabs, used to avoid verbose titles on navs
         @param string
         @param numeric
         @param array
         @return
    */
    public function set_nav_name($node)
    {
        /* BENCHMARK */ $this->benchmark->mark('func_set_nav_name_start');

        return $node['name'];

        /* BENCHMARK */ $this->benchmark->mark('func_set_nav_name_end');
    }

    /* *************************************************************************
         get_node() - hooked into by node so that the loaded node can be different from the url, useful for dynamic loading
            saves over-riding everything in project data array model
            this function by default just returns the node from $node_model->get_node() and this functionality should be left
            as a default
         @param variable $id - the id of the node to be over-ridden
         @param variable $user - the signed in user in case we need to use this for processing
         @return $node - the returned node
    */
    public function get_node($id,$user)
    {
        /* BENCHMARK */ $this->benchmark->mark('func_get_node_start');

        return $this->node_model->get_node($id);

        /* BENCHMARK */ $this->benchmark->mark('func_get_node_end');
    }

    /* *************************************************************************
        score_vote() - processes a vote action and returns a score for that vote
            based on site specific parameters
        @param $node - array containing the node which the vote was placed about
        @param $user - array containing the user who placed the vote
        @return $score - numeric score value based on the vote processing
    */
    public function score_vote($node,$user)
    {
        $score=0;

        $this->load->config('voting');
        $scores=$this->config->item('scores');

        // get all categories for this node
            $query=$this->db->select('*')->from('node_category')->where('node_id',$node['id']);
            $res=$query->get();
            $categories=$res->result_array();

        // loop and process, adding to score
            $score=0;

            foreach ($categories as $cat)
            {
                $query=$this->db->select('*')->from('hierarchy')->where(array('node_id'=>$cat['category_id']));
                $res=$query->get();
                $category=$res->row_array();

                $cat_score=$scores['augments'][$user[$scores['levels'][0]]][$category[$scores['levels'][1]]];
                if ($cat_score>$score)
                {
                    $score=$cat_score;
                }
            }

        return $score;
    }
}
