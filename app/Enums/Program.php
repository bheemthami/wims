<?php

namespace App\Enums;

enum Program: string
{
  case ECD = 'ecd';
  case PRIMARY_EDUCATION = 'primary-education';
  case BASIC_EDUCATION = 'basic-education';
  case SECONDARY_EDUCATION = 'secondary-education';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::ECD => 'Early Childhood Development (ECD)',
      self::PRIMARY_EDUCATION => 'Primary Education',
      self::BASIC_EDUCATION => 'Basic Education',
      self::SECONDARY_EDUCATION => 'Secondary Education',
    };
  }
}
