<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\Foundation\Foundation; 
use App\Models\User;

use Helpers;
use Commandhelpers;

class MakeFoundation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fnd {alias} {--P|parent=} {--em=} {--pm=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Foundation by params: alias(foundation short name for url) --parent(Alias of parent foundation)';

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
        $command_title = 'Make Foundation';
        // Chacking Foundation And validation Of Parametrs
        try  {

            $alias = trim(strval($this->argument('alias')));
            $moderator_email  = $this->option('em');
            $moderator_passwd = $this->option('pm');

            if($moderator_email==null) {
                $moderator_email = $this->ask('What is moderator email?');
            }
            if($moderator_passwd==null) {
                $moderator_passwd = $this->secret('What is moderator password?');
            }

            $wrongParams = Commandhelpers::validationCommandParametrs(
                ['alias'=>$alias, 'email'=>$moderator_email, 'passwd'=>$moderator_passwd]
            );
            if(!empty($wrongParams)) {
                foreach ($wrongParams as $key => $value) {
                    $this->error($value);
                }
                return -1;
            }

            if(!$this->check_current_user_is_global_moderator($moderator_email, $moderator_passwd)) { 
                $this->error('Access closed');
                return -1;
            }

            $parent_alias = $this->option('parent');
            $parent_id = 0;

            if(!is_null(Helpers::foundationByAlias($alias))) {
                $this->error('The foundation with the same alias already exists');
                return -1;
            }
            if(!is_null($parent_alias) && $parent_alias !== '0') {
                $parent_alias = trim(strval($parent_alias));
                $wrongParams = Commandhelpers::validationCommandParametrs(['alias'=>$parent_alias]);
                if(!empty($wrongParams)) {
                    foreach ($wrongParams as $key => $value) {
                        $this->error($value);
                    }
                    return -1;
                }

                $parent_fnd = Helpers::foundationByAlias($parent_alias);
                if(is_null($parent_fnd)) {
                    $this->error('The foundation with the alias '.$parent_alias.' not exists');
                    return -1;
                } 
                $parent_id = $parent_fnd->id;
            }

            $this->info($command_title.': Parameter Check Completed');
        } catch (Throwable $t) {
            $errorInfo = $e->errorInfo;
            $this->error($command_title.': parameter processing error');
            return -1;
        }

        // Create Foundation
        try {

            $this->line('--- Creating a new foundation with alias: '. $alias);

            $fnd = Foundation::create([
                'alias'     => $alias,
                'parent_id' => $parent_id,
            ]);
            $this->line('--- Creating a new chatroom for foundation ('.$alias.')');
            $newchatroom = $fnd->chatrooms()->create([
                'alias'=>$fnd->id.':fnd-room', 
                'status'=>1,
                'foundation_id' => $fnd->id
            ]);

        } catch (QueryException $e) {
            $errorInfo = $e->errorInfo;
            $this->error('WRONG - Create New Foundation:'. $alias);
            Log::info("WRONG - Create New Foundation---:".$alias.'---'. date("Y-m-d H:i:s"));
            return -1;
        }

        $this->info('SUCCESS: '.$command_title.' ('.$alias.')');
        Log::info("SUCCESS '.$command_title.' with alias:". $alias);
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
