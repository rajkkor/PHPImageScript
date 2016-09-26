<?php

/**
 * Created by PhpStorm.
 * User: Vinne
 * Date: 2016-09-26
 * Time: 16:53
 */
class im extends controller
{
    public function index($src = "media/egghouse.png",$width=100,$height=100){
        $im = $this->model('Img');
        $imageLoad = $this->model("imageLoad");
        $imageLoad->launch($src,$width,$height);

    }
}