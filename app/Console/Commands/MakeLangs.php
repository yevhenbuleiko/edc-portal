<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Foundation\Foundation; 
use App\Models\Language; 
use App\Models\User;

use Config;
use Helpers;
use Commandhelpers;

class MakeLangs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:langs {alias} {langs_list} {--em=} {--pm=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make langs list for foundation by alias and langs codes example:<en,ru,uk>';

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
        $command_title = 'Make Langs';
        // Chacking Foundation And validation Of Parametrs
        try  {

            $alias = trim(strval($this->argument('alias')));
            $langs_list = explode(",", strval($this->argument('langs_list')));
            $moderator_email  = $this->option('em');
            $moderator_passwd = $this->option('pm');

            if($moderator_email==null) {
                $moderator_email = $this->ask('What is moderator email?');
            }
            if($moderator_passwd==null) {
                $moderator_passwd = $this->secret('What is moderator password?');
            }

            $wrongParams = Commandhelpers::validationCommandParametrs(
                ['alias'=>$alias, 'langs'=>$langs_list, 'email'=>$moderator_email, 'passwd'=>$moderator_passwd]
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
            $this->line('--- Attache langs for foundation ('. $alias.')');
            
            $bar = $this->output->createProgressBar(count($langs_list));
            $bar->start();

            $srcLangs = Language::all();
            $fnd->languages()->detach();

            foreach ($langs_list as $lang) {
                $selected_lang = $srcLangs->firstWhere('lang', $lang);

                $is_native_lang = ($selected_lang->lang == $langs_list[0])? true : false;

                $fnd->languages()->attach($selected_lang, [
                    'native'        => $is_native_lang,
                    'added_at'      => now(),
                    'foundation_id' => $fnd->id
                ]);
                $bar->advance();
            }
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
