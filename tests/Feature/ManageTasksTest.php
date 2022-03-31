<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class ManageTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function user_can_create_a_task()
    {
        // User memngunjungi halaman Daftar Task
        $this->visit('/tasks');

        // Isi form `name` dan `description` kemudian submit
        $this->submitForm('Create Task', [
            'name' => 'My First Task',
            'description' => 'This is my first task on my new job.',
        ]);

        // Lihat Record tersimpan ke database
        $this->seeInDatabase('tasks', [
            'name' => 'My First Task',
            'description' => 'This is my first task on my new job.',
            'is_done' => 0,
        ]);

        // Redirect ke halaman Daftar Task
        $this->seePageIs('/tasks');

        // Tampil hasil task yang telah diinput
        $this->see('My First Task');
        $this->see('This is my first task on my new job.');

    }

    /** @test */
    public function user_can_make_test_index(){
// Submit form untuk membuat task baru
        // dengan field name description kosong
        $this->post('/tasks', [
            'name'        => '',
            'description' => '',
        ]);

        // Cek pada session apakah ada error untuk field nama dan description
        $this->assertSessionHasErrors(['name', 'description']);
    }

    /** @test */
    public function user_can_browser_tasks_index_page()
    {
        // Generate 3 record task pada table `tasks`.
        $tasks = Task::factory(3)->create();

        // User membuka halaman Daftar Task.
        $this->visit('/tasks');

        for($i = 0; $i <= 2; $i++){
            // User melihat ketiga task tampil pada halaman.
            $this->see($tasks[$i]->name);

            // User melihat link untuk edit task pada masing-masing item task.
            $this->seeElement('a', [
                'href' => url('edit-task/'.$tasks[$i]->id)
            ]);
        }
    }

    /** @test */
    public function user_can_edit_an_existing_task()
    {
        // Generate 1 record task pada table `tasks`.
        $task = Task::factory()->create();

        // User membuka halaman Daftar Task.
        $this->visit('/tasks');

        // Klik tombol edit task
        $this->click('edit_task_'.$task->id);

        // Lihat URL yang dituju sesuai dengan target
        $this->seePageIs('/edit-task/1');

        // Tampil form Edit Task
        $this->seeElement('form', [
            'id' => 'edit_task_'.$task->id,
            'action' => url('edit-task-prosess/1')
        ]);

        // User submit form berisi nama dan deskripsi task yang baru
        $this->submitForm('Update Task', [
            'name' => 'Updated Task',
            'description' => 'Updated task desc'
        ]);

        // Lihat halaman web ter-redirect ke URL sesuai dengan target
        $this->visit('/tasks');

        // Record pada database berubah sesuai dengan nama dan deskripsi baru
        $this->seeInDatabase('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task',
            'description' => 'Updated task desc'
        ]);
    }

    /** @test */
    public function user_can_delete_an_existing_task()
    {
        // Generate 1 record task pada table `tasks`.
        $task = Task::factory()->create();

        // User membuka halaman Daftar Task.
        $this->visit('/tasks');

        // User tekan tombol "Hapus Task" (tombol dengan id="edit_task_1")
        // Dimana angka 1 adalah id dari $task
        $this->press('delete_task_'.$task->id);

        // Lihat halaman web ter-redirect ke halaman daftar task
        $this->seePageIs('/tasks');

        // Record task hilang dari database
        $this->dontSeeInDatabase('tasks', [
            'id' => $task->id,
        ]);
    }

    /** @test */
    // public function user_can_toggle_task_status(){
    //     // MENGGUNAKAN UNIT TEST ATAU TEST SECARA LANGSUNG KE MODEL
    //     // JIKA INGIN MENGGUNAKAN FEATURE TEST, MAKA UNCOMMENT!

    //     // Generate 1 record task pada table `tasks`.
    //     $task = Task::factory()->create();

    //     // dd($task);

    //     // User membuka halaman Daftar Task.
    //     // $this->visit('/tasks');

    //     // Panggil method `toggleStatus()` pada model `App\Task`
    //     $task->toggleStatus();

    //     // User tekan tombol dengan id="toggle_task_1"
    //     // Dimana angka 1 adalah id dari $task
    //     // $this->press('toggle_task_'.$task->id);

    //     // Lihat halaman web ter-redirect ke halaman daftar task
    //     // $this->seePageIs('/tasks');

    //     // Kolom is_done pada record task berubah menjadi 1
    //     $this->seeInDatabase('tasks', [
    //         'id'      => $task->id,
    //         'is_done' => 1,
    //     ]);

    //     // User tekan tombol dengan id="toggle_task_1" (lagi)
    //     // untuk mengembalikan status task
    //     // $this->press('toggle_task_'.$task->id);

    //     // Panggil method `toggleStatus()` pada model `App\Task` (lagi)
    //     $task->toggleStatus();

    //     // Lihat halaman web ter-redirect ke halaman daftar task
    //     // $this->seePageIs('/tasks');

    //     // Kolom is_done pada record task berubah menjadi 0
    //     $this->seeInDatabase('tasks', [
    //         'id'      => $task->id,
    //         'is_done' => 0,
    //     ]);
    // }
}
