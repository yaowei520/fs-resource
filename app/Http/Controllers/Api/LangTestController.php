<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

/**
 * rebirth.ma 2019-04-28
 * 多语言测试
 *
 * Class LangTestController
 * @package App\Http\Controllers\Api
 */
class LangTestController extends Controller
{
    /**
     * rebirth.ma 2019-04-28
     * 多语言测试打印
     */
    public function dump(){
        dd(trans('message.welcome'));
    }
}
