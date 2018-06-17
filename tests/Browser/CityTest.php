<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CityTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $city) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->clickLink('Add new')
                ->type("city_name", $city->city_name)
                ->press('Save')
                ->assertRouteIs('admin.cities.index')
                ->assertSeeIn("tr:last-child td[field-key='city_name']", $city->city_name);
        });
    }

    public function testEditCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->create();
        $city2 = factory('App\City')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $city, $city2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->click('tr[data-entry-id="' . $city->id . '"] .btn-info')
                ->type("city_name", $city2->city_name)
                ->press('Update')
                ->assertRouteIs('admin.cities.index')
                ->assertSeeIn("tr:last-child td[field-key='city_name']", $city2->city_name);
        });
    }

    public function testShowCity()
    {
        $admin = \App\User::find(1);
        $city = factory('App\City')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $city) {
            $browser->loginAs($admin)
                ->visit(route('admin.cities.index'))
                ->click('tr[data-entry-id="' . $city->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='city_name']", $city->city_name);
        });
    }

}
