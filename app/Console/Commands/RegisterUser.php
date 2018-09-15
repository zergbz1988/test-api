<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registers new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *  Registers new user with name, email and password
     *
     */
    public function handle() : void
    {
        $this->info("Let's register new user.");
        $name = $this->ask('Enter name for new user');
        $validator = Validator::make(['name' => $name], ['name' => 'required|max:255',]);
        while ($validator->fails()) {
            $this->error("status: error");
            $this->error("message: " . implode(',', $validator->errors()->messages()['name']));
            $name = $this->ask('Enter name for new user');
            $validator = Validator::make(['name' => $name], ['name' => 'required|max:255',]);
        }

        $email = $this->ask('Enter email for new user');
        $validator = Validator::make(['email' => $email], ['email' => 'required|email|unique:users']);
        while ($validator->fails()) {
            $this->error("status: error");
            $this->error("message: " . implode(',', $validator->errors()->messages()['email']));
            $email = $this->ask('Enter email for new user');
            $validator = Validator::make(['email' => $email], ['email' => 'required|email|unique:users']);
        }

        $password = $this->ask('Set the password for new user');
        $validator = Validator::make(['password' => $password], ['password' => 'required|min:4',]);
        while ($validator->fails()) {
            $this->error("status: error");
            $this->error("message: " . implode(',', $validator->errors()->messages()['password']));
            $password = $this->ask('Set the password for new user');
            $validator = Validator::make(['password' => $password], ['password' => 'required|min:4',]);
        }

        $input = compact('name', 'email', 'password');
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $this->info("status: ok");
        $this->info("login: " . $user->email);


    }
}
