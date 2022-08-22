<?php

namespace Tests\Unit;

use App\Models\Department;
use App\Models\Item;
use App\Models\ItemList;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListUnitTest extends TestCase
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

        $item = new ItemList();
        $item->quantity = 1;
        $item->item_id = Item::first()->id;
        $item->save();
        
        $this->assertTrue(true);
    }

    public function test_update_item(){
        $item = ItemList::first();
        $item->quantity = 2;
        $item->update();

        $this->assertTrue(true);
    }

    public function test_list_item(){
        $departments = ItemList::orderBy('id','desc');

        $this->assertTrue(true);
    }
}
