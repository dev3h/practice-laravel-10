<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
             //$name = $this->ask('What is your name?');
    //     // dữ liệu người dùng nhập khi gõ bàn phím không được hiển thị lên (giống nhập password của ubuntu)
       
    //     $password = $this->secret('What is the password?');
       
    //     // câu hỏi xác nhận, mặc định là false, khi gõ y hoặc yes sẽ trả về true
    //    if ($this->confirm('Do you wish to continue?')) {
    //     //
    //     }
    //     // cho phép auto complete với các tùy chọn
        $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        
    //     // câu hỏi nhiều lựa chọn, các lựa chọn được định nghĩa trước
    //     $name = $this->choice('What is your name?', ['Taylor', 'Dayle'], $default);

    //     // Lấy tham số limit
    //     $userType = $this->argument('limit');
    //     // Lấy tất cả các tham số
    //     $arguments = $this->arguments();
    //     // Lấy tất cả các tham số
    //     $arguments = $this->option();
    $this->question($name);
    }
}
