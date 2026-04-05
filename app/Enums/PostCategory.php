<?php

namespace App\Enums;

enum PostCategory: string
{
  case NEWS_AND_EVENTS = 'news-and-events';
  case NOTICE = 'notices';
  case RESULT = 'results';
  case CAREER = 'career';
  case ANNUAL_CALENDAR = 'annual-calendar';
  case SMC_DECISION = 'smc-decisions';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::NEWS_AND_EVENTS => 'News and Events',
      self::NOTICE => 'Notices',
      self::RESULT => 'Results',
      self::CAREER => 'Career',
      self::ANNUAL_CALENDAR => 'Annual Calendar',
      self::SMC_DECISION => 'SMC Decisions',
    };
  }
}
