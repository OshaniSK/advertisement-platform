<?php

use App\Models\Advertisement;
use App\Models\User;

test('advertisers can open the create advertisement page', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);

    $response = $this->actingAs($advertiser)->get(route('advertisements.create'));

    $response->assertOk();
    $response->assertViewIs('advertisements.create');
});

test('advertisers can update their own advertisement', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);
    $advertisement = Advertisement::create([
        'user_id' => $advertiser->id,
        'title' => 'Original title',
        'description' => 'Original description',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($advertiser)->put(
        route('advertisements.update', $advertisement),
        [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'price' => '25.00',
            'category' => 'Other',
            'location' => 'Colombo',
        ]
    );

    $response->assertRedirect(route('advertiser.dashboard', absolute: false));
    $this->assertDatabaseHas('advertisements', [
        'id' => $advertisement->id,
        'title' => 'Updated title',
        'description' => 'Updated description',
    ]);
});

test('database seeder creates an admin user', function () {
    $this->artisan('db:seed');

    $this->assertDatabaseHas('users', [
        'email' => 'admin@example.com',
        'role' => 'admin',
    ]);
});

test('admin users can open the admin dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertOk();
    $response->assertViewIs('admin.dashboard');
});

test('advertiser dashboard is available at the corrected path', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);

    $response = $this->actingAs($advertiser)->get('/advertiser/dashboard');

    $response->assertOk();
    $response->assertViewIs('advertiser.dashboard');
});

test('advertiser dashboard also works with the common misspelling', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);

    $response = $this->actingAs($advertiser)->get('/advertisor/dashboard');

    $response->assertOk();
    $response->assertViewIs('advertiser.dashboard');
});
