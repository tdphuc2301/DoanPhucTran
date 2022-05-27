<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
Breadcrumbs::register('home',function ($breadcrumbs, $alias = null, $name = ''){
    if($alias){
        $breadcrumbs->push('Home', route('home'));
    }
    switch ($alias){
        case 'category':

    }

});
