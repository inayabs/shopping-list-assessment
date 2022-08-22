<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DepartmentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user(){
        $user = User::factory()->create();

        $this->assertTrue(true);
    }

    public function test_create_department()
    {
        $name = Str::random(5).' '.Str::random(5);
        $slug = Str::slug($name,'-');
        $user_id = 1;

        $department = new Department;
        $department->user_id = $user_id;
        $department->name = $name;
        $department->slug = $slug;
        $department->save();
        
        $this->assertTrue(true);
    }

    public function test_update_department(){
        $name = Str::random(5).' '.Str::random(5);
        $slug = Str::slug($name,'-');
        $user_id = 1;

        $department = Department::findOrFail(1);
        $department->user_id = $user_id;
        $department->name = $name;
        $department->slug = $slug;
        $department->update();

        $this->assertTrue(true);
    }

    public function test_list_department(){
        $user_id = 1;
        $departments = Department::where('user_id',$user_id)->get();

        $this->assertTrue(true);
    }
}
