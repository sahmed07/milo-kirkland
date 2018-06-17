<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PetTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePet()
    {
        $admin = \App\User::find(1);
        $pet = factory('App\Pet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $pet) {
            $browser->loginAs($admin)
                ->visit(route('admin.pets.index'))
                ->clickLink('Add new')
                ->type("tag_id", $pet->tag_id)
                ->attach("pet_photo", base_path("tests/_resources/test.jpg"))
                ->type("pet_name", $pet->pet_name)
                ->radio("pet_type", $pet->pet_type)
                ->type("pet_breed", $pet->pet_breed)
                ->type("pet_color", $pet->pet_color)
                ->type("pet_age", $pet->pet_age)
                ->radio("pet_sex", $pet->pet_sex)
                ->radio("behaviour", $pet->behaviour)
                ->radio("pet_size", $pet->pet_size)
                ->type("distinctive_sign", $pet->distinctive_sign)
                ->select("microchip", $pet->microchip)
                ->radio("sprayed_neutered", $pet->sprayed_neutered)
                ->select("rabies_vacc", $pet->rabies_vacc)
                ->select("pet_status", $pet->pet_status)
                ->select("pay_status", $pet->pay_status)
                ->press('Save')
                ->assertRouteIs('admin.pets.index')
                ->assertSeeIn("tr:last-child td[field-key='tag_id']", $pet->tag_id)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Pet::first()->pet_photo . "']")
                ->assertSeeIn("tr:last-child td[field-key='pet_name']", $pet->pet_name)
                ->assertSeeIn("tr:last-child td[field-key='pet_type']", $pet->pet_type)
                ->assertSeeIn("tr:last-child td[field-key='pet_breed']", $pet->pet_breed)
                ->assertSeeIn("tr:last-child td[field-key='pet_color']", $pet->pet_color)
                ->assertSeeIn("tr:last-child td[field-key='pet_age']", $pet->pet_age)
                ->assertSeeIn("tr:last-child td[field-key='pet_sex']", $pet->pet_sex)
                ->assertSeeIn("tr:last-child td[field-key='behaviour']", $pet->behaviour)
                ->assertSeeIn("tr:last-child td[field-key='pet_size']", $pet->pet_size)
                ->assertSeeIn("tr:last-child td[field-key='distinctive_sign']", $pet->distinctive_sign)
                ->assertSeeIn("tr:last-child td[field-key='microchip']", $pet->microchip)
                ->assertSeeIn("tr:last-child td[field-key='sprayed_neutered']", $pet->sprayed_neutered)
                ->assertSeeIn("tr:last-child td[field-key='rabies_vacc']", $pet->rabies_vacc)
                ->assertSeeIn("tr:last-child td[field-key='pet_status']", $pet->pet_status)
                ->assertSeeIn("tr:last-child td[field-key='pay_status']", $pet->pay_status);
        });
    }

    public function testEditPet()
    {
        $admin = \App\User::find(1);
        $pet = factory('App\Pet')->create();
        $pet2 = factory('App\Pet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $pet, $pet2) {
            $browser->loginAs($admin)
                ->visit(route('admin.pets.index'))
                ->click('tr[data-entry-id="' . $pet->id . '"] .btn-info')
                ->type("tag_id", $pet2->tag_id)
                ->attach("pet_photo", base_path("tests/_resources/test.jpg"))
                ->type("pet_name", $pet2->pet_name)
                ->radio("pet_type", $pet2->pet_type)
                ->type("pet_breed", $pet2->pet_breed)
                ->type("pet_color", $pet2->pet_color)
                ->type("pet_age", $pet2->pet_age)
                ->radio("pet_sex", $pet2->pet_sex)
                ->radio("behaviour", $pet2->behaviour)
                ->radio("pet_size", $pet2->pet_size)
                ->type("distinctive_sign", $pet2->distinctive_sign)
                ->select("microchip", $pet2->microchip)
                ->radio("sprayed_neutered", $pet2->sprayed_neutered)
                ->select("rabies_vacc", $pet2->rabies_vacc)
                ->select("pet_status", $pet2->pet_status)
                ->select("pay_status", $pet2->pay_status)
                ->press('Update')
                ->assertRouteIs('admin.pets.index')
                ->assertSeeIn("tr:last-child td[field-key='tag_id']", $pet2->tag_id)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Pet::first()->pet_photo . "']")
                ->assertSeeIn("tr:last-child td[field-key='pet_name']", $pet2->pet_name)
                ->assertSeeIn("tr:last-child td[field-key='pet_type']", $pet2->pet_type)
                ->assertSeeIn("tr:last-child td[field-key='pet_breed']", $pet2->pet_breed)
                ->assertSeeIn("tr:last-child td[field-key='pet_color']", $pet2->pet_color)
                ->assertSeeIn("tr:last-child td[field-key='pet_age']", $pet2->pet_age)
                ->assertSeeIn("tr:last-child td[field-key='pet_sex']", $pet2->pet_sex)
                ->assertSeeIn("tr:last-child td[field-key='behaviour']", $pet2->behaviour)
                ->assertSeeIn("tr:last-child td[field-key='pet_size']", $pet2->pet_size)
                ->assertSeeIn("tr:last-child td[field-key='distinctive_sign']", $pet2->distinctive_sign)
                ->assertSeeIn("tr:last-child td[field-key='microchip']", $pet2->microchip)
                ->assertSeeIn("tr:last-child td[field-key='sprayed_neutered']", $pet2->sprayed_neutered)
                ->assertSeeIn("tr:last-child td[field-key='rabies_vacc']", $pet2->rabies_vacc)
                ->assertSeeIn("tr:last-child td[field-key='pet_status']", $pet2->pet_status)
                ->assertSeeIn("tr:last-child td[field-key='pay_status']", $pet2->pay_status);
        });
    }

    public function testShowPet()
    {
        $admin = \App\User::find(1);
        $pet = factory('App\Pet')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $pet) {
            $browser->loginAs($admin)
                ->visit(route('admin.pets.index'))
                ->click('tr[data-entry-id="' . $pet->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='tag_id']", $pet->tag_id)
                ->assertSeeIn("td[field-key='pet_name']", $pet->pet_name)
                ->assertSeeIn("td[field-key='pet_type']", $pet->pet_type)
                ->assertSeeIn("td[field-key='pet_breed']", $pet->pet_breed)
                ->assertSeeIn("td[field-key='pet_color']", $pet->pet_color)
                ->assertSeeIn("td[field-key='pet_age']", $pet->pet_age)
                ->assertSeeIn("td[field-key='pet_sex']", $pet->pet_sex)
                ->assertSeeIn("td[field-key='behaviour']", $pet->behaviour)
                ->assertSeeIn("td[field-key='pet_size']", $pet->pet_size)
                ->assertSeeIn("td[field-key='distinctive_sign']", $pet->distinctive_sign)
                ->assertSeeIn("td[field-key='microchip']", $pet->microchip)
                ->assertSeeIn("td[field-key='sprayed_neutered']", $pet->sprayed_neutered)
                ->assertSeeIn("td[field-key='rabies_vacc']", $pet->rabies_vacc)
                ->assertSeeIn("td[field-key='pet_status']", $pet->pet_status)
                ->assertSeeIn("td[field-key='pay_status']", $pet->pay_status)
                ->assertSeeIn("td[field-key='created_by']", $pet->created_by->name);
        });
    }

}
