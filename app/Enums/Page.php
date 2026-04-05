<?php

namespace App\Enums;

enum Page: string
{
  case HOME = 'home';
  case ABOUT = 'about-us';
  case INTRODUCTION = 'introduction';
  case MESSAGE_FROM_CHAIRMAN = 'message-from-head';
  case MESSAGE_FROM_PRINCIPAL = 'message-from-principal';
  case MISSION_VISION_GOAL_AND_OBJECTIVES = 'mission-vision-goal-and-objectives';
  case STUDENT_CLUBS = 'student-clubs';
  case SMC = 'school-management-committee-smc';
  case PTA = 'parent-teacher-association-pta';
  case CONTACT_US = 'contact-us';

  public function slug(): string
  {
    return $this->value;
  }

  public function title(): string
  {
    return match ($this) {
      self::HOME => 'Home',
      self::ABOUT => 'About Us',
      self::INTRODUCTION => 'Introduction',
      self::MISSION_VISION_GOAL_AND_OBJECTIVES => 'Mission, Vision, Goal and Objectives',
      self::STUDENT_CLUBS => 'Student Clubs',
      self::SMC => 'School Management Committee (SMC)',
      self::PTA => 'Parent Teacher Association (PTA)',
      self::CONTACT_US => 'Contact Us',
    };
  }
}
