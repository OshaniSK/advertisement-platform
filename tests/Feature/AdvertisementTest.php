<?php

use App\Models\Advertisement;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;

test('advertisers can open the create advertisement page', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);

    $response = $this->actingAs($advertiser)->get(route('advertisements.create'));

    $response->assertOk();
    $response->assertViewIs('advertisements.create');
});

test('navigation shows the notification bell for unread messages', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);
    $visitor = User::factory()->create(['role' => 'visitor']);
    $advertisement = Advertisement::create([
        'user_id' => $advertiser->id,
        'title' => 'Approved advertisement',
        'description' => 'An approved advertisement',
        'status' => 'approved',
    ]);
    $message = Message::create([
        'sender_id' => $visitor->id,
        'receiver_id' => $advertiser->id,
        'advertisement_id' => $advertisement->id,
        'message' => 'Is this available?',
    ]);

    $advertiser->notify(new NewMessageNotification($message->load(['sender', 'advertisement'])));

    $response = $this->actingAs($advertiser)->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee('🔔');
    $response->assertSee('1');
});

test('advertisers can submit an advertisement', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);

    $response = $this->actingAs($advertiser)->post(
        route('advertisements.store'),
        [
            'title' => 'New advertisement',
            'description' => 'A new advertisement description',
            'price' => '25.00',
            'category' => 'Other',
            'location' => 'Colombo',
        ]
    );

    $response->assertRedirect(route('advertiser.dashboard', absolute: false));
    $this->assertDatabaseHas('advertisements', [
        'user_id' => $advertiser->id,
        'title' => 'New advertisement',
        'description' => 'A new advertisement description',
        'status' => 'pending',
    ]);
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

test('visitors can open the visitor dashboard', function () {
    $visitor = User::factory()->create(['role' => 'visitor']);

    $response = $this->actingAs($visitor)->get(route('visitor.dashboard'));

    $response->assertOk();
    $response->assertViewIs('visitor.dashboard');
});

test('visitors are redirected when they open the advertiser dashboard URL', function () {
    $visitor = User::factory()->create(['role' => 'visitor']);

    $response = $this->actingAs($visitor)->get(route('advertiser.dashboard'));

    $response->assertRedirect(route('visitor.dashboard', absolute: false));
});

test('advertiser can open a conversation when their reply is the latest message', function () {
    $advertiser = User::factory()->create(['role' => 'advertiser']);
    $visitor = User::factory()->create(['role' => 'visitor']);
    $advertisement = Advertisement::create([
        'user_id' => $advertiser->id,
        'title' => 'Approved advertisement',
        'description' => 'An approved advertisement',
        'status' => 'approved',
    ]);

    Message::create([
        'sender_id' => $visitor->id,
        'receiver_id' => $advertiser->id,
        'advertisement_id' => $advertisement->id,
        'message' => 'Is this available?',
    ]);
    Message::create([
        'sender_id' => $advertiser->id,
        'receiver_id' => $visitor->id,
        'advertisement_id' => $advertisement->id,
        'message' => 'Yes, it is available.',
    ]);

    $dashboard = $this->actingAs($advertiser)->get(route('advertiser.dashboard'));

    $dashboard->assertOk();
    $dashboard->assertSee(route('messages.conversation', [
        'advertisement' => $advertisement,
        'other_user' => $visitor,
    ]));

    $this->get(route('messages.conversation', [
        'advertisement' => $advertisement,
        'other_user' => $visitor,
    ]))->assertOk();
});
