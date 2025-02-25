<?php

namespace App\Transformers\Web;

use App\Models\User;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class AttendeUserTransformer extends TransformerAbstract
{
    private $presence;

    public function __construct($presence)
    {
        $this->presence = $presence;
    }
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'department' => optional($user->departemen)->name,
            'position' => $user->position,
            'gender' => optional($user->gender)->name,
            'status' => $user->status,
            'nip' => optional($user)->nip ?? '',
            'group' => optional($user->golongan)->group ?? '',
            'rank' => Str::replaceFirst('Tingkat', 'Tk.', optional($user->golongan)->rank) ?? '',
            'presensi' => $this->presence
        ];
    }
}
