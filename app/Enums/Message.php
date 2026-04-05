<?php

namespace App\Enums;

enum Message: string
{
  case NO_PERMISSION = 'no-permission';
  case OOPS_SOMETHING_WENT_WRONG = 'oops-something-went-wrong';
  case NO_DATA_FOUND = 'no-data-found';
  case NO_DATA_AVAILABLE = 'no-data-available';

  public function title(): string
  {
    return match ($this) {
      self::NO_PERMISSION => 'You do not have permission to perform this action.',
      self::OOPS_SOMETHING_WENT_WRONG => 'Oops! Something went wrong. Please try again later.',
      self::NO_DATA_FOUND => 'No data found.',
      self::NO_DATA_AVAILABLE => 'No data available.',
    };
  }
}
