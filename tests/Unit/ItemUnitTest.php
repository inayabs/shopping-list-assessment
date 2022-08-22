<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Models\Department;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemUnitTest extends TestCase
{
    // use RefreshDatabase;
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
        $item->department_id = Department::first()->id;
        $item->save();
        
        $this->assertTrue(true);
    }

    public function test_update_item(){
        $name = Str::random(5).' '.Str::random(5);

        $item = Item::first();
        $item->name = $name;
        $item->update();

        $this->assertTrue(true);
    }

    public function test_list_item(){
        $departments = Item::orderBy('id','desc');

        $this->assertTrue(true);
    }
}
