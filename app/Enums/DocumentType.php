<?php

namespace App\Enums;

enum DocumentType: string
{
  case DOWNLOAD = 'download';
  case REPORT = 'report';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::DOWNLOAD => 'Downloads',
      self::REPORT => 'Reports',
    };
  }
}
