<?php
    $lowest=1;
    $low=5;
    $average=10;
    $high=15;
    $highest=25;

    // 1 = singular
    // n = plural
    $config['stream_actions']=array(
        0=>array(
            'user'=>array(
                '1'=>'created',
                'n'=>'created %_COUNT'
            ),
            'node'=>array(
                '1'=>'created by'              
            ),
            'actor_score'=>array(
                'article'=>$high,
                'blog'=>$high,
                'calendar'=>$highest,
                'event'=>$average,
                'groupnode'=>$highest,
                'product'=>$average
            )
        ),
        1=>array(
            'user'=>array(
                '1'=>'updated',
                'n'=>'updated %_COUNT times'
            ),
            'node'=>array(
                '1'=>'updated by',
                'n'=>'updated %_COUNT times by'                
            )
        ),
        2=>array(
            'user'=>array(
                '1'=>'added image to',
                'n'=>'added %_COUNT images to'
            ),
            'node'=>array(
                '1'=>'added image to by',
                'n'=>'added %_COUNT images to by'                
            ),
            'actor_score'=>array(
                'article'=>$low,
                'blog'=>$low,
                'calendar'=>$low,
                'event'=>$low,
                'groupnode'=>$low,
                'product'=>$low,
                'user'=>$average
            ),
            'target_owner_score'=>array(
                'article'=>$lowest,
                'blog'=>$lowest,
                'calendar'=>$lowest,
                'event'=>$lowest,
                'groupnode'=>$lowest,
                'product'=>$lowest,
                'user'=>$lowest
            )
        ),
        3=>array(
            'user'=>array(
                '1'=>'commented on',
                'n'=>'%_COUNT comments on '
            ),
            'node'=>array(
                '1'=>'commented on by',
                'n'=>'%_COUNT comments on by '                
            ),
            'actor_score'=>array(
                'article'=>$lowest,
                'blog'=>$lowest,
                'calendar'=>$lowest,
                'event'=>$lowest,
                'groupnode'=>$lowest,
                'product'=>$lowest,
                'user'=>$lowest
            ),
            'target_owner_score'=>array(
                'article'=>$lowest,
                'blog'=>$lowest,
                'calendar'=>$lowest,
                'event'=>$lowest,
                'groupnode'=>$lowest,
                'product'=>$lowest,
                'user'=>$lowest
            )
        ),
        4=>array(
            'user'=>array(
                '1'=>'befriended',
                'n'=>'befriended'
            ),
            'node'=>array(
                '1'=>'befriended',
                'n'=>'befriended'                
            )
        ),
        5=>array(
            'user'=>array(
                '1'=>'joins',
                'n'=>'joins'
            ),
            'node'=>array(
                '1'=>'joined by',
                'n'=>'joined by'                
            ),
            'actor_score'=>array(
                'groupnode'=>$high
            ),
            'target_owner_score'=>array(
                'groupnode'=>$low
            )
        ),
        6=>array(
            'user'=>array(
                '1'=>'voted up',
                'n'=>'voted %_COUNT times up'
            ),
            'node'=>array(
                '1'=>'voted up by',
                'n'=>'voted up %_COUNT times by'                
            ),
            'actor_score'=>array(
                'article'=>$lowest,
                'blog'=>$lowest,
                'calendar'=>$lowest,
                'event'=>$lowest,
                'groupnode'=>$lowest,
                'product'=>$lowest,
                'user'=>$lowest
            ),
            'target_owner_score'=>array(
                'article'=>$average,
                'blog'=>$average,
                'calendar'=>$average,
                'event'=>$average,
                'groupnode'=>$average,
                'product'=>$average,
                'user'=>$average
            )
        ),
        7=>array(
            'user'=>array(
                '1'=>'voted down',
                'n'=>'voted %_COUNT times down'
            ),
            'node'=>array(
                '1'=>'voted down by',
                'n'=>'voted down %_COUNT times'                
            ),
            'actor_score'=>array(
                'article'=>0-$lowest,
                'blog'=>0-$lowest,
                'calendar'=>0-$lowest,
                'event'=>0-$lowest,
                'groupnode'=>0-$lowest,
                'product'=>0-$lowest,
                'user'=>0-$lowest
            ),
            'target_owner_score'=>array(
                'article'=>0-$average,
                'blog'=>0-$average,
                'calendar'=>0-$average,
                'event'=>0-$average,
                'groupnode'=>0-$average,
                'product'=>0-$average,
                'user'=>0-$average
            )
        ),
        8=>array(
            'user'=>array(
                '1'=>'added video to',
                'n'=>'added %_COUNT videos to'
            ),
            'node'=>array(
                '1'=>'had video added by',
                'n'=>'had %_COUNT videos added by'                
            ),
            'actor_score'=>array(
                'article'=>$average,
                'blog'=>$average,
                'calendar'=>$average,
                'event'=>$average,
                'groupnode'=>$average,
                'product'=>$average,
                'user'=>$average
            )
        ),
        9=>array(
            'user'=>array(
                '1'=>'updated video for',
                'n'=>'updated video %_COUNT times'
            ),
            'node'=>array(
                '1'=>'video updated by',
                'n'=>'video updated %_COUNT times by'                
            )
        ),
        10=>array(
            'user'=>array(
                '1'=>'followed',
                'n'=>'followed %_COUNT'
            ),
            'node'=>array(
                '1'=>'followed by',
                'n'=>'followed by %_COUNT times'                
            ),
            'actor_score'=>array(
                'article'=>$lowest,
                'blog'=>$lowest,
                'calendar'=>$lowest,
                'event'=>$lowest,
                'groupnode'=>$lowest,
                'product'=>$lowest,
                'user'=>$lowest
            ),
            'target_owner_score'=>array(
                'article'=>$average,
                'blog'=>$average,
                'calendar'=>$average,
                'event'=>$average,
                'groupnode'=>$average,
                'product'=>$average,
                'user'=>$average
            )
        )
    );
?>