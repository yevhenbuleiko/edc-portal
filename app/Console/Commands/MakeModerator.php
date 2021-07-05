<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Foundation\Foundation; 
use App\Models\Access\Role; 
use App\Models\User;

use Config;
use Helpers;

class MakeModerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:moderator {alias} {email?} {passwd?} {--em=} {--pm=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Moderator for foundation by alias with params: <email, password>';

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
     * @return int
     */
    public function handle()
    {
        $command_title = 'Make Moderator For Foundation';
        // Chacking Foundation And validation Of Parametrs
        try  {

            $alias = trim(strval($this->argument('alias')));
            $email  = $this->argument('email');
            $passwd = $this->argument('passwd');
            $moderator_email  = $this->option('em');
            $moderator_passwd = $this->option('pm');

            if($moderator_email==null) {
                $moderator_email = $this->ask('What is moderator email?');
            }
            if($moderator_passwd==null) {
                $moderator_passwd = $this->secret('What is moderator password?');
            }

            $wrongParams = Helpers::validationCommandParametrs(
                ['alias'=>$alias, 'email'=>$moderator_email, 'passwd'=>$moderator_passwd]
            );
            if(!empty($wrongParams)) {
                foreach ($wrongParams as $key => $value) {
                    $this->error($value);
                }
                return -1;
            }
            if($email !==null && $passwd !== null) {
                $wrongParams = Helpers::validationCommandParametrs(
                    ['email'=>$email, 'passwd'=>$passwd]
                );
                if(!empty($wrongParams)) {
                    foreach ($wrongParams as $key => $value) {
                        $this->error($value);
                    }
                    return -1;
                }
            }

            if(!$this->check_current_user_is_global_moderator($moderator_email, $moderator_passwd)) { 
                $this->error('Access closed');
                return -1;
            }

            $fnd = Helpers::foundationByAlias($alias);
            if(is_null($fnd)) {
                $this->error('The foundation with the alias '.$alias.' not exists');
                $this->error('Run command: php artisan make:fnd <alias>');
                return -1;
            }

            $this->info($command_title.': Parameter Check Completed');
        } catch (Throwable $t) {
            $errorInfo = $e->errorInfo;
            $this->error($command_title.': parameter processing error');
            return -1;
        }

        try {
            $this->line('--- Make moderator for foundation ('. $alias.')');

            if($email == null && $passwd == null) {
                $email  = $moderator_email;
                $passwd = $moderator_passwd;
            }

            $newUser = User::where('email', $email)->first();

            if($newUser == null) {
                $bar = $this->output->createProgressBar(3);
                $bar->start();
                $newUser = User::create([
                    'name'           => 'Moderator',
                    'email'          => $email,
                    'password'       => Hash::make($passwd),
                    'foundation_id'  => $fnd->id,
                ]);

                $newchatroom = $newUser->chatrooms()->create([
                    'alias'=>$fnd->id.':user-room:'.$newUser->id,
                    'status'=>1,
                    'foundation_id' => $fnd->id
                ]);
                $bar->advance();
            } else {
                $bar = $this->output->createProgressBar(2);
                $bar->start();
            }

            $moderator_role = $fnd->roles()->where('alias', 'moderator')->first();
            $moderatorCtx = json_encode(['fnds'=>['act'=>[$fnd->id],'lead'=>[],'exc'=>[]]]);

            $moderator_role->users()->attach($newUser->id, [
                'pv_blocked'   => 0, 
                'pv_published' => 1, 
                'pv_binded_at' => now(),
                'pv_context'   => $moderatorCtx,
            ]);

            $newUser->perms()->attach($moderator_role->permissions);

            $bar->advance();

            $fnd->users()->attach($newUser->id, [
                'pv_blocked'   => 0, 
                'pv_published' => 1, 
                'pv_remote'    => 0, 
                'pv_context'   => $moderatorCtx,
                'pv_binded_at' => now(),
            ]);
            $bar->advance();

            $bar->finish();

        } catch (QueryException $e) {
            $errorInfo = $e->errorInfo;
            $this->error($errorInfo);
            $this->newLine();
            $this->error('WRONG - '.$command_title.' For Foundation ('. $alias.')');
            Log::info("WRONG - '.$command_title.' For Foundation: ---:".$alias.'---'.date("Y-m-d H:i:s"));
            return -1;
        }
        $this->newLine();
        $this->info('SUCCESS: '.$command_title.' ('.$alias.')');
        Log::info("SUCCESS '.$command_title.'for foundation (". $alias.')');
        return 0;
    }

     /* Helpers */
    
    // If User Is Global Moderator
    private function check_current_user_is_global_moderator($email, $pwd) {
        if(!User::all()->isEmpty()) {
            $current_user = User::where('email', $email)->first();
            if($current_user !== null) {
                $validCredentials = Hash::check($pwd, $current_user->getAuthPassword());

                if($validCredentials) {
                    if($current_user->globalModerator()) {
                        return true;
                    }
                }
            } 
            return false;
        } 
        return true;
    }
}
