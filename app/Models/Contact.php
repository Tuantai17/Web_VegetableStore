<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// class Contact extends Model
// {
//     protected $table ='contact';
//     use softDeletes;

// }
class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'uttt_contact';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'title',
        'content',
        'reply_id',
        'reply_content',
        'status',
    ];
    
    protected $dates = ['deleted_at']; // cái này thêm vào cho chắc
    public function replier()
    {
        return $this->belongsTo(User::class, 'reply_id');
    }
    
    public function reply()
{
    return $this->belongsTo(Contact::class, 'reply_id');
}
protected static function booted()
{
    static::creating(function ($contact) {
        if (is_null($contact->created_by)) {
            $contact->created_by = auth()->id() ?? 0;
        }
    });
}

}
