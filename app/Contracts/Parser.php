<?php declare(strict_types=1);

namespace App\Contracts;

interface Parser
{
  public function getData(string $url): array;
  public function saveData(string $url): void;
}