<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Illuminate\Support\Facades\DB;

class Install extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Installing...');
        
        $this->createTables();
        $this->seedPartners();
        $this->seedUsers();

        $this->info('Install successfull');
        $this->warn('Por favor inserir a chave do Google Maps no arquivo .env');
    }


    private function createTables()
    {
        DB::statement("DROP TABLE IF EXISTS easy.users");
        DB::statement("DROP TABLE IF EXISTS easy.partners");
        DB::statement("DROP TABLE IF EXISTS easy.partner_locations");
        DB::statement("DROP TABLE IF EXISTS easy.partner_services");

        $users = "CREATE TABLE easy.users (
            id varchar(150) not null,
            name varchar(150) not null,
            email varchar(150) not null,
            password varchar(45) not null,
            created_at timestamp,
            updated_at timestamp default current_timestamp
        ) engine InnoDb
        ";
        $partner = "CREATE TABLE easy.partners (
                id varchar(150),
                name varchar(150),
                created_at timestamp,
                updated_at timestamp default current_timestamp
            ) engine InnoDb
        ";

        $partner_locations = "CREATE TABLE easy.partner_locations (
            id int primary key auto_increment,
            partner_id varchar(150) NOT NULL,
            name varchar(150),
            address varchar(150),
            city varchar(150),
            state varchar(2),
            country varchar(45),
            lat varchar(50),
            `long` varchar(50),
            created_at timestamp,
            updated_at timestamp default current_timestamp
        ) engine InnoDb
        ";

        $partner_services = "CREATE TABLE easy.partner_services (
            id int primary key auto_increment,
            partner_id varchar(150) NOT NULL,
            name varchar(150) not null comment 'The service name provided by the partner',
            created_at timestamp,
            updated_at timestamp default current_timestamp
        ) engine InnoDb";


        DB::statement($users);
        DB::statement($partner);
        DB::statement($partner_locations);
        DB::statement($partner_services);
        

        # indexes
        $user_indexes = "ALTER TABLE `easy`.`users` 
            ADD UNIQUE INDEX `email_UNIQUE` USING BTREE (`email` ASC),
            ADD INDEX `index_id` USING BTREE (`id` ASC),
            ADD INDEX `index_name_pass` (`email` ASC, `name` ASC),
            ADD INDEX `index_password` USING BTREE (`password` ASC),
            ADD INDEX `index_email_password` USING BTREE (`email` ASC, `password` ASC);        
        ";
        DB::statement($user_indexes);
    }

    private function seedPartners(){
        $partners = file_get_contents('resources/partners.json');
        $partners = json_decode($partners);
        
        foreach($partners as $p){

            $bind = [
                $p->id, 
                utf8_decode($p->name)
            ];
            $sql = "INSERT INTO easy.partners VALUES (?, ?, now(), now())";
            DB::insert($sql, $bind);

            $bind = [
                $p->id,
                utf8_decode($p->location->name),
                utf8_decode($p->location->address),
                utf8_decode($p->location->city),
                utf8_decode($p->location->state),
                $p->location->country,
                $p->location->lat,
                $p->location->long,
            ];
            $sql = "INSERT INTO easy.partner_locations 
                (partner_id, name, address, city, state, country, lat, `long`, created_at)
                VALUES 
                (?, ?, ?, ?, ? ,?, ?, ?, now())";
            DB::insert($sql, $bind);

            $sql = "INSERT INTO easy.partner_services (partner_id, name, created_at) VALUES (?, ?, now())";
            foreach($p->availableServices as $s){
                $bind = [$p->id, $s];
                DB::insert($sql, $bind);
            }
        }
    }

    private function seedUsers(){
        $users = file_get_contents('resources/users.json');
        $users = json_decode($users);

        $sql = "INSERT INTO easy.users (id, name, email, password, created_at) 
                VALUES (?, ?, ?, ?, now())";
        foreach($users as $u){
            $bind = [
                $u->id,
                utf8_decode($u->name),
                $u->email,
                $u->password
            ];
            DB::insert($sql, $bind);
        }
    }
}