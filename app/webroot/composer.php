<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/../Vendor/autoload.php';

use Kreait\Firebase\Factory;

class BuskerFirebase {

    var $factory;
    var $firebase;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withDatabaseUri('https://buskerdues-1b4cc-default-rtdb.firebaseio.com')
            ->withServiceAccount(__DIR__.'/buskerdues-1b4cc-firebase-adminsdk-j35k1-0ac3c36081.json');

        $this->firebase = $this->factory->createDatabase();
    }

    public function index() {
        $data = ["title" => uniqid(), "url" => 'https://buskerdues.com/project/'.uniqid()];
        $ref = $this->firebase->getReference('new_project')->getSnapshot();

        if($ref->exists()) {
            $ref->getReference()->update($data);
        }

        return [];
    }
}

// echo "<pre>";
// print_r((new BuskerFirebase)->index());