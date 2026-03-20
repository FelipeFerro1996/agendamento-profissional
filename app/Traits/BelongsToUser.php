<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    /**
     * O "boot" do Trait é chamado automaticamente pelo Eloquent.
     */
    protected static function bootBelongsToUser()
    {
        static::creating(function ($model) {
            // Se o usuário estiver logado e o user_id não foi definido manualmente
            if (Auth::check() && !$model->user_id) {
                $model->user_id = Auth::user()->id;
            }
        });

        // --- ADICIONE ISSO ---
        static::addGlobalScope('user_filter', function ($builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });
        
    }

    /**
     * Define o relacionamento padrão com o User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}