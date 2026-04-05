<?php

namespace App\Enums;

enum Department: string
{
  case ACADEMIC = 'academic';
  case ADMIN = 'admin';
  case ACCOUNT = 'account';
  case EXAMINATION = 'examination';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::ACADEMIC => 'Academic Department',
      self::ADMIN => 'Admin Department',
      self::ACCOUNT => 'Accounting Department',
      self::EXAMINATION => 'Examination Department',
    };
  }
}
