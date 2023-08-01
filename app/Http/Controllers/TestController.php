<?php

namespace App\Http\Controllers;

use App\Events\CustomerOrder;
use App\Jobs\sendMailPromotion;
use App\Jobs\TestJob;
use App\Models\Classroom;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // return URL::full();
        // return route('test', ['post'=> '1']);
        // return URL::signedRoute('test', ['id'=> '1']);
        // return URL::temporarySignedRoute('test', now()->addSeconds(1), ['ID'=> 1]);
        //  $url = action([TestController::class, 'index'], ['id'=> 1]);
        //  return $url;

        // Collection
        $collection = collect([
            [1,2],
            [3,4]
        ]);
        $collapse = $collection->collapse();
        dd($collapse->all());

        return view('test.index');
    }
    public function testSession()
    {
        session()->put(['useId' => 1]);
        // session()->push('user.name','hoa');
        // session()->pull('useId');
        // session()->put('count',1);
        // session()->increment('count', 2);
        // session()->flash('hi', 'hihiih');
        // session()->now('test', 'test1');
        // session()->forget('useId');
        session()->regenerate();
    }
    public function processOrder(Request $request)
    {
        $user = $request->except('_token');
        event(new CustomerOrder($user));
    }
    public function storeImg(Request $request)
    {
        // $photo = $request->file('photo')->store('public/img');
        $path = $request->photo->store('images');
        dd($path);
    }
    public function sendMailPromotion(Request $request)
    {
        // đã sử dụng được queue nhưng mà nó ko có send mail được, còn nếu bỏ queue đi thì chạy được
        // sendMailPromotion::dispatch(($request->user()))->onQueue('high');
        // sendMailPromotion::dispatch(($request->user()));
        // sendMailPromotion::dispatch();
        // $batch = Bus::batch([]);
        // foreach ($users as $user) {
        //     $job = new sendMailPromotion($user);
        //     $batch->add($job);
        // }
        // $batch->then(function (Batch $batch) {
        //     return 'Đã gửi thành công';

        // })->catch(function (Batch $batch, Throwable $e) {
        // })->dispatch();
        // $users = User::all();
        // foreach ($users as $user) {
        //     Mail::to($user)->queue(new PromotionMail($user));
        // }
        // sendMailPromotion::dispatch(($request->user()))->onConnection('redis');
        phpinfo();

        // $a = 1;
        // $b = $a + 1;
        TestJob::dispatch();

        return 'Đã gửi thành công';
    }
    public function chunkData()
    {
        Classroom::chunkById(50, function ($classrooms) {
            dd($classrooms);
        });
        // dd(Classroom::cursor());

        // $classroom = Classroom::firstOrCreate([
        //     'name' => 'M1'
        // ]);
        // dd($classroom);
    }
    public function insertOrUpdateManyClassrooms()
    {
        Classroom::upsert([
            ['id' => '1', 'name' => 'DDS'],
            ['id' => '203', 'name' => 'Z5'],
        ], ['id'], ['name']);
        return redirect(route('classroom.index'));
    }
}
