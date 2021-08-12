<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected array $allowedFields = ['id', 'title', 'author', 'status', 'description'];

    public function getNews(): Collection
	{
		return \DB::table($this->table)->select($this->allowedFields)->get();

	}

	public function getNewsById(int $id): object
	{
		return \DB::table($this->table)->select($this->allowedFields)->find($id);
	}
}
