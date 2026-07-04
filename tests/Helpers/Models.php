<?php

namespace Musonza\Chat\Tests\Helpers\Models;

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Musonza\Chat\Models\Conversation as BaseConversation;
use Musonza\Chat\Traits\Messageable;

#[UseFactory(UserFactory::class)]
class User extends Model
{
    use HasFactory;
    use Messageable;

    protected $table = 'mc_users';
}

#[UseFactory(ClientFactory::class)]
class Client extends Model
{
    use HasFactory;
    use Messageable;

    protected $table = 'mc_clients';

    protected $primaryKey = 'client_id';

    public function getParticipantDetails(): array
    {
        return [
            'name' => $this->name,
            'foo'  => 'bar',
        ];
    }
}

#[UseFactory(BotFactory::class)]
class Bot extends Model
{
    use HasFactory;
    use Messageable;

    protected $table = 'mc_bots';

    protected $primaryKey = 'bot_id';
}

#[UseFactory(ConversationFactory::class)]

class Conversation extends BaseConversation
{
    use HasFactory;
}

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        static $password;

        return [
            'name'           => fake()->name(),
            'email'          => fake()->unique()->safeEmail(),
            'password'       => $password ?: $password = bcrypt('secret'),
            'remember_token' => 'xahja87ahjahajhajhja',
        ];
    }
}

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}

class BotFactory extends Factory
{
    protected $model = Bot::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}

class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition(): array
    {
        return [
            'data' => [
                'title' => fake()->sentence(),
            ],
        ];
    }
}
