<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BreedTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateBreed()
    {
        $admin = \App\User::find(1);
        $breed = factory('App\Breed')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $breed) {
            $browser->loginAs($admin)
                ->visit(route('admin.breeds.index'))
                ->clickLink('Add new')
                ->type("breed_title", $breed->breed_title)
                ->press('Save')
                ->assertRouteIs('admin.breeds.index')
                ->assertSeeIn("tr:last-child td[field-key='breed_title']", $breed->breed_title);
        });
    }

    public function testEditBreed()
    {
        $admin = \App\User::find(1);
        $breed = factory('App\Breed')->create();
        $breed2 = factory('App\Breed')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $breed, $breed2) {
            $browser->loginAs($admin)
                ->visit(route('admin.breeds.index'))
                ->click('tr[data-entry-id="' . $breed->id . '"] .btn-info')
                ->type("breed_title", $breed2->breed_title)
                ->press('Update')
                ->assertRouteIs('admin.breeds.index')
                ->assertSeeIn("tr:last-child td[field-key='breed_title']", $breed2->breed_title);
        });
    }

    public function testShowBreed()
    {
        $admin = \App\User::find(1);
        $breed = factory('App\Breed')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $breed) {
            $browser->loginAs($admin)
                ->visit(route('admin.breeds.index'))
                ->click('tr[data-entry-id="' . $breed->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='breed_title']", $breed->breed_title);
        });
    }

}
