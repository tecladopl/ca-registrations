<?php

namespace App\View\Composers;

use App\Models\Assembly;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class DefaultCRUDComposer
{

    /**
     * 
     * @var object \App\Models\
     */
    protected $model;
    protected $collection;

    public function __construct() {

        //$this->model = $model;
        //$this->collection = $model::cursor();
    }

    public function compose(View $view) {
        // dd(Str::replaceFirst('.index','',Str::replaceFirst('management.','',$view->getName())));
        // $view->with([
        //     'name' => get_class($this->model),
        //     'data' => $this->collection
        // ]);
    }


}