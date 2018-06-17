<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PaymentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePayment()
    {
        $admin = \App\User::find(1);
        $payment = factory('App\Payment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments.index'))
                ->clickLink('Add new')
                ->type("payment_type", $payment->payment_type)
                ->type("amount", $payment->amount)
                ->type("payment_date", $payment->payment_date)
                ->press('Save')
                ->assertRouteIs('admin.payments.index')
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $payment->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payment->amount)
                ->assertSeeIn("tr:last-child td[field-key='payment_date']", $payment->payment_date);
        });
    }

    public function testEditPayment()
    {
        $admin = \App\User::find(1);
        $payment = factory('App\Payment')->create();
        $payment2 = factory('App\Payment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payment, $payment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments.index'))
                ->click('tr[data-entry-id="' . $payment->id . '"] .btn-info')
                ->type("payment_type", $payment2->payment_type)
                ->type("amount", $payment2->amount)
                ->type("payment_date", $payment2->payment_date)
                ->press('Update')
                ->assertRouteIs('admin.payments.index')
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $payment2->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payment2->amount)
                ->assertSeeIn("tr:last-child td[field-key='payment_date']", $payment2->payment_date);
        });
    }

    public function testShowPayment()
    {
        $admin = \App\User::find(1);
        $payment = factory('App\Payment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.payments.index'))
                ->click('tr[data-entry-id="' . $payment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='payment_type']", $payment->payment_type)
                ->assertSeeIn("td[field-key='amount']", $payment->amount)
                ->assertSeeIn("td[field-key='payment_date']", $payment->payment_date)
                ->assertSeeIn("td[field-key='created_by']", $payment->created_by->name);
        });
    }

}
