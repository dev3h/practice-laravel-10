<?php

namespace App\Http\Controllers;

use App\Events\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{
    public function index() {
        // return URL::full();
        // return route('test', ['post'=> '1']);
        // return URL::signedRoute('test', ['id'=> '1']);
        // return URL::temporarySignedRoute('test', now()->addSeconds(1), ['ID'=> 1]);
        //  $url = action([TestController::class, 'index'], ['id'=> 1]);
        //  return $url;

        
        return 1;
    }
    public function testSession() {
        session()->put(['useId'=>1]);
        // session()->push('user.name','hoa');
        // session()->pull('useId');
        // session()->put('count',1);
        // session()->increment('count', 2);
        // session()->flash('hi', 'hihiih');
        // session()->now('test', 'test1');
        // session()->forget('useId');
        session()->regenerate();
    }
    public function processOrder(Request $request) {
        $user = $request->except('_token');
        event(new CustomerOrder($user));
    }
    public function storeImg(Request $request) {
        $photo = $request->file('photo')->store('public/img');
    }
}
