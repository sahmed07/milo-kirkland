<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PaymentsRateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePaymentsRate()
    {
        $admin = \App\User::find(1);
        $payments_rate = factory('App\PaymentsRate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payments_rate) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments_rates.index'))
                ->clickLink('Add new')
                ->type("payment_type", $payments_rate->payment_type)
                ->type("amount", $payments_rate->amount)
                ->press('Save')
                ->assertRouteIs('admin.payments_rates.index')
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $payments_rate->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payments_rate->amount);
        });
    }

    public function testEditPaymentsRate()
    {
        $admin = \App\User::find(1);
        $payments_rate = factory('App\PaymentsRate')->create();
        $payments_rate2 = factory('App\PaymentsRate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payments_rate, $payments_rate2) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments_rates.index'))
                ->click('tr[data-entry-id="' . $payments_rate->id . '"] .btn-info')
                ->type("payment_type", $payments_rate2->payment_type)
                ->type("amount", $payments_rate2->amount)
                ->press('Update')
                ->assertRouteIs('admin.payments_rates.index')
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $payments_rate2->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payments_rate2->amount);
        });
    }

    public function testShowPaymentsRate()
    {
        $admin = \App\User::find(1);
        $payments_rate = factory('App\PaymentsRate')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $payments_rate) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments_rates.index'))
                ->click('tr[data-entry-id="' . $payments_rate->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='payment_type']", $payments_rate->payment_type)
                ->assertSeeIn("td[field-key='amount']", $payments_rate->amount);
        });
    }

}
