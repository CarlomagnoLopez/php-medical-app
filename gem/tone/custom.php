<?php if(!defined('s7V9pz')) {die();}?><?php
fn('db');
$css = db('Grupo', 's', 'customize', 'type|,type|,type', 'style', 'customcss', 'mstyle');

foreach ($css as $c) {
    if ($c['type'] == 'style') {

        echo html_entity_decode($c['v1'], ENT_QUOTES).'{';
        if ($c['v2'] == 'background' && !empty($c['v4']) || $c['v2'] == 'text-color') {
            echo 'background: linear-gradient(to right,'.$c['v3'].','.$c['v4'].');';
            if ($c['v2'] == 'text-color') {
                echo '-webkit-background-clip: text; -webkit-text-fill-color: transparent;';
            }
        } else
        {
            echo $c['v2'].':'.$c['v3'].';';
        }

        echo '}';
    }}

$box = db('Grupo', 's', 'options', 'type,v1', 'default', 'boxed')[0]['v2'];
if ($box != 'enable') {
    echo '.swr-grupo > .window{ padding:0px; }';
}
echo '@media (max-width: 767.98px){';
foreach ($css as $c) {
    if ($c['type'] == 'mstyle') {
        echo html_entity_decode($c['v1'], ENT_QUOTES).'{';
        if ($c['v2'] == 'background' && !empty($c['v4']) || $c['v2'] == 'text-color') {
            echo 'background: linear-gradient(to right,'.$c['v3'].','.$c['v4'].');';
            if ($c['v2'] == 'text-color') {
                echo '-webkit-background-clip: text; -webkit-text-fill-color: transparent;';
            }
        } else
        {
            echo $c['v2'].':'.$c['v3'].';';
        }

        echo '}';
    }}

echo '}';

foreach ($css as $c) {
    if ($c['type'] == 'customcss') {
        echo str_replace("&amp;gt;",">",$c['v1']);
    }}
?>