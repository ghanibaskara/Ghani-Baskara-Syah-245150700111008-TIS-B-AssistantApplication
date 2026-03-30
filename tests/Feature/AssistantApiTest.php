<?php

use App\Models\AssistantApplication;

// Skenario 1: Menguji pengambilan daftar data (Index)
it('can retrieve a list of assistant applications', function () {
    AssistantApplication::factory()->count(3)->create();

    $this->getJson('/api/v1/applications')
        ->assertStatus(200)
        ->assertJsonCount(3);
});

// Skenario 2: Menguji pembuatan data baru (Store)
it('can create a new assistant application', function () {
    $applicationData = [
        'student_name' => 'Ghani Baskara',
        'student_id' => '245150700111008',
        'course_name' => 'Pemrograman Lanjut',
        'gpa' => 3.85,
    ];

    $this->postJson('/api/v1/applications', $applicationData)
        ->assertStatus(201)
        ->assertJsonFragment(['student_name' => 'Ghani Baskara']);

    // Memastikan data tersimpan di database
    $this->assertDatabaseHas('assistant_applications', ['student_name' => 'Ghani Baskara']);
});

// Skenario 3: Menampilkan detail satu pendaftar (Show)
it('can display a specific assistant application', function () {
    $application = AssistantApplication::factory()->create();

    $this->getJson("/api/v1/applications/{$application->id}")
        ->assertStatus(200) // Memastikan sukses [cite: 283]
        ->assertJsonFragment(['student_id' => $application->student_id]);
});

// Skenario 4: Memperbarui data pendaftar (Update)
it('can update an existing assistant application', function () {
    $application = AssistantApplication::factory()->create([
        'status' => 'pending',
    ]);

    $updateData = [
        'status' => 'accepted',
    ];

    $this->putJson("/api/v1/applications/{$application->id}", $updateData)
        ->assertStatus(200)
        ->assertJsonFragment(['status' => 'accepted']);

    $this->assertDatabaseHas('assistant_applications', [
        'id' => $application->id,
        'status' => 'accepted',
    ]);
});

// Skenario 5: Menghapus data pendaftar (Destroy)
it('can delete an assistant application', function () {
    $application = AssistantApplication::factory()->create();

    $this->deleteJson("/api/v1/applications/{$application->id}")
        ->assertStatus(204);

    $this->assertDatabaseMissing('assistant_applications', [
        'id' => $application->id,
    ]);
});
