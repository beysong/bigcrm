<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookTableSeeder extends Seeder {

  public function run()
  {
    //DB::table('books')->delete();

    for ($i=0; $i < 1000; $i++) {
      Book::create([
        'shop'   => 'shop '. rand(1, 5),
        'come_date'   => rand(2014, 2015) . '-' . rand(1,12) . '-' . rand(1,29),
        'come_time'   => 'shiduan0'.rand(1,5),
        'name'   => 'name '.$i,
        'tel'   => 'tel '.$i,
        'userid'   => 'userid '.$i,
        'come_product'   => 'come_product ' . rand(1,120),
        'come_for'   => 'come_for '.rand(1,5),
        'is_xiaofei'   => rand(0,1),
        'status'   => rand(0,1),
        'status_opt'   => 'status_opt '.$i,
        'status_time'   => 'status_time '.$i,
        'status_note'   => 'status_note '.$i,
        'status_score'   => 'status_score '.$i,
        'lixing_opt'   => 'lixing_opt '.$i,
        'lixing_time'   => 'lixing_time '.$i,
        'lixing_note'   => 'lixing_note '.$i,
        'lixing_score'   => 'lixing_score '.$i,
        'not_opt'   => 'not_opt '.$i,
        'not_time'   => 'not_time '.$i,
        'not_note'   => 'not_note '.$i,
        'not_score'   => 'not_score '.$i,
      ]);
    }
  }

}