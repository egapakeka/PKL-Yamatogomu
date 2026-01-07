<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use App\Models\Shift;
use App\Models\Production;

class ProductionFlowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_operator_can_create_production_for_today()
    {
        $operator = User::whereHas('roles', fn($q) => $q->where('name','operator'))->first();
        $product = Product::first();
        $shift = Shift::first();

        $this->actingAs($operator)
            ->post(route('productions.store'), [
                'product_id' => $product->id,
                'shift_id' => $shift->id,
                'production_date' => now()->format('Y-m-d'),
                'qty_ok' => 10,
                'qty_ng' => 2,
            ])
            ->assertRedirect(route('operator.form'));

        $this->assertDatabaseHas('productions', ['operator_id' => $operator->id, 'qty_ok' => 10, 'qty_ng' => 2]);
        $this->assertDatabaseHas('audit_logs', ['event' => 'created']);
    }

    public function test_operator_cannot_create_for_other_date()
    {
        $operator = User::whereHas('roles', fn($q) => $q->where('name','operator'))->first();
        $product = Product::first();
        $shift = Shift::first();

        $res = $this->actingAs($operator)
            ->post(route('productions.store'), [
                'product_id' => $product->id,
                'shift_id' => $shift->id,
                'production_date' => now()->subDay()->format('Y-m-d'),
                'qty_ok' => 1,
                'qty_ng' => 0,
            ]);

        $res->assertStatus(302);
        $this->assertDatabaseMissing('productions', ['qty_ok' => 1]);
    }

    public function test_supervisor_can_validate_production()
    {
        $operator = User::whereHas('roles', fn($q) => $q->where('name','operator'))->first();
        $supervisor = User::whereHas('roles', fn($q) => $q->where('name','supervisor'))->first();
        $product = Product::first();
        $shift = Shift::first();

        $this->actingAs($operator)
            ->post(route('productions.store'), [
                'product_id' => $product->id,
                'shift_id' => $shift->id,
                'production_date' => now()->format('Y-m-d'),
                'qty_ok' => 5,
                'qty_ng' => 0,
            ]);

        $production = Production::first();

        $this->actingAs($supervisor)
            ->post(route('productions.validate', $production))
            ->assertRedirect();

        $this->assertDatabaseHas('productions', ['id' => $production->id, 'status' => 'validated']);
        $this->assertDatabaseHas('audit_logs', ['event' => 'validated']);
    }
}
