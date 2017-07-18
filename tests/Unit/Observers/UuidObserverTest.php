<?php



use App\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UuidObserverTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function test_it_generates_uuid_for_model()
    {
        $user = factory(User::class)->create();
        $this->assertFalse(empty($user->uuid));
        $this->assertDatabaseHas('users', [
            'uuid' => $user->uuid
        ]);
    }
}
