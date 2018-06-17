<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $profile) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->clickLink('Add new')
                ->type("firstname", $profile->firstname)
                ->type("lastname", $profile->lastname)
                ->type("dob", $profile->dob)
                ->type("city", $profile->city)
                ->type("province", $profile->province)
                ->type("postalcode", $profile->postalcode)
                ->type("phone", $profile->phone)
                ->type("auth_user_fname", $profile->auth_user_fname)
                ->type("auth_user_lname", $profile->auth_user_lname)
                ->type("auth_user_phone", $profile->auth_user_phone)
                ->press('Save')
                ->assertRouteIs('admin.profiles.index')
                ->assertSeeIn("tr:last-child td[field-key='firstname']", $profile->firstname)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $profile->lastname)
                ->assertSeeIn("tr:last-child td[field-key='dob']", $profile->dob)
                ->assertSeeIn("tr:last-child td[field-key='city']", $profile->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $profile->province)
                ->assertSeeIn("tr:last-child td[field-key='postalcode']", $profile->postalcode)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $profile->phone)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_fname']", $profile->auth_user_fname)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_lname']", $profile->auth_user_lname)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_phone']", $profile->auth_user_phone);
        });
    }

    public function testEditProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->create();
        $profile2 = factory('App\Profile')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $profile, $profile2) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->click('tr[data-entry-id="' . $profile->id . '"] .btn-info')
                ->type("firstname", $profile2->firstname)
                ->type("lastname", $profile2->lastname)
                ->type("dob", $profile2->dob)
                ->type("city", $profile2->city)
                ->type("province", $profile2->province)
                ->type("postalcode", $profile2->postalcode)
                ->type("phone", $profile2->phone)
                ->type("auth_user_fname", $profile2->auth_user_fname)
                ->type("auth_user_lname", $profile2->auth_user_lname)
                ->type("auth_user_phone", $profile2->auth_user_phone)
                ->press('Update')
                ->assertRouteIs('admin.profiles.index')
                ->assertSeeIn("tr:last-child td[field-key='firstname']", $profile2->firstname)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $profile2->lastname)
                ->assertSeeIn("tr:last-child td[field-key='dob']", $profile2->dob)
                ->assertSeeIn("tr:last-child td[field-key='city']", $profile2->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $profile2->province)
                ->assertSeeIn("tr:last-child td[field-key='postalcode']", $profile2->postalcode)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $profile2->phone)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_fname']", $profile2->auth_user_fname)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_lname']", $profile2->auth_user_lname)
                ->assertSeeIn("tr:last-child td[field-key='auth_user_phone']", $profile2->auth_user_phone);
        });
    }

    public function testShowProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $profile) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->click('tr[data-entry-id="' . $profile->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='firstname']", $profile->firstname)
                ->assertSeeIn("td[field-key='lastname']", $profile->lastname)
                ->assertSeeIn("td[field-key='dob']", $profile->dob)
                ->assertSeeIn("td[field-key='city']", $profile->city)
                ->assertSeeIn("td[field-key='province']", $profile->province)
                ->assertSeeIn("td[field-key='postalcode']", $profile->postalcode)
                ->assertSeeIn("td[field-key='phone']", $profile->phone)
                ->assertSeeIn("td[field-key='auth_user_fname']", $profile->auth_user_fname)
                ->assertSeeIn("td[field-key='auth_user_lname']", $profile->auth_user_lname)
                ->assertSeeIn("td[field-key='auth_user_phone']", $profile->auth_user_phone)
                ->assertSeeIn("td[field-key='created_by']", $profile->created_by->name);
        });
    }

}
