<?php

namespace Tests\Feature;

use App\Entities\Test;
use Tests\TestCase;

class BugTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBug()
    {
        $user = \App\Models\User::factory()->create();

        $testItem = Test::factory()->create([
            'variable_parameter' => 'variable',
            'immutable_parameter' => 'immutable',
        ]);

        $this->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->patchJson(route('test.update', ['test' => $testItem->id]), [
                'variable_parameter' => 'CHANGED',
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas('tests', [
            'id' => $testItem->id,
            'variable_parameter' => 'CHANGED',
            'immutable_parameter' => 'immutable',
        ]);
    }
}
