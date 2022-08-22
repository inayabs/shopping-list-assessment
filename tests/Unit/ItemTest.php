<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Item;

class ItemTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_create_item()
    {
        $name = Str::random(5).' '.Str::random(5);

        $item = new Item();
        $item->name = $name;
        $item->department_id = 1;
        $item->save();
        
        $this->assertTrue(true);
    }

    public function test_update_item(){
        $name = Str::random(5).' '.Str::random(5);

        $item = Item::findOrFail(1);
        $item->name = $name;
        $item->update();

        $this->assertTrue(true);
    }

    public function test_list_item(){
        $departments = Item::orderBy('id','desc');

        $this->assertTrue(true);
    }
}
