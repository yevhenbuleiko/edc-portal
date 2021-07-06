<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

use App\Models\Foundation\Foundation; 
use App\Models\Currency;
use App\Models\Language;
use App\Models\Access\Role; 
use App\Models\User;

use Config;
use Helpers;
use Commandhelpers;

class CreateFoundation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:fnd {--em=} {--pm=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize New Founation';

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
        $command_title = 'Initialize New Foundation';

        // Chacking Foundation And validation Of Parametrs
        try  {

            $alias = $this->ask('Foundation alias: ');
            $alias = trim(strval($alias));
            $parent_id = 0;

            if ($this->confirm('Parent foundation?')) {
                $parent_alias = $this->ask('Parent foundation Alias');

                // $wrongParams = Helpers::validationCommandParametrs(['alias'=>$parent_alias]);
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

            $langs_list = $this->ask('Languages list <en,fr,ru>:');
            $tmp_langs_list = explode(",", strval(trim($langs_list)));
            $currencies_list = $this->ask('Currencis list <USD,EUR,RUB>:');
            $tmp_currencies_list = explode(",", strval(trim($currencies_list)));
            
            if ($this->confirm('Set Moderator for foundation?')) {
                $email  = $this->ask('Moderator email?');
                $passwd = $this->ask('Moderator email?');

                $wrongParams = Commandhelpers::validationCommandParametrs(['alias'=>$alias, 'email'=>$email, 'passwd'=>$passwd]);
                if(!empty($wrongParams)) {
                    foreach ($wrongParams as $key => $value) {
                        $this->error($value);
                    }
                    return -1;
                }
            }

            $moderator_email  = $this->option('em');
            $moderator_passwd = $this->option('pm');

            if($moderator_email==null) {
                $moderator_email = $this->ask('What is global moderator email?');
            }
            if($moderator_passwd==null) {
                $moderator_passwd = $this->secret('What is global moderator password?');
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

            $this->info($command_title.': Parameter Check Completed');
        } catch (Throwable $t) {
            $errorInfo = $e->errorInfo;
            $this->error($command_title.': parameter processing error');
            return -1;
        }


        try {

            $this->line('Database seeding');

            if(Currency::all()->count() == 0) {
                $this->line('Seeding: Database\Seeders\CurrenciesSeeder');
                $currencies = Config::get('seedsdata.currencies');
                
                $bar = $this->output->createProgressBar(count($currencies));
                $bar->start();

                foreach($currencies as $value) {

                    $currencyArray = explode(",", $value);
                    
                    Currency::create([
                        'code'      => trim($currencyArray[2], " \t\n\r\0\x0B"),
                        'title'     => trim($currencyArray[1], " \t\n\r\0\x0B"),
                        'country'   => $currencyArray[0],
                        'img'       => $currencyArray[2]. ".png",
                        'html_code' => $currencyArray[3],
                    ]);
                    $bar->advance();
                }
                $bar->finish();
            }
            if(Language::all()->count() == 0) {
                $this->newLine();
                $this->line('Seeding: Database\Seeders\LanguageSeeder');
                $languages = Config::get('seedsdata.languages');
            
                $bar = $this->output->createProgressBar(count($languages));
                $bar->start();

                foreach($languages as $code => $title) {
                    Language::create([
                        'lang'  => trim($code, " \t\n\r\0\x0B"),
                        'title' => trim($title, " \t\n\r\0\x0B"),
                        'img'   => trim($code, " \t\n\r\0\x0B"). '.png'
                    ]);
                    $bar->advance();
                }
                $bar->finish();
            }
            $this->newLine();
    
            $wrongParams = Commandhelpers::validationCommandParametrs(
                ['alias'=>$alias, 'currencies'=>$tmp_currencies_list, 'langs'=>$tmp_langs_list]
            );
            if(!empty($wrongParams)) {
                foreach ($wrongParams as $key => $value) {
                    $this->error($value);
                }
                return -1;
            }
            $this->newLine();
            $this->newLine();
            if($parent_id == 0) {
                $newFndRes = $this->call('make:fnd', ['alias'=>$alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            } else {
                $newFndRes = $this->call('make:fnd', ['alias'=>$alias, '-P'=>$parent_alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndRes!==-1) {
                //$newFndItemsAllows = $this->call('make:items', ['alias' => $alias,'--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
                $newFndItemsAllows = 1000;
            }
            $this->newLine();
            if($newFndItemsAllows!==-1) {
                $newFndPermossionsRes = $this->call('make:permissions', ['alias' => $alias,'--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndPermossionsRes!==-1) {
                $newFndRolesRes = $this->call('make:roles', ['alias' => $alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndRolesRes!==-1) {
                $newFndAccessRes = $this->call('make:access', ['alias' => $alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndAccessRes!==-1) {
                $newFndSettingsRes = $this->call('make:settings', ['alias' => $alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndSettingsRes!==-1) {
                $newFndDecorsRes = $this->call('make:decors', ['alias' => $alias,'--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndDecorsRes!==-1) {
                $newFndLangsRes = $this->call('make:langs', ['alias' => $alias, 'langs_list'=>$langs_list, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndLangsRes!==-1) {
                $newFndCurrenciesRes = $this->call('make:currencies', ['alias' => $alias, 'currencies_list'=>$currencies_list, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();
            if($newFndCurrenciesRes!==-1) {
                $this->call('make:moderator', ['alias'=>$alias, '--em'=>$moderator_email, '--pm'=>$moderator_passwd]);
            }
            $this->newLine();

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
