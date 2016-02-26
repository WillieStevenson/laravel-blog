<?php

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;


    public function test_i_am_redirect_to_login_if_i_try_to_view_post_lists_without_logging_in()
    {
        $this->visit('/posts')->see('Login');
    }


    public function test_i_can_create_an_account()
    {
        $this->visit('/register')
            ->type('Taylor Otwell', 'name')
            ->type('taylor@laravel.com', 'email')
            ->type('secret', 'password')
            ->type('secret', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/posts')
            ->seeInDatabase('users', ['email' => 'taylor@laravel.com']);
    }


    public function test_authenticated_users_can_create_posts()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/posts')
             ->type('Post 1', 'name')
             ->press('Add Post')
             ->see('Post 1')
             ->seeInDatabase('posts', ['name' => 'Post 1']);
    }


    public function test_users_can_delete_a_post()
    {
        $user = factory(User::class)->create();

        $user->posts()->save($postOne = factory(Post::class)->create());
        $user->posts()->save($postTwo = factory(Post::class)->create());

        $this->actingAs($user)
             ->visit('/posts')
             ->see($postOne->name)
             ->see($postTwo->name)
             ->press('delete-post-'.$postOne->id)
             ->dontSee($postOne->name)
             ->see($postTwo->name);
    }


    public function test_users_cant_view_posts_of_other_users()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $userOne->posts()->save($postOne = factory(Post::class)->create());
        $userTwo->posts()->save($postTwo = factory(Post::class)->create());

        $this->actingAs($userOne)
             ->visit('/posts')
             ->see($postOne->name)
             ->dontSee($postTwo->name);
    }


    public function test_users_cant_delete_posts_of_other_users()
    {
        $this->withoutMiddleware();

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $userOne->posts()->save($postOne = factory(Post::class)->create());
        $userTwo->posts()->save($postTwo = factory(Post::class)->create());

        $this->actingAs($userOne)
             ->delete('/post/'.$postTwo->id)
             ->assertResponseStatus(403);
    }
}
